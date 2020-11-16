<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
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

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(Request $request)
    {
        $row = Group::where('is_show','1')->orderBy('created_at','desc');

        $row = $row->paginate(100);

        return  view('admin.group.group',[
            'groups' => $row
        ]);
    }

    

    public function create()
    {
        $row = new Group();
        
        return  view('admin.group.group-edit', [
            'title' => 'Добавить фонд',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.group.group-edit', [
                'title' => 'Добавить фонд',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $group = new Group();
        $group->group_name_ru = $request->group_name_ru;
        $group->is_show = 1;
        $group->max_user_count = is_numeric($request->max_user_count)?$request->max_user_count:1;
        $group->save();


        return redirect('/admin/group');
    }

    public function edit($id)
    {
        $row = Group::find($id);

        return  view('admin.group.group-edit', [
            'title' => 'Изменить фонд',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'group_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.group.group-edit', [
                'title' => 'Изменить фонд',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $group = Group::find($id);
        $group->group_name_ru = $request->group_name_ru;
        $group->is_show = 1;
        $group->max_user_count = is_numeric($request->max_user_count)?$request->max_user_count:1;
        $group->save();

        return redirect('/admin/group/');
    }

    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();
    }
}
