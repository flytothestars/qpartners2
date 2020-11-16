<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\UserOperation;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;
use App\Models\Users;

class OperationController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
        $this->middleware('admin', ['only' => ['accountingList']]);
    }

    public function index(Request $request)
    {
        $row = UserOperation::leftJoin('users','users.user_id','=','user_operation.author_id')
            ->leftJoin('users as recipient_user','recipient_user.user_id','=','user_operation.recipient_id')
            ->leftJoin('operation','operation.operation_id','=','user_operation.operation_id')
            ->leftJoin('operation_type','operation_type.operation_type_id','=','user_operation.operation_type_id')
            ->leftJoin('fond','fond.fond_id','=','user_operation.fond_id')
            ->where('operation.operation_name_ru','like','%' .$request->operation .'%')
            ->where('operation_type.operation_type_name_ru','like','%' .$request->operation_type .'%')
            ->orderBy('user_operation_id','desc')
            ->select('users.*',
                'user_operation.money',
                'user_operation.operation_type_id',
                'user_operation.operation_comment',
                'user_operation.operation_id',
                'operation.operation_name_ru',
                'fond.fond_name_ru',
                'operation_type.operation_type_name_ru',
                'recipient_user.name as recipient_name',
                'recipient_user.login as recipient_login',
                'recipient_user.email as recipient_email',
                'recipient_user.user_id as recipient_id',
                'recipient_user.last_name as recipient_last_name',
                DB::raw('DATE_FORMAT(user_operation.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->user_id) && $request->user_id > 0){
            $row->where('recipient_user.user_id',$request->user_id);
        }

        if(isset($request->user_name) && $request->user_name != ''){
            $row->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%');
            });
        }

        if(isset($request->recipient_name) && $request->recipient_name != ''){
            $row->where(function($query) use ($request){
                $query->where('recipient_user.name','like','%' .$request->recipient_name .'%')
                    ->orWhere('recipient_user.last_name','like','%' .$request->recipient_name .'%')
                    ->orWhere('recipient_user.login','like','%' .$request->recipient_name .'%')
                    ->orWhere('recipient_user.email','like','%' .$request->recipient_name .'%');
            });
        }

        if(isset($request->operation_type) && $request->operation_type != ''){
            $row->where(function($query) use ($request){
                $query->where('operation_type.operation_type_name_ru','like','%' .$request->operation_type .'%');
            });
        }

        if(isset($request->operation) && $request->operation != ''){
            $row->where(function($query) use ($request){
                $query->where('operation.operation_name_ru','like','%' .$request->operation .'%');
            });
        }

        if(isset($request->date_from) && $request->date_from != ''){
            $timestamp = strtotime($request->date_from);
            $row->where(function($query) use ($timestamp){
                $query->where('user_operation.created_at','>=',date("Y-m-d H:i", $timestamp));
            });
        }

        if(isset($request->date_to) && $request->date_to != ''){
            $timestamp = strtotime($request->date_to);
            $row->where(function($query) use ($timestamp){
                $query->where('user_operation.created_at','<=',date("Y-m-d H:i", $timestamp));
            });
        }

        if(Auth::user()->role_id > 1) $row->where('user_operation.recipient_id',Auth::user()->user_id);

        $row_sum = clone ($row);
        $row_sum->where('user_operation.operation_type_id','!=',2);

        $row = $row->paginate(20);

        return  view('admin.operation.operation',[
            'row' => $row,
            'request' => $request,
            'title' => 'Счет',
            'row_sum' => $row_sum->sum('money')
        ]);
    }

    public function accountingList(Request $request){
    $request->row = Users::leftJoin('city','city.city_id','=','users.city_id')
        ->leftJoin('country','country.country_id','=','city.country_id')
        ->leftJoin('user_packet','user_packet.user_id','=','users.user_id')
        ->leftJoin('packet','packet.packet_id','=','user_packet.packet_id')
        ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
        ->where('users.user_money','>',0)
        ->orderBy('users.user_money','desc')
        ->select('users.*','city.*','country.*',
            DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
            'recommend.name as recommend_name',
            'recommend.login as recommend_login',
            'recommend.user_id as recommend_id',
            'recommend.last_name as recommend_last_name',
            'recommend.middle_name as recommend_middle_name',
            'recommend.user_id as recommend_user_id'
        )
        ->groupBy('users.user_id');

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

    if(isset($request->is_ban))
        $request->row->where('users.is_ban',$request->is_ban);
    else $request->row->where('users.is_ban','0');

    if(isset($request->packet_name) && $request->packet_name != ''){
        $request->row->where('packet.packet_name_ru','like','%' .$request->packet_name .'%')
            ->where('user_packet.is_active',1);
    }

    $request->row = $request->row->paginate(10);

    return  view('admin.operation.accounting',[
        'row' => $request,
        'title' => 'Учет',
        'request' => $request
    ]);
}

    public function autoBonusList(Request $request){
        $request->row = Users::leftJoin('city','city.city_id','=','users.city_id')
            ->leftJoin('country','country.country_id','=','city.country_id')
            ->leftJoin('user_packet','user_packet.user_id','=','users.user_id')
            ->leftJoin('packet','packet.packet_id','=','user_packet.packet_id')
            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
            ->where('users.auto_bonus','>',0)
            ->orderBy('users.user_money','desc')
            ->select('users.*','city.*','country.*',
                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                'recommend.name as recommend_name',
                'recommend.login as recommend_login',
                'recommend.user_id as recommend_id',
                'recommend.last_name as recommend_last_name',
                'recommend.middle_name as recommend_middle_name',
                'recommend.user_id as recommend_user_id',
                'users.auto_bonus as user_money'
            )
            ->groupBy('users.user_id');

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

        if(isset($request->is_ban))
            $request->row->where('users.is_ban',$request->is_ban);
        else $request->row->where('users.is_ban','0');

        if(isset($request->packet_name) && $request->packet_name != ''){
            $request->row->where('packet.packet_name_ru','like','%' .$request->packet_name .'%')
                ->where('user_packet.is_active',1);
        }

        $request->row = $request->row->paginate(10);

        return  view('admin.operation.accounting',[
            'row' => $request,
            'title' => 'Автобонус',
            'request' => $request
        ]);
    }

    public function homeBonusList(Request $request){
        $request->row = Users::leftJoin('city','city.city_id','=','users.city_id')
            ->leftJoin('country','country.country_id','=','city.country_id')
            ->leftJoin('user_packet','user_packet.user_id','=','users.user_id')
            ->leftJoin('packet','packet.packet_id','=','user_packet.packet_id')
            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
            ->where('users.home_bonus','>',0)
            ->orderBy('users.user_money','desc')
            ->select('users.*','city.*','country.*',
                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'),
                'recommend.name as recommend_name',
                'recommend.login as recommend_login',
                'recommend.user_id as recommend_id',
                'recommend.last_name as recommend_last_name',
                'recommend.middle_name as recommend_middle_name',
                'recommend.user_id as recommend_user_id',
                'users.auto_bonus as user_money'
            )
            ->groupBy('users.user_id');

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

        if(isset($request->is_ban))
            $request->row->where('users.is_ban',$request->is_ban);
        else $request->row->where('users.is_ban','0');

        if(isset($request->packet_name) && $request->packet_name != ''){
            $request->row->where('packet.packet_name_ru','like','%' .$request->packet_name .'%')
                ->where('user_packet.is_active',1);
        }

        $request->row = $request->row->paginate(10);

        return  view('admin.operation.accounting',[
            'row' => $request,
            'title' => 'Жилищный бонус',
            'request' => $request
        ]);
    }
}
