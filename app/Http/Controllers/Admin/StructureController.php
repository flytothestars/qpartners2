<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class StructureController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
    }

    public function index(Request $request)
    {
        return  view('admin.structure.structure',[
            'request' => $request
        ]);
    }

    public function getChildList(Request $request,$user_id,$level){
        return  view('admin.structure.structure-list-loop-ajax',[
            'user_id' => $user_id,
            'level' => $level
        ]);
    }
}
