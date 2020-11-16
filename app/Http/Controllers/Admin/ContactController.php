<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }

    public function index(Request $request)
    {
        $row = Contact::where(function($query) use ($request){
            $query->where('user_name','like','%' .$request->search .'%')
                ->orWhere('phone','like','%' .$request->search .'%')
                ->orWhere('message','like','%' .$request->search .'%')
                ->orWhere('email','like','%' .$request->search .'%');
        })
            ->orderBy('contact_id','desc')
            ->select('contact.*',
                DB::raw('DATE_FORMAT(contact.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('is_show',$request->active);
        else $row->where('is_show','1');

        $row = $row->paginate(20);

        return  view('admin.contact.contact',[
            'row' => $row,
            'request' => $request
        ]);
    }

   
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
    }

    public function changeIsShow(Request $request){
        $contact = Contact::find($request->id);
        $contact->is_show = $request->is_show;
        $contact->save();
    }
}
