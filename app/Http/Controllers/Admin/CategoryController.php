<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;


class CategoryController extends Controller
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
        $categories = Category::all();
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {

        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages = array(
            'required' => 'Необходимо заполнить поле "Название категорий"',
            'max' => 'Максимальное длинна название 100 символов'
        );

        $validator = Validator::make($request->all(),
            ['name' => 'required|max:100']
            , $messages);


        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.category.create', [
                'error' => $error[0],
            ]);
        }

        $category = new Category();
        $category->fill($request->all());

        if ($category->save()) {
            return redirect('/admin/category');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
//        $categories = Category::where(['id' => $id])->first();
//        return view('admin.category.edit', [
//            'categories' => $categories,
//        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where(['id' => $id])->first();
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $messages = array(
            'required' => 'Необходимо заполнить поле "Название категорий"',
            'max' => 'Максимальное длинна название 100 символов'
        );

        $validator = Validator::make($request->all(),
            ['name' => 'required|max:100']
            , $messages);


        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.category.edit', [
                'error' => $error[0],
            ]);
        }
        $category = Category::where(['id' => $id])->first();
        $category->fill($request->all());
        if ($request->is_show) {
            $category->is_show = 1;
        } else {
            $category->is_show = 0;
        }

        if ($category->save()) {
            return redirect('/admin/category');
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
        $category = Category::find($id);
        $category->delete();
    }
}
