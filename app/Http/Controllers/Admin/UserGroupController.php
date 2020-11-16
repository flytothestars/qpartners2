<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\UserGroup;
use App\Models\Group;
use App\Models\UserOperation;
use App\Models\UserSubscribe;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class UserGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

        $users = Users::orderBy('user_id','asc')->get();
        View::share('users_row', $users);

        $groups = Group::orderBy('group_id','asc')->get();
        View::share('group_row', $groups);
    }

    public function index(Request $request)
    {
        $row = UserGroup::leftJoin('group','group.group_id','=','user_group.group_id')
                        ->leftJoin('users','users.user_id','=','user_group.user_id')
                        ->whereNULL('group.deleted_at')
                        ->orderBy('user_group.created_at','desc');

        if($request->group_id > 0){
            $row->where('user_group.group_id',$request->group_id);
        }

        $row = $row->paginate(100);

        return  view('admin.user-group.user-group',[
            'group_users' => $row
        ]);
    }


    public function create()
    {
        $row = new UserGroup();

        return  view('admin.user-group.user-group-edit', [
            'title' => 'Добавить участника',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.user-group.user-group-edit', [
                'title' => 'Добавить участника',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $check = UserGroup::where('user_id',$request->user_id)->where('group_id',$request->group_id)->first();

        if($check != null){
            return  view('admin.user-group.user-group-edit', [
                'title' => 'Добавить участника',
                'row' => (object) $request->all(),
                'error' => 'Вы уже добавили этого участника'
            ]);
        }

        $group = new UserGroup();
        $group->user_id = $request->user_id;
        $group->group_id = $request->group_id;
        $group->is_active = $request->is_active;
        $group->save();


        return redirect('/admin/user-group?group_id='.$request->group_id);
    }

    public function edit($id)
    {
        $row = UserGroup::find($id);

        return  view('admin.user-group.user-group-edit', [
            'title' => 'Изменить участника',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.user-group.user-group-edit', [
                'title' => 'Изменить участника',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $check = UserGroup::where('user_group_id','!=',$id)->where('user_id',$request->user_id)->where('group_id',$request->group_id)->first();

        if($check != null){
            return  view('admin.user-group.user-group-edit', [
                'title' => 'Добавить участника',
                'row' => (object) $request->all(),
                'error' => 'Вы уже добавили этого участника'
            ]);
        }

        $group = UserGroup::find($id);
        $group->user_id = $request->user_id;
        $group->group_id = $request->group_id;
        $group->is_active = $request->is_active;
        $group->save();

        return redirect('/admin/user-group?group_id='.$request->group_id);
    }

    public function destroy($id)
    {
        $group = UserGroup::find($id);
        $group->delete();
    }
}
