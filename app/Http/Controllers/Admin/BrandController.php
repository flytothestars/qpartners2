<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
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
        $brands = Brand::all();

        return view('admin.brand.index', [
            'brands' => $brands,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *s
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Brand $brand */
        $messages = ['required' => 'Необходимо заполнить поля название бренда'];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return view('admin.brand.create');
        }
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->image = $request->image;
        $brand->is_show = $request->is_show;
        if ($brand->save()) {
            return redirect('admin/brand/');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $brand = Brand::where(['id' => $id])->first();
        return view('admin.brand.edit', [
            'brand' => $brand
        ]);
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
        $messages = ['required' => 'Необходимо заполнить поля название бренда'];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $messages);

        $brand = Brand::where(['id' => $id])->first();

        if ($validator->fails()) {
            return view('admin.brand.edit');
        }

        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->image = $request->image;
        $brand->is_show = false;
        if ($request->is_show) {
            $brand->is_show = true;
        }
        if ($brand->save()) {
            return redirect('admin/brand/');
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
        $brand = Brand::find($id);
        $brand->delete();
    }
}
