<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Instagram;
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

class InstagramController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');

        $users = Users::orderBy('user_id','asc')->where('status_id','>',3)->where('is_director_office',0)->where('status_id','!=',11)->get();
        View::share('users_row', $users);
    }

    public function sendRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {

            $result['error'] = 'Укажите необходимый параметр';
            $result['status'] = false;
            return response()->json($result);
        }

        $user_subscribe = UserSubscribe::where('sender_id',Auth::user()->user_id)->where('user_id',$request->user_id)->first();

        if($user_subscribe == null){
            $user_subscribe = new UserSubscribe();
            $user_subscribe->sender_id = Auth::user()->user_id;
            $user_subscribe->user_id = $request->user_id;
            $user_subscribe->is_success = 0;
            $user_subscribe->save();
        }

        $result['status'] = true;
        return response()->json($result);
    }

    public function sendRequestPartner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instagram_id' => 'required',
        ]);

        if ($validator->fails()) {

            $result['error'] = 'Укажите необходимый параметр';
            $result['status'] = false;
            return response()->json($result);
        }

        $user_subscribe = UserSubscribe::where('sender_id',Auth::user()->user_id)->where('instagram_id',$request->instagram_id)->first();

        if($user_subscribe == null){
            $user_subscribe = new UserSubscribe();
            $user_subscribe->sender_id = Auth::user()->user_id;
            $user_subscribe->instagram_id = $request->instagram_id;
            $user_subscribe->is_success = 0;
            $user_subscribe->save();
        }

        $result['status'] = true;
        return response()->json($result);
    }

    public function acceptRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {

            $result['error'] = 'Укажите необходимый параметр';
            $result['status'] = false;
            return response()->json($result);
        }

        $user_subscribe = UserSubscribe::where('user_subscribe_id',$request->id)->first();

        if($user_subscribe != null){
            $user_subscribe->is_success = 1;
            $user_subscribe->save();
        }

        $result['status'] = true;
        return response()->json($result);
    }


    public function rejectRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {

            $result['error'] = 'Укажите необходимый параметр';
            $result['status'] = false;
            return response()->json($result);
        }

        $user_subscribe = UserSubscribe::where('user_subscribe_id',$request->id)->first();

        if($user_subscribe != null){
            $user_subscribe->is_success = 0;
            $user_subscribe->save();
        }

        $result['status'] = true;
        return response()->json($result);
    }

    public function showInstagramRequest(Request $request)
    {
        $row = UserSubscribe::leftJoin('users','users.user_id','=','user_subscribe.sender_id')
                            ->where('user_subscribe.user_id',Auth::user()->user_id)
                            ->select('users.*',
                                     'user_subscribe.user_subscribe_id',
                                     'user_subscribe.is_success'
                                )
                            ->paginate(1000);

        return  view('admin.instagram.request-partner',[
            'partners' => $row
        ]);
    }

    public function showInstagramRequestCorporative(Request $request)
    {
        $row = UserSubscribe::leftJoin('instagram','instagram.instagram_id','=','user_subscribe.instagram_id')
            ->leftJoin('users','users.user_id','=','user_subscribe.sender_id')
            ->where('user_subscribe.instagram_id',">",0)
            ->where('instagram.type',"=",0)
            ->select('users.*',
                'instagram.instagram as corporative_instagram',
                'instagram.name as corporative_name',
                'user_subscribe.user_subscribe_id',
                'user_subscribe.is_success'
            )
            ->paginate(1000);

        return  view('admin.instagram.request-corporative',[
            'partners' => $row
        ]);
    }

    public function showInstagramRequestRecommend(Request $request)
    {
        $row = UserSubscribe::leftJoin('instagram','instagram.instagram_id','=','user_subscribe.instagram_id')
            ->leftJoin('users','users.user_id','=','user_subscribe.sender_id')
            ->where('user_subscribe.instagram_id',">",0)
            ->where('instagram.type',"=",1)
            ->select('users.*',
                'instagram.instagram as corporative_instagram',
                'instagram.name as corporative_name',
                'user_subscribe.user_subscribe_id',
                'user_subscribe.is_success'
            )
            ->paginate(1000);

        return  view('admin.instagram.request-corporative',[
            'partners' => $row
        ]);
    }

    public function index(Request $request)
    {
        $user_id = Auth::user()->recommend_user_id;

        $counter = 0;
        $users = array();

        while ($user_id != null) {
            $parent = Users::where('user_id', $user_id)
                            ->select('user_id',
                                     'instagram',
                                     'recommend_user_id',
                                     'name',
                                     'avatar',
                                     'login'
                            )
                            ->first();

            if ($parent == null) break;
            $user_id = $parent->recommend_user_id;
            $counter++;

            $users[] = $parent;

            if($counter > 20){
                break;
            }
        }

        return  view('admin.instagram.partners',[
            'row' => $request,
            'title' => 'Партнеры',
            'partners' => $users
        ]);
    }

    public function showCorporative(Request $request)
    {
        $row = Instagram::where('type','0')->orderBy('sort_num','asc');

        $row = $row->paginate(100);

        return  view('admin.instagram.corporative',[
            'partners' => $row
        ]);
    }

    public function showRecommend(Request $request)
    {
        $row = Instagram::where('type','1')->orderBy('sort_num','asc');

        $row = $row->paginate(100);

        return  view('admin.instagram.recommend',[
            'partners' => $row
        ]);
    }

    public function create()
    {
        $row = new Instagram();
        $row->instagram_image = '/media/default.jpg';

        return  view('admin.instagram.instagram-edit', [
            'title' => 'Добавить аккаунт',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instagram' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.instagram.instagram-edit', [
                'title' => 'Добавить аккаунт',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $instagram = new Instagram();
        $instagram->name = $request->name;
        $instagram->instagram = $request->instagram;
        $instagram->type = $request->type;
        $instagram->avatar = $request->avatar;
        $instagram->sort_num = is_numeric($request->sort_num)?$request->sort_num:1000;
        $instagram->save();

        $url = 'corporative';
        if($request->type == 1)
            $url = 'recommend';

        return redirect('/admin/instagram/'.$url);
    }

    public function edit($id)
    {
        $row = Instagram::find($id);

        return  view('admin.instagram.instagram-edit', [
            'title' => 'Изменить аккаунт',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'instagram' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.instagram.instagram-edit', [
                'title' => 'Изменить аккаунт',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $instagram = Instagram::find($id);
        $instagram->name = $request->name;
        $instagram->instagram = $request->instagram;
        $instagram->type = $request->type;
        $instagram->avatar = $request->avatar;
        $instagram->sort_num = is_numeric($request->sort_num)?$request->sort_num:1000;
        $instagram->save();

        $url = 'corporative';
        if($request->type == 1)
            $url = 'recommend';

        return redirect('/admin/instagram/'.$url);
    }

    public function destroy($id)
    {
        $instagram = Instagram::find($id);
        $instagram->delete();
    }
}
