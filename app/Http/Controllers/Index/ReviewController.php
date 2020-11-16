<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->item_id;

        $review = new Review();


        $validator = [
            'user_name' => 'required',
            'user_email' => 'required',
        ];

        $validateData = Validator::make($request->all(), $validator);

        if ($validateData->fails()) {
            return redirect('product/' . $id . '&tab=review')->withErrors($validateData)->withInput();
        }

        $review->fill($request->all());
        $review->user_id = Auth::user() ? Auth::user()->user_id : false;
        $review->item_id = $request->item_id;
        $review->review_type_id = $request->review_type_id;
        if ($review->save()) {
            if ($request->review_type_id == Review::NEWS_REVIEW) {
                return redirect('news/' . $id);
            } elseif ($request->review_type_id == Review::PRODUCT_REVIEW) {
                return redirect('product/' . $id . '&tab=review');
            }
        };


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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
