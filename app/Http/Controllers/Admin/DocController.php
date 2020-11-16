<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Doc;
use App\Models\DocPosition;
use App\Models\DocRubric;
use App\Models\Position;
use App\Models\Rubric;
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

class DocController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
        View::share('menu', 'doc');
    }

    public function index(Request $request)
    {
        $row = Doc::orderBy('doc_id', 'desc')
            ->groupBy('doc.doc_id')
            ->select('doc.*',
                DB::raw('DATE_FORMAT(doc.created_at,"%d.%m.%Y %H:%i") as date'));

        if (isset($request->active))
            $row->where('doc.is_show', $request->active);
        else $row->where('doc.is_show', '1');

        if (isset($request->doc_name) && $request->doc_name != '') {
            $row->where(function ($query) use ($request) {
                $query->where('doc_name_ru', 'like', '%' . $request->doc_name . '%')
                    ->orWhere('doc_name_kz', 'like', '%' . $request->doc_name . '%')
                    ->orWhere('doc_name_kz', 'like', '%' . $request->doc_name . '%');
            });
        }

        if (isset($request->specialization_id)) {
            $row->where('specialization_id', $request->specialization_id);
        }

        $row = $row->paginate(20);

        return view('admin.doc.doc', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Doc();

        return view('admin.doc.doc-edit', [
            'title' => 'Добавить документ',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doc_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.doc.doc-edit', [
                'title' => 'Добавить документ',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $doc = new Doc();

        $doc->doc_name_ru = $request->doc_name_ru;
        $doc->doc_name_kz = ($request->doc_name_kz != null) ? $request->doc_name_kz : $request->doc_name_ru;
        $doc->sort_num = $request->sort_num ? $request->sort_num : 100;

        if (isset($request->doc_pdf_ru)) {
            $doc->doc_pdf_ru = $this->uploadPDF($request, 'ru');
        }

        if (isset($request->doc_pdf_kz)) {
            $doc->doc_pdf_kz = $this->uploadPDF($request, 'kz');
        }

        $doc->save();


        return redirect('/admin/doc');
    }

    public function edit($id)
    {
        $row = Doc::where('doc_id', $id)->select('*')->first();

        return view('admin.doc.doc-edit', [
            'title' => 'Изменить документ',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'doc_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.doc.doc-edit', [
                'title' => 'Изменить документ',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $doc = Doc::find($id);

        $doc->doc_name_ru = $request->doc_name_ru;
        $doc->doc_name_kz = ($request->doc_name_kz != null) ? $request->doc_name_kz : $request->doc_name_ru;
        $doc->sort_num = $request->sort_num ? $request->sort_num : 100;
        /* $lang = 'ru';
         $file = $request['doc_pdf_'.$lang];
         dd($file);*/

        if ($request->doc_pdf_ru != null) $doc->doc_pdf_ru = $this->uploadPDF($request, 'ru');
        if ($request->doc_pdf_kz != null) $doc->doc_pdf_kz = $this->uploadPDF($request, 'kz');

        $doc->save();

        return redirect('/admin/doc');
    }

    public function destroy($id)
    {
        $doc = Doc::find($id);
        $doc->delete();
    }

    public function changeIsShow(Request $request)
    {
        $doc = Doc::find($request->id);
        $doc->is_show = $request->is_show;
        $doc->save();
    }

    public function uploadPDF(Request $request, $lang)
    {
        $file = $request['doc_pdf_' . $lang];
        $file_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        if ($file->getClientSize() > 200097152) {
            return 'error2';
        }

        $destinationPath = '/pdf/' . date('Y') . '/' . date('m') . '/' . date('d');

        $file_name = $destinationPath . '/' . $file_name;

        if (Storage::disk('image')->exists($file_name)) {
            $now = \DateTime::createFromFormat('U.u', microtime(true));
            $file_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
        }

        Storage::disk('image')->put($file_name, File::get($file));
        /*  $result['success'] = true;
          $result['file_name'] = '/file' .$file_name;*/
        return '/file' . $file_name;
    }
}