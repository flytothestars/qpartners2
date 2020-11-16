<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Fond;
use App\Models\UserOperation;
use App\Models\UserPacket;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class SpeakerController extends Controller
{
    public function __construct()
    {
        // if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
        //     error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        // }
        $users = Users::orderBy('user_id','asc')->get();
        View::share('users_row', $users);

        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $request->row = Users::leftJoin('city','city.city_id','=','users.city_id')
                            ->leftJoin('country','country.country_id','=','city.country_id')
                            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                            ->orderBy('users.user_id','desc')
                            ->where('users.is_speaker',1)
                            ->select('users.*','city.*','country.*',
                                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y") as date'),
                                'recommend.name as recommend_name',
                                'recommend.user_id as recommend_id',
                                'recommend.login as recommend_login',
                                'recommend.last_name as recommend_last_name',
                                'recommend.middle_name as recommend_middle_name',
                                'recommend.user_id as recommend_user_id'
                            );

        if(isset($request->user_name) && $request->user_name != '')
            $request->row->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%')
                    ->orWhere('users.middle_name','like','%' .$request->user_name .'%');
            });

        if(isset($request->sponsor_name) && $request->sponsor_name != '')
            $request->row->where(function($query) use ($request){
                $query->where('recommend.name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.last_name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.login','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.email','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.middle_name','like','%' .$request->sponsor_name .'%');
            });

        if(isset($request->city_name) && $request->city_name != '')
            $request->row->where(function($query) use ($request){
                $query->where('city.city_name_ru','like','%' .$request->city_name .'%')
                    ->orWhere('country.country_name_ru','like','%' .$request->city_name .'%');
            });
        
        $request->row = $request->row->paginate(10);

        return  view('admin.speaker.speaker',[
            'row' => $request,
            'title' => 'Спикеры',
            'request' => $request
        ]);
    }

    public function showAddUserSpeaker()
    {
        $row = new UserOperation();

        return  view('admin.speaker.speaker-add', [
            'title' => 'Добавить спикера',
            'row' => $row
        ]);
    }

    public function addUserSpeaker(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.speaker.speaker-add', [
                'title' => 'Добавить спикера',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $user = Users::where('user_id',$request->user_id)->first();
        $user->is_speaker = 1;
        $user->save();

        return redirect('/admin/speaker');
    }

    public function deleteUserSpeaker($id){
        $user = Users::find($id);
        $user->is_speaker = 0;
        $user->save();
    }
}
