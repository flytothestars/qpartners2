<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $news_category = NewsCategory::all();
        return view('admin.news_category.index', ['news_category' => $news_category, 'controllerName' => 'news-category']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.news_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $messages = ['required' => 'Необходимо заполнить поля название категорий'];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return view('admin.news_category.create');
        }
        $newsCategory = new NewsCategory();
        $newsCategory->name = $request->name;
        $newsCategory->description = $request->description;
        $newsCategory->is_active = $request->is_active;
        if ($newsCategory->save()) {
            return redirect('admin/news-category/');
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
        $newsCategory = NewsCategory::find($id);
        return view('admin.news_category.edit', ['category' => $newsCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $newsCategory = NewsCategory::where(['id' => $id])->first();

        $messages = ['required' => 'Необходимо заполнить поля название категорий'];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return view('admin.news_category.create');
        }
        $newsCategory->name = $request->name;
        $newsCategory->description = $request->description;
        $newsCategory->is_active = false;
        if (isset($request->is_active)) {
            $newsCategory->is_active = true;
        }
        if ($newsCategory->save()) {
            return redirect('admin/news-category/');
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
        //
    }
}
