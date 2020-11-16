<?php

namespace App\Http\Controllers\Index;

use App\Models\City;
use App\Models\Representative;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RepresentativeController extends Controller
{
    public function show()
    {
        $representatives = Representative::where(['is_active' => true])->get();
        $representatives = collect($representatives)->all();
        $cities = array_map(function ($item) {
            return $item->city_id;
        }, $representatives);
        $cities = array_unique($cities);

        $cities = City::whereIn('city_id', $cities)->get();


        return view('design_index.representative.show', ['cities' => $cities]);

    }
}
