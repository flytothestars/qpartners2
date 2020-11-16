<?php

namespace App\Http\Controllers\Index;

use App\Models\Favorite;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    function get_ip()
    {
        /*
         * get current client ip address
         */

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;

    }

    public function get_mac_address()
    {

        $MAC = exec('getmac');
        $MAC = strtok($MAC, ' ');

        return $MAC;

    }


    /**
     * Display a list of the items, checked by user
     * @param int user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */

    public function showUserItems()
    {


        if (!Auth::user()) {
            $favorites = Favorite::where(['ip_address' => $this->get_mac_address()])->get();
        } else {
            $favorites = Favorite::where(['user_id' => Auth::user()->user_id])->get();
        }

        $favorites = collect($favorites)->all();
        $favorites = array_map(function ($item) {
            return $item['item_id'];
        }, $favorites);


        $products = Product::whereIn('product_id', $favorites)->get();


        return view('design_index.favorite.user_items', ['favorites' => $favorites, 'products' => $products]);
    }

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
        //
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

    private function addItemToFavorites($user_id, $session_id, $item_id)
    {
        $favorite = Favorite::where(function ($query) use ($user_id, $session_id) {
            if (Auth::user()) {
                $query->where(['user_id' => $user_id]);
            } else {
                $query->where(['ip_address' => $this->get_mac_address()]);
            }


        })->where(['item_id' => $item_id])->first();

        if (count($favorite) && $favorite->delete()) {
            return 2; // successfully remove item from favorite
        }

        $ip_address = $user_id ? null : $this->get_mac_address();
        $is_auth = $user_id ? true : false;
        $favorite = new Favorite();
        $favorite->user_id = $user_id;
//        $favorite->session_id = $session_id;
        $favorite->ip_address = $ip_address;
        $favorite->item_id = $item_id;
        $favorite->is_authorized = $is_auth;
        $favorite->is_active = true;
        if (!$favorite->save()) {
            return 0;
        }
        return 1;
    }

    private function addAfterAuthToFavorites($user_id, $item_id)
    {
        $favorites = Favorite::where(['ip_address' => $this->get_mac_address()])->where(['is_authorized' => false])->get();

        $favoriteIds = collect($favorites)->all();
        $favoriteIds = array_map(function ($item) {
            return $item['item_id'];
        }, $favoriteIds);


        $duplicatedAfterAuthItem = Favorite::where(['user_id' => $user_id])
            ->where(['is_authorized' => true])
            ->whereIn('item_id', $favoriteIds)
            ->get();

        foreach ($duplicatedAfterAuthItem as $item) {
            $item->delete();
        }

        if (!count($favorites)) {
            return 0;
        }


        foreach ($favorites as $favorite) {
            $favorite->user_id = $user_id;
            $favorite->is_authorized = true;
            $favorite->ip_address = NULL;
            if (!$favorite->save()) {
                return 0;
            }
        }
        return 1;
    }

    public function cancelItemAfterAuth($user_id)
    {
        $favorites = Favorite::where(['ip_address' => $this->get_mac_address()])->where(['is_authorized' => false])->get();

        foreach ($favorites as $favorite) {
            $favorite->is_authorized = true;
            if (!$favorite->save()) {
                return 0;
            }
        }
        return 5;
    }

    /**
     *  Redirect to the right method (Adapter method)
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function isAjax(Request $request)
    {

        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Запрос не является ajax',
                'data' => [],
            ]);
        }

        $item_id = $request->item_id;
        $user_id = $request->user_id;
        $session_id = $request->session_id;
        $method = $request->method_name;

        switch ($method) {
            case 'add':
                $check = $this->addItemToFavorites($user_id, $session_id, $item_id);
                if ($check == 0) {
                    return response()->json([
                        'success' => 0,
                        'message' => 'Произошла ошибка',
                        'data' => []
                    ]);
                } elseif ($check == 2) {
                    return response()->json([
                        'success' => 2,
                        'message' => 'Вы успешно удалили продукт из избранных',
                        'data' => [],
                    ]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Вы успешно добавили продукт в избранные',
                    'data' => [],
                ]);
                break;
            case 'addAfterAuth':
                $check = $this->addAfterAuthToFavorites($user_id, $item_id);
                if ($check == 0) {
                    return response()->json([
                        'success' => 0,
                        'message' => 'Произошла ошибка',
                        'data' => []
                    ]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Вы успешно добавили продукт в избранные',
                    'data' => [],
                ]);
                break;
            case 'cancelItem':
                $check = $this->cancelItemAfterAuth($user_id);
                if ($check == 0) {
                    return response()->json([
                        'success' => 0,
                        'message' => 'Произошла ошибка',
                        'data' => []
                    ]);
                } elseif ($check == 5) {
                    return response()->json([
                        'success' => 1,
                        'message' => 'Вы успешно отменили',
                        'data' => []
                    ]);
                }
        }
    }
}
