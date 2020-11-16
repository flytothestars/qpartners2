<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doc;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class PresentationController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
    }

    public function index(Request $request)
    {
        return  view('admin.presentation.presentation');
    }

    public function showDocumentList(Request $request)
    {
        $document = Doc::where('is_show',1)->orderBy('sort_num','asc')->get();

        return  view('admin.presentation.document',
            ['document' => $document]
        );
    }
}
