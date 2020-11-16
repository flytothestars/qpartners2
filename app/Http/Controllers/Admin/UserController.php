<?php

namespace App\Http\Controllers\Admin;

use App\Models\Users;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['password']]);
    }

    public function index(Request $request)
    {
        $row = Users::where(function ($query) use ($request) {
            $query->where('users.name', 'like', '%' . $request->search . '%')
                ->orWhere('users.email', 'like', '%' . $request->search . '%');
        })
            ->where('role_id', 3)
            ->orderBy('user_id', 'desc')
            ->select('users.*');

        if (isset($request->is_ban))
            $row->where('is_ban', $request->is_ban);
        else $row->where('is_ban', '0');

        $row = $row->paginate(10);

        return view('admin.users.user', [
            'row' => $row,
            'title' => 'Пользователи',
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Users();
        $row->avatar = '/media/default.png';

        return view('admin.users.user-edit', [
            'title' => 'Новый пользователь',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.users.user-edit', [
                'title' => 'Новый пользователь',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $user = new Users();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = 3;
        $user->avatar = $request->avatar;
        $user->password = Hash::make('12345');
        $user->save();
        return redirect('/admin/user');
    }

    public function edit($id)
    {
        $row = Users::find($id);
        return view('admin.users.user-edit', [
            'title' => 'Изменить пользователя',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id . ',user_id'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.users.user-edit', [
                'title' => 'Изменить страницу',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $user = Users::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = $request->avatar;
        $user->role_id = 3;
        $user->save();

        return redirect('/admin/user');

    }

    public function destroy($id)
    {
        $user = Users::find($id);
        $user->delete();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function password(Request $request)
    {

        if (isset($request->old_password)) {
            $user = Users::where('user_id', '=', Auth::user()->user_id)->first();
            $count = Hash::check($request->old_password, $user->password);
            if ($count == false) {
                return view('admin.users.password-edit', [
                    'error' => 'Неправильный старый пароль'
                ]);
            }

            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'new_password' => 'required|different:old_password',
                'confirm_password' => 'required|same:new_password',
            ]);

            if ($validator->fails()) {
                $messages = $validator->errors();
                $error = $messages->all();
                return view('admin.users.password-edit', [
                    'error' => $error[0]
                ]);
            }

            $user = Users::where('user_id', '=', Auth::user()->user_id)->first();
            $user->password = Hash::make($request->new_password);
            $user->save();

            return view('admin.users.password-edit', [
                'error' => 'Успешно изменен'
            ]);
        }
        return view('admin.users.password-edit');
    }

    public function changeIsBan(Request $request)
    {
        $review = Users::find($request->id);
        $review->is_ban = $request->is_show;
        $review->save();
    }

}
