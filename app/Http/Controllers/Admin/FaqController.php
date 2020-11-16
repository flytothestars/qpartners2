<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;

class FaqController extends Controller
{


    public function __construct()
    {
        $this->middleware('adminWebsite');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faqs.index', ['faqs' => $faqs]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Необходимо заполнить поле :attribute',
            'min:5' => 'Минимальное количество символов должно быть 5'
        ];

        $validator = Validator::make($request->all(), [
            'answer' => 'required|min:5',
            'question' => 'required|min:5',
        ], $messages);


        $faq = new Faq();
        $faq->fill($request->all());
        if ($faq->save()) {
            return redirect('admin/faq');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $faq = Faq::find($id);

        return view('admin.faqs.edit', ['faq' => $faq]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $messages = [
            'required' => 'Необходимо заполнить поле :attribute',
            'min:5' => 'Минимальное количество символов должно быть 5',
        ];

        $validator = Validator::make($request->all(), [
            'answer' => 'required|min:5',
            'question' => 'required|min:5',
        ], $messages);


        if ($validator->fails()) {
            $messages = $validator->errors();
            $errors = $messages->all();
            $errorResults = 'Необходимо исправить следующие ошибки' . '<br>';
            foreach ($errors as $error) {
                $errorResults .= '&nbsp;' . $error . '<br>';
            }

            $request->session()->flash('danger', $errorResults);
            return back();
        }
        $faq = Faq::where(['id' => $id])->first();

        $faq->is_active = false;
        if ($request->is_active) {
            $faq->is_active = true;
        }
        $faq->answer = $request->answer;
        $faq->question = $request->question;
        $faq->order = $request->order;
        if ($faq->save()) {
            $request->session()->flash('success', 'Вы успешно изменили FAQ');
            return redirect('admin/faq');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);
        $faq->delete();
    }
}
