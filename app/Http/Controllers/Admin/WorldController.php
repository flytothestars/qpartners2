<?php

namespace App\Http\Controllers\Admin;

use App\Models\Packet;
use App\Models\UserPacket;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DB;
use View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WorldController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
    }

    public function clientList(Request $request,$url)
    {
        $packet = Packet::where('is_show',1)->where('packet_url',$url)->first();
        if($packet == null) abort(404);

        if(Auth::user()->role_id != 1) if(UserPacket::where('packet_id',$packet->packet_id)->where('is_active','1')->where('user_id',Auth::user()->user_id)->count() == 0) abort(404);

        $request->first_level_without_queue = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
                         ->leftJoin('city','city.city_id','=','users.city_id')
                         ->leftJoin('country','country.country_id','=','city.country_id')
                         ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                         ->where('user_packet.packet_id',$packet->packet_id)
                         ->where('user_packet.level',1)
                         ->where('user_packet.is_active',1)
                         ->where('user_packet.is_used',0)
                         ->where('users.deleted_at',null)
                         ->orderBy('user_packet.queue_start_position','asc')
                         ->take(10)
                         ->select('users.*','city.*','country.*',
                            DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                            'recommend.name as recommend_name',
                            'recommend.user_id as recommend_id',
                            'recommend.login as recommend_login',
                            'recommend.last_name as recommend_last_name',
                            'recommend.middle_name as recommend_middle_name',
                            'recommend.user_id as recommend_user_id'
                        )
                         ->get();

        $request->second_level_without_queue = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
                        ->leftJoin('city','city.city_id','=','users.city_id')
                        ->leftJoin('country','country.country_id','=','city.country_id')
                        ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                        ->where('user_packet.packet_id',$packet->packet_id)
                        ->where('user_packet.level',2)
                        ->where('user_packet.is_active',1)
                        ->where('user_packet.is_used',0)
                        ->where('users.deleted_at',null)
                        ->orderBy('user_packet.queue_start_position','asc')
                        ->take(10)
                        ->select('users.*','city.*','country.*',
                            DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                            'recommend.name as recommend_name',
                            'recommend.user_id as recommend_id',
                            'recommend.login as recommend_login',
                            'recommend.last_name as recommend_last_name',
                            'recommend.middle_name as recommend_middle_name',
                            'recommend.user_id as recommend_user_id'
                        )
                        ->get();

        $request->third_level_without_queue = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
                        ->leftJoin('city','city.city_id','=','users.city_id')
                        ->leftJoin('country','country.country_id','=','city.country_id')
                        ->where('user_packet.packet_id',$packet->packet_id)
                        ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                        ->where('user_packet.packet_id',$packet->packet_id)
                        ->where('user_packet.level',3)
                        ->where('user_packet.is_active',1)
                        ->where('user_packet.is_used',0)
                        ->where('users.deleted_at',null)
                        ->orderBy('user_packet.queue_start_position','asc')
                        ->take(10)
                        ->select('users.*','city.*','country.*',
                            DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                            'recommend.name as recommend_name',
                            'recommend.user_id as recommend_id',
                            'recommend.login as recommend_login',
                            'recommend.last_name as recommend_last_name',
                            'recommend.middle_name as recommend_middle_name',
                            'recommend.user_id as recommend_user_id'
                        )
                        ->get();

        $request->fourth_level_without_queue = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
                            ->leftJoin('city','city.city_id','=','users.city_id')
                            ->leftJoin('country','country.country_id','=','city.country_id')
                            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                            ->where('user_packet.packet_id',$packet->packet_id)
                            ->where('user_packet.level',4)
                            ->where('user_packet.is_active',1)
                            ->where('user_packet.is_used',0)
                            ->where('users.deleted_at',null)
                            ->orderBy('user_packet.queue_start_position','asc')
                            ->take(10)
                            ->select('users.*','city.*','country.*',
                                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                                'recommend.name as recommend_name',
                                'recommend.user_id as recommend_id',
                                'recommend.login as recommend_login',
                                'recommend.last_name as recommend_last_name',
                                'recommend.middle_name as recommend_middle_name',
                                'recommend.user_id as recommend_user_id'
                            )
                            ->get();

        $paginator_count = 10;
        if(Auth::user()->role_id == 1) $paginator_count = 30;

        $request->first_level = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
                        ->leftJoin('city','city.city_id','=','users.city_id')
                        ->leftJoin('country','country.country_id','=','city.country_id')
                        ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                        ->where('user_packet.packet_id',$packet->packet_id)
                        ->where('user_packet.level',1)
                        ->where('user_packet.is_active',1)
                        ->where('user_packet.recommend_user_count','>',4)
                        ->where('users.deleted_at',null)
                        ->orderBy('order_count','desc')
                        ->orderBy('user_packet.queue_now_position','asc')
                        ->select('user_packet.*','users.*','city.*','country.*',
                            DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                            'recommend.name as recommend_name',
                            'recommend.user_id as recommend_id',
                            'recommend.login as recommend_login',
                            'recommend.last_name as recommend_last_name',
                            'recommend.middle_name as recommend_middle_name',
                            'recommend.user_id as recommend_user_id',
                            DB::raw('case when user_packet.user_id = '.Auth::user()->user_id.' then 1 else 0 end as order_count')
                        );
        
        $request->is_exist_current_user_in_first_level = UserPacket::where('user_id',Auth::user()->user_id)
                                                            ->where('user_packet.recommend_user_count','>',4)
                                                            ->where('user_packet.level',1)
                                                            ->where('user_packet.packet_id',$packet->packet_id)
                                                            ->where('queue_now_position','>',0)
                                                            ->first();
        
        if($request->user_name != '' && $request->level == 1)
            $request->first_level->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%')
                    ->orWhere('users.middle_name','like','%' .$request->user_name .'%');
            });

        if($request->sponsor_name != '' && $request->level == 1)
            $request->first_level->where(function($query) use ($request){
                $query->where('recommend.name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.last_name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.login','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.email','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.middle_name','like','%' .$request->sponsor_name .'%');
            });

        if($request->city_name != '' && $request->level == 1)
            $request->first_level->where(function($query) use ($request){
                $query->where('city.city_name_ru','like','%' .$request->city_name .'%')
                    ->orWhere('country.country_name_ru','like','%' .$request->city_name .'%');
            });

        if($request->queue_now_position != '' && $request->level == 1)
            $request->first_level->where('user_packet.queue_now_position','like','%' .$request->queue_now_position .'%');

        $request->first_level = $request->first_level->paginate($paginator_count);



        $request->second_level = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
                                            ->leftJoin('city','city.city_id','=','users.city_id')
                                            ->leftJoin('country','country.country_id','=','city.country_id')
                                            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                                            ->where('user_packet.packet_id',$packet->packet_id)
                                            ->where('user_packet.level',2)
                                            ->where('user_packet.is_active',1)
                                            ->where('user_packet.recommend_user_count','>',0)
                                            ->where('users.deleted_at',null)
                                            ->orderBy('order_count','desc')
                                            ->orderBy('user_packet.queue_now_position','asc')
                                            ->select('user_packet.*','users.*','city.*','country.*',
                                                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                                                'recommend.name as recommend_name',
                                                'recommend.user_id as recommend_id',
                                                'recommend.login as recommend_login',
                                                'recommend.last_name as recommend_last_name',
                                                'recommend.middle_name as recommend_middle_name',
                                                'recommend.user_id as recommend_user_id',
                                                DB::raw('case when user_packet.user_id = '.Auth::user()->user_id.' then 1 else 0 end as order_count')
                                            );

        $request->is_exist_current_user_in_second_level = UserPacket::where('user_id',Auth::user()->user_id)
            ->where('user_packet.recommend_user_count','>',0)
            ->where('user_packet.level',2)
            ->where('user_packet.packet_id',$packet->packet_id)
            ->where('queue_now_position','>',0)
            ->first();

        if($request->user_name != '' && $request->level == 2)
            $request->second_level->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%')
                    ->orWhere('users.middle_name','like','%' .$request->user_name .'%');
            });

        if($request->sponsor_name != '' && $request->level == 2)
            $request->second_level->where(function($query) use ($request){
                $query->where('recommend.name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.last_name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.login','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.email','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.middle_name','like','%' .$request->sponsor_name .'%');
            });

        if($request->city_name != '' && $request->level == 2)
            $request->second_level->where(function($query) use ($request){
                $query->where('city.city_name_ru','like','%' .$request->city_name .'%')
                    ->orWhere('country.country_name_ru','like','%' .$request->city_name .'%');
            });

        if($request->queue_now_position != '' && $request->level == 2)
            $request->second_level->where('user_packet.queue_now_position','like','%' .$request->queue_now_position .'%');


        $request->second_level = $request->second_level->paginate($paginator_count);


        $request->third_level = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
                                            ->leftJoin('city','city.city_id','=','users.city_id')
                                            ->leftJoin('country','country.country_id','=','city.country_id')
                                            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                                            ->where('user_packet.packet_id',$packet->packet_id)
                                            ->where('user_packet.level',3)
                                            ->where('user_packet.is_active',1)
                                            ->where('user_packet.recommend_user_count','>',0)
                                            ->where('users.deleted_at',null)
                                            ->orderBy('order_count','desc')
                                            ->orderBy('user_packet.queue_now_position','asc')
                                            ->select('user_packet.*','users.*','city.*','country.*',
                                                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                                                'recommend.name as recommend_name',
                                                'recommend.user_id as recommend_id',
                                                'recommend.login as recommend_login',
                                                'recommend.last_name as recommend_last_name',
                                                'recommend.middle_name as recommend_middle_name',
                                                'recommend.user_id as recommend_user_id',
                                                DB::raw('case when user_packet.user_id = '.Auth::user()->user_id.' then 1 else 0 end as order_count')
                                            );

        $request->is_exist_current_user_in_third_level = UserPacket::where('user_id',Auth::user()->user_id)
                    ->where('user_packet.recommend_user_count','>',0)
                    ->where('user_packet.level',3)
                    ->where('user_packet.packet_id',$packet->packet_id)
                    ->where('queue_now_position','>',0)
                    ->first();

        if($request->user_name != '' && $request->level == 3)
            $request->third_level->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%')
                    ->orWhere('users.middle_name','like','%' .$request->user_name .'%');
            });

        if($request->sponsor_name != '' && $request->level == 3)
            $request->third_level->where(function($query) use ($request){
                $query->where('recommend.name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.last_name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.login','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.email','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.middle_name','like','%' .$request->sponsor_name .'%');
            });

        if($request->city_name != '' && $request->level == 3)
            $request->third_level->where(function($query) use ($request){
                $query->where('city.city_name_ru','like','%' .$request->city_name .'%')
                    ->orWhere('country.country_name_ru','like','%' .$request->city_name .'%');
            });

        if($request->queue_now_position != '' && $request->level == 3)
            $request->third_level->where('user_packet.queue_now_position','like','%' .$request->queue_now_position .'%');

        $request->third_level = $request->third_level->paginate($paginator_count);


        $request->fourth_level = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
                                            ->leftJoin('city','city.city_id','=','users.city_id')
                                            ->leftJoin('country','country.country_id','=','city.country_id')
                                            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                                            ->where('user_packet.packet_id',$packet->packet_id)
                                            ->where('user_packet.level',3)
                                            ->where('user_packet.is_active',1)
                                            ->where('user_packet.recommend_user_count','>',0)
                                            ->where('users.deleted_at',null)
                                            ->orderBy('order_count','desc')
                                            ->orderBy('user_packet.queue_now_position','asc')
                                            ->select('user_packet.*','users.*','city.*','country.*',
                                                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                                                'recommend.name as recommend_name',
                                                'recommend.user_id as recommend_id',
                                                'recommend.login as recommend_login',
                                                'recommend.last_name as recommend_last_name',
                                                'recommend.middle_name as recommend_middle_name',
                                                'recommend.user_id as recommend_user_id',
                                                DB::raw('case when user_packet.user_id = '.Auth::user()->user_id.' then 1 else 0 end as order_count')
                                            );

        $request->is_exist_current_user_in_fourth_level = UserPacket::where('user_id',Auth::user()->user_id)
                    ->where('user_packet.recommend_user_count','>',0)
                    ->where('user_packet.level',4)
                    ->where('user_packet.packet_id',$packet->packet_id)
                    ->where('queue_now_position','>',0)
                    ->first();

        if($request->user_name != '' && $request->level == 4)
            $request->fourth_level->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%')
                    ->orWhere('users.middle_name','like','%' .$request->user_name .'%');
            });

        if($request->sponsor_name != '' && $request->level == 4)
            $request->fourth_level->where(function($query) use ($request){
                $query->where('recommend.name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.last_name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.login','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.email','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.middle_name','like','%' .$request->sponsor_name .'%');
            });

        if($request->city_name != '' && $request->level == 4)
            $request->fourth_level->where(function($query) use ($request){
                $query->where('city.city_name_ru','like','%' .$request->city_name .'%')
                    ->orWhere('country.country_name_ru','like','%' .$request->city_name .'%');
            });

        if($request->queue_now_position != '' && $request->level == 4)
            $request->fourth_level->where('user_packet.queue_now_position','like','%' .$request->queue_now_position .'%');

        $request->fourth_level = $request->fourth_level->paginate($paginator_count);

        return  view('admin.world.client-list',[
            'row' => $request,
            'title' => 'Мировой фонд '.$packet->packet_name_ru,
            'packet_name' => $packet->packet_name_ru,
            'request' => $request,
            'packet' => $packet
        ]);
    }

    public function standart(Request $request)
    {
        if(Auth::user()->role_id != 1)
            if(UserPacket::where('packet_id',2)->where('is_active','1')->where('user_id',Auth::user()->user_id)->count() == 0) abort(404);

        $request->row = UserPacket::leftJoin('users','users.user_id','=','user_packet.user_id')
                    ->leftJoin('city','city.city_id','=','users.city_id')
                    ->leftJoin('country','country.country_id','=','city.country_id')
                    ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
                    ->where('user_packet.packet_id',2)
                    ->where('user_packet.is_active',1)
                    ->where('users.deleted_at',null)
                    ->orderBy('order_count','desc')
                    ->orderBy('user_packet.created_at','desc')
                    ->select('users.*','city.*','country.*',
                             DB::raw('DATE_FORMAT(user_packet.created_at,"%d.%m.%Y") as date'),
                            'recommend.name as recommend_name',
                            'recommend.user_id as recommend_id',
                            'recommend.login as recommend_login',
                            'recommend.last_name as recommend_last_name',
                            'recommend.middle_name as recommend_middle_name',
                            'recommend.user_id as recommend_user_id',
                             DB::raw('case when user_packet.user_id = '.Auth::user()->user_id.' then 1 else 0 end as order_count')
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

        return  view('admin.world.standart',[
            'row' => $request,
            'title' => 'Пакет "Стандарт"',
            'request' => $request
        ]);
    }
}
