<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class BalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
    }

    public function index(Request $request,$url = null)
    {
        $row = Contact::where(function($query) use ($request){
            $query->where('user_name','like','%' .$request->search .'%')
                ->orWhere('phone','like','%' .$request->search .'%')
                ->orWhere('message','like','%' .$request->search .'%')
                ->orWhere('email','like','%' .$request->search .'%');
        })
            ->orderBy('contact_id','desc')
            ->select('contact.*',
                DB::raw('DATE_FORMAT(contact.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('is_show',$request->active);
        else $row->where('is_show','1');

        $row = $row->paginate(20);

        if($url != null && $url != 'success'){
            abort(404);
        }

        if($url == 'success'){
            $user = Auth::user();
            $user->user_money = $user->user_money + $user->paybox_balance;
            $user->paybox_balance = 0;
            $user->save();
        }
        
        return  view('admin.balance.balance',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function addBalance(Request $request)
    {
        if($request->balance <= 0){
            $result['error'] = 'Укажите корректную сумму';
            $result['status'] = false;
            return response()->json($result);
        }

        try {
            $user = Auth::user();
            $user->paybox_balance = $request->balance;
            $user->save();

            $href = "";

            $rand_str = "z";
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            for ($i = 0; $i < 10; $i++) {
                $rand_str .= $characters[rand(0, strlen($characters) - 1)];
            }

            include_once("PG_Signature.php");
            $MERCHANT_SECRET_KEY = "AFPWZXFUBoBL0RWb";

            $arrReq = array();

            $currency = Currency::where('currency_name','тенге')->first();

            /* Обязательные параметры */
            $arrReq['pg_merchant_id'] = 500436;// Идентификатор магазина
            $arrReq['pg_order_id']    = Auth::user()->user_id;		// Идентификатор заказа в системе магазина
            $arrReq['pg_amount']      = $request->balance * $currency->money;		// Сумма заказа
            $arrReq['pg_result_url']      = URL('/').  "/admin/balance/success?message=Успешно_добавлено";
            $arrReq['pg_success_url']      = URL('/'). "/admin/balance/success?message=Успешно_добавлено";
            $arrReq['pg_failure_url']      = URL('/'). "/admin/balance?error=Ошибка";
            $arrReq['pg_description'] = "Пополнение на QazaqMedia"; // Описание заказа (показывается в Платёжной системе)
            $arrReq['pg_salt'] = $rand_str;
            $arrReq['pg_request_method'] = "GET";
            $arrReq['pg_success_url_method'] = 'AUTOGET';
            $arrReq['pg_sig'] = \PG_Signature::make('payment.php', $arrReq, $MERCHANT_SECRET_KEY);

            $file = "log.txt";
            $current = file_get_contents($file);
            $current .= $arrReq['pg_merchant_id'] . "\n";
            $current .= $arrReq['pg_order_id'] . "\n";
            $current .= $arrReq['pg_amount'] . "\n";
            $current .= $arrReq['pg_result_url'] . "\n";
            $current .= $arrReq['pg_success_url'] . "\n";
            $current .= $arrReq['pg_failure_url'] . "\n";
            $current .= $arrReq['pg_description'] . "\n";
            $current .= $arrReq['pg_salt'] . "\n";
            $current .= $arrReq['pg_request_method'] . "\n";
            $current .= $arrReq['pg_success_url_method'] . "\n";
            $current .= $arrReq['pg_sig'] . "\n";

            $query = http_build_query($arrReq);
            $current .= $query . "\n";
            file_put_contents($file, $current);

            $href = $query;
            $result['href'] = $href;
        }
        catch (Exception $ex){
            $result['message'] = 'Ошибка база данных';
            $result['status'] = false;
            return response()->json($result);
        }


        $result['message'] = 'Вы успешно отправили запрос';
        $result['status'] = true;
        return response()->json($result);
    }
}
