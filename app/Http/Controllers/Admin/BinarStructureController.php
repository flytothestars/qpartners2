<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class BinarStructureController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
    }

    public function index(Request $request)
    {
        return  view('admin.binar-structure.structure',[
            'request' => $request
        ]);
    }

    public function showConfig(Request $request)
    {
        return  view('admin.binar-structure.config',[
            'request' => $request
        ]);
    }

    public function getChildList(Request $request){
        $parent = Users::where('user_id',$request->user_id)->first();

        return  view('admin.binar-structure.divide-line',[
            'parent' => $parent,
            'main_user_id' => $request->main_user_id,
            'count' => 1
        ]);
    }

    /**
     * @return string
     */
    public function editIsLeftConfig(Request $request)
    {
        $user = Auth::user();
        $user->is_left_config = $request->is_left_config;
        $user->save();

        $result['message'] = 'Вы успешно сохранили настройку';
        $result['status'] = true;
        return response()->json($result);
    }
}
