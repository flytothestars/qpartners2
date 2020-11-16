<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;



class SliderController extends Controller
{

    public function getMediaList()
    {
        $row = Slider::where('is_show',1)->orderBy('sort_num','asc')->paginate(12);

        return  view('index.index.media',
            [
                'menu' => 'news',
                'row' => $row,
                'title' => 'Медия',
                'meta_description' => 'Медия. Trade logistic KZ'
            ]
        );
    }
}
