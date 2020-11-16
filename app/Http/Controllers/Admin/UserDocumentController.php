<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Doc;
use App\Models\DocPosition;
use App\Models\DocRubric;
use App\Models\Document;
use App\Models\Position;
use App\Models\Rubric;
use App\Models\UserConfirmDocument;
use App\Models\UserDocument;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserDocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
        $this->middleware('admin')->only(['getConfirmDocumentList','confirmUserDocumentByAdmin','deleteConfirmUserDocument']);
        View::share('menu', 'document');
    }


    public function index($user_id = null)
    {
        $is_own = 0;
        if($user_id == null) {
            $user_id = Auth::user()->user_id;
            $user = Auth::user();
            $is_own = 1;
        }
        else {
            $user = Users::find($user_id);
            if($user == null) abort(404);
        }

        $document_list = Document::where('is_show',1)->orderBy('sort_num','asc')->get();

        return  view('admin.document.index',[
            'document_list' => $document_list,
            'user_id' => $user_id,
            'user' => $user,
            'is_own' => $is_own
        ]);
    }


    public function getUserDocumentList(Request $request){
        $request->document_type = strtolower($request->document_type);

        $document[0]['document_url'] = $request->document_url;
        $document[0]['document_id'] = $request->document_id;
        $document[0]['document_icon'] = '/custom/image/image.png';
        $document[0]['document_mini_icon'] = 'other';
        $document[0]['document_type'] = $request->document_type;
        $document[0]['is_image'] = false;

        if(in_array($request->document_type,['gif','png','jpg','jpeg','JPG','PNG','JPEG','GIF'])){
            $document[0]['document_icon'] =  $request->document_url;
            $document[0]['document_mini_icon'] = 'image';
        }
        elseif(in_array($request->document_type,['doc','xlsx','pdf','csv','ppt'])){
            $document[0]['document_icon'] = '/custom/image/'.$request->document_type.'.png';
            $document[0]['document_mini_icon'] = $request->document_type;
        }
        else
            $document[0]['document_icon'] = '/custom/image/upload.png';


        return  view('admin.document.document-ajax-loop',[
            'document_list' => $document,
            'image_id' => $request->image_id
        ]);
    }

    public function saveDocumentList(Request $request){
        try {

            if(isset($request->user_document)){
                UserDocument::where('user_id',$request->user_id)->forcedelete();
                foreach ($request->user_document as $key => $item){
                    $user_document = new UserDocument();
                    $user_document->user_id = $request->user_id;
                    $user_document->document_url = $item;

                    if(isset($request->document_type[$key]))
                        $user_document->document_type = $request->document_type[$key];
                    if(isset($request->document_id[$key]))
                        $user_document->document_id = $request->document_id[$key];

                    $user_document->save();
                }
            }

            $user = Users::where('user_id',$request->user_id)->first();
            $user->is_individual = $request->is_individual;
            $user->save();


        }

        catch(Exception $ex){
            $result['error'] = 'Ошибка база данных';
            $result['status'] = false;
            return response()->json($result);
        }

        $result['message'] = 'Успешно сохранено';
        $result['status'] = true;
        return response()->json($result);
    }

    public function getConfirmDocumentList(Request $request)
    {
        $row = UserConfirmDocument::leftJoin('users','users.user_id','=','user_confirm_document.user_id')
            ->leftJoin('user_info','user_info.user_id','=','users.user_id')
            ->leftJoin('users as recommend','recommend.user_id','=','users.recommend_user_id')
            ->where('user_confirm_document.is_active',1)
            ->where('users.is_valid_document',0)
            ->orderBy('user_confirm_document.user_confirm_document_id','desc')
            ->select('users.*',
                'user_confirm_document.*',
                'user_info.*',
                'recommend.name as recommend_name',
                'recommend.user_id as recommend_id',
                'recommend.login as recommend_login',
                'recommend.last_name as recommend_last_name',
                'recommend.user_id as recommend_user_id',
                DB::raw('DATE_FORMAT(user_confirm_document.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->user_name) && $request->user_name != '')
            $row->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->user_name .'%')
                    ->orWhere('users.last_name','like','%' .$request->user_name .'%')
                    ->orWhere('users.login','like','%' .$request->user_name .'%')
                    ->orWhere('users.email','like','%' .$request->user_name .'%')
                    ->orWhere('users.middle_name','like','%' .$request->user_name .'%');
            });

        if(isset($request->sponsor_name) && $request->sponsor_name != '')
            $row->where(function($query) use ($request){
                $query->where('recommend.name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.last_name','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.login','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.email','like','%' .$request->sponsor_name .'%')
                    ->orWhere('recommend.middle_name','like','%' .$request->sponsor_name .'%');
            });

        $row = $row->paginate(10);

        return  view('admin.document.confirm-list',[
            'row' => $row
        ]);
    }

    public function confirmUserDocumentByAdmin(Request $request)
    {
        if($request->is_valid_document == 1){
            $row = UserConfirmDocument::where('is_active',1)->where('user_id',$request->user_id)->update(['is_active' => '0']);
        }

        $row = Users::where('user_id',$request->user_id)->update(['is_valid_document' => $request->is_valid_document]);

        $result['message'] = 'Успешно сохранено';
        $result['status'] = true;
        return response()->json($result);
    }

    public function confirmUserDocument(Request $request)
    {
        $row = UserConfirmDocument::where('user_id',Auth::user()->user_id)->where('is_active',1)->first();

        $user = Users::where('user_id',Auth::user()->user_id)->first();
        $user->is_individual = $request->is_individual;
        $user->save();
        
        if($row != null){
            $result['error'] = 'Вы уже отправили запрос!';
            $result['status'] = false;
            return response()->json($result);
        }

        $row = new UserConfirmDocument();
        $row->user_id = Auth::user()->user_id;
        $row->is_active = 1;
        $row->save();



        $result['message'] = 'Успешно отправлено';
        $result['status'] = true;
        return response()->json($result);
    }

    public function deleteConfirmUserDocument(Request $request)
    {
        $user_confirm = UserConfirmDocument::find($request->id);
        $user_confirm->delete();
    }
}