<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;

class RepresentativeController extends Controller
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
        $representatives = Representative::all();
        return view('admin.representative.index', ['representatives' => $representatives]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.representative.create');
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
            'city_id' => 'required',
            'full_name' => 'required|min:5',
            'phone_number' => 'required|min:5',
            'address' => 'required',
            'whatsapp' => 'min:5',
        ], $messages);


        $representative = new Representative();
        $representative->fill($request->all());
        $representative->is_active = isset($request->is_active) ? 1 : 0;
        if ($representative->save()) {
            return redirect('admin/representative');
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
        $representative = Representative::find($id);

        return view('admin.representative.edit', ['representative' => $representative]);
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
            'city_id' => 'required',
            'full_name' => 'required|min:5',
            'phone_number' => 'required|min:5',
            'whatsapp' => 'min:5',
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
        $representative = Representative::where(['id' => $id])->first();


        $representative->fill($request->all());
        $representative->is_active = false;
        if ($request->is_active) {
            $representative->is_active = true;
        }
        if ($representative->save()) {
            $request->session()->flash('success', 'Вы успешно изменили представителя');
            return redirect('admin/representative');
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
        $representative = Representative::find($id);
        $representative->delete();
    }
}
