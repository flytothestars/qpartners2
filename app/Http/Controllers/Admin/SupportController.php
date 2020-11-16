<?php

namespace App\Http\Controllers\Admin;

use App\Models\OpportunityFAQ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminWebsite');
    }


    public function index()
    {
        $opportunityFaqs = OpportunityFAQ::all();

        return view('admin.support.index', [
            'opportunityFaqs' => $opportunityFaqs,
        ]);
    }

    public function edit($id)
    {
        $opportunityFaq = OpportunityFAQ::where(['id' => $id])->first();
        return view('admin.support.edit', ['opportunityFaq' => $opportunityFaq]);
    }

    private function disActivate()
    {

    }

    private function Activate()
    {

    }

    private function destroy()
    {

    }

    private function changeStatus()
    {

    }

    public function isAjax()
    {

    }
}
