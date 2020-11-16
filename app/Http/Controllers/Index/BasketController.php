<?php


namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\UserBasket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id = null)
    {
        $basketItems = UserBasket::where(['user_id' => Auth::user()->user_id])->get();
        return view('design_index.basket.basket', [
            'basketItems' => $basketItems,
        ]);
    }

    public function addToBasket($item_id = null, $user_id = null)
    {

        $isItemInBasket = UserBasket::where(['product_id' => $item_id, 'user_id' => $user_id])->first();
//        -1 mean there is product in user
        if ($isItemInBasket) {
            return -1;
        }
        $basketItem = new UserBasket();
        $basketItem->product_id = $item_id;
        $basketItem->user_id = $user_id;
        $basketItem->is_active = true;

        if ($basketItem->save()) {
            return true;
        };
        return false;
    }

    public function deleteFromBasket($item_id = null, $user_id = null)
    {
        dd(DB::table('user_basket')->where('user_id', $user_id)->where('product_id', $item_id)->delete());
    }


    public function isAjax(Request $request)
    {
        $item_id = $request->item_id;
        $user_id = $request->user_id;
        $method = $request->method_name;

        if (!$item_id) {
            $request->session()->flash('danger', 'Продукт не найден!!!');
        }
        switch ($method) {
            case 'delete':
                if ($this->deleteFromBasket($item_id, $user_id)) {
                    return response()->json([
                        'method' => 'delete',
                        'success' => 1,
                        'message' => 'Вы успешно удалили продукт из корзины.',
                    ]);
                } else {
                    return response()->json([
                        'method' => 'delete',
                        'success' => 0,
                        'message' => 'При удаление продукта произошла ошибка!',
                    ]);
                }
            case 'add':
                if ($this->addToBasket($item_id, $user_id) == 1) {
                    return response()->json([
                        'method' => 'add',
                        'success' => 1,
                        'message' => 'Вы успешно добавили продукт в корзину.',
                    ]);
                } elseif ($this->addToBasket($item_id, $user_id) == -1) {
                    return response()->json([
                        'method' => 'add',
                        'success' => -1,
                        'message' => 'Продукт ранее был добавлен в корзину.',
                    ]);
                } else {
                    return response()->json([
                        'method' => 'add',
                        'success' => 0,
                        'message' => 'Ошибка при сохранение',
                    ]);
                }
        }
    }

}