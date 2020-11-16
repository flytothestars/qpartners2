<?php

namespace App\Http\Controllers\Admin;

use App\Models\Packet;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class PacketItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $row = Packet::where(function($query) use ($request){
            $query->where('packet_name_kz','like','%' .$request->search .'%')
                ->orWhere('packet_name_ru','like','%' .$request->search .'%')
                ->orWhere('packet_name_en','like','%' .$request->search .'%');
        })
            ->orderBy('packet_id','desc')
            ->select('packet.*',
                DB::raw('DATE_FORMAT(packet.created_at,"%d.%m.%Y %H:%i") as date'));

        // if(isset($request->active))
        //     $row->where('is_show',$request->active);
        // else $row->where('is_show','1');
        
        $row = $row->paginate(20);

        return  view('admin.packet.packet',[
            'row' => $row,
            'request' => $request
        ]);
    }
    
    public function edit($id)
    {
        $row = Packet::select('packet.*')
            ->where('packet.packet_id',$id)
            ->first();
     
        return  view('admin.packet.packet-edit', [
            'title' => 'Изменить проект',
            'row' => $row
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'packet_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.packet.packet-edit', [
                'title' => 'Изменить проект',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $packet = Packet::find($id);
        $packet->packet_name_ru = $request->packet_name_ru;
        $packet->packet_share = is_numeric($request->packet_share)?$request->packet_share:0;
        $packet->packet_thing = $request->packet_thing;
        $packet->packet_lection = $request->packet_lection;
        $packet->packet_image = $request->packet_image;
        $packet->sort_num = ($request->sort_num=='')?1000:$request->sort_num;
        $packet->packet_price = $request->packet_price;
        $packet->is_show = $request->is_show;
        // dd($request->is_show);
        $packet->save();
        
        return redirect('/admin/packet-item');
    }

  
}
