<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Packet;
use App\Models\Users;
use App\Models\UserPacket;
use App\Models\UserOperation;
use App\Models\UserStatus;
use App\Models\Product;
use App\Models\Order;
use App\Models\UserBasket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers;

class SmartPayController extends Controller
{
    public $sentMoney = 0;
    public function createOrder(Request $request) {
        $result['message'] = 'Временно недоступно';
        $result['status'] = false;
        if (!$request->packet_id) {                        
            return response()->json($result);
        }
        if (!Auth::check()) {                
            return response()->json($result);
        }
        $price = 0;
        $order_code = time();        
        $packet_old_price = 0; 
        $packet = Packet::where('packet_id', $request->packet_id)->first();       
        if (!$packet) {
            return response()->json($result);
        }
        if ($packet->is_upgrade_packet == 1) {

            $is_check = UserPacket::where('user_id', Auth::user()->user_id)
                ->where('is_active', '=', '0')
                ->where('user_packet.packet_id', '!=', 9)
                ->where('is_portfolio', '=', $packet->is_portfolio)
                ->count();

            if ($is_check > 0) {
                $result['message'] = 'Вы уже отправили запрос на другой пакет, сначала отмените тот запрос';
                $result['status'] = false;
                return response()->json($result);
            }

            if ($request->packet_id > 2) {
                $is_check = UserPacket::where('user_id', Auth::user()->user_id)
                    ->where('packet_id', '>=', $request->packet_id)
                    ->where('is_portfolio', '=', $packet->is_portfolio)
                    ->where('user_packet.packet_id', '!=', 9)
                    ->where('is_active', 1)
                    ->count();

                if ($is_check > 0) {
                    $result['message'] = 'Вы не можете купить этот пакет, так как вы уже приобрели другой пакет';
                    $result['status'] = false;
                    return response()->json($result);
                }
            }
            $packet_old_price = UserPacket::beforePurchaseSum(Auth::user()->user_id);
        }
        
        $price = ($packet->packet_price - $packet_old_price) * \App\Models\Currency::pvToKzt();
        $name = 'Покупка пакета ' . $packet->packet_name_ru . ' на сайте Qpartner.club';        
        $data = [
            'MERCHANT_ID' => env('SMART_PAY_MERCHANT_ID'),
            'PAYMENT_AMOUNT' => $price,
            'PAYMENT_ORDER_ID' => $order_code,
            'PAYMENT_INFO' => $name,
            'PAYMENT_CALLBACK_URL' => env('SMART_PAY_CALLBACK_URL'),
            'PAYMENT_RETURN_URL' => env('SMART_PAY_RETURN_URL'),
            'PAYMENT_RETURN_FAIL_URL' => env('SMART_PAY_FAIL_URL'),
        ];

        $sign = Helpers::make_signature($data, env('SMART_PAY_KEY')); // формируем ключ
        $data['PAYMENT_HASH'] = $sign;
        $response = Helpers::send_request('https://spos.kz/merchant/api/create_invoice', $data);        
        if($response->status === 0) { // проверяем статус выполнения            
            $data_order = [
                'order_code' => $order_code,
                'user_id' => Auth::user()->user_id,
                'username' => Auth::user()->name .' '. Auth::user()->last_name ,
                'email' => Auth::user()->email,
                'address' => null,
                'contact' => Auth::user()->phone,
                'sum' => $price,
                'products' => null,
                'packet_id' => $request->packet_id,
                'payment_id' => $response->data->id,
                'delivery_id' => null
            ];
            $order = Order::createOrder($data_order);             
            if ($order) {
                return response()->json(['url' => $response->data->url]);
                // return  redirect()->away($response->data->url); // направляем пользователя на страницу оплаты
            }
            return response()->json($result);
            // $payment_id = $response->data->id; // для удобства можно привязать к номеру заказа, чтобы проверять статус, используя запрос /merchant/api/status
        } else { // произошла ошибка при выполнении (на стороне Smart Pay)                         
            return response()->json($result);
        }
    }
    
    public function callback(Request $request) {

        $input_data = $request->all();
        Log::info($input_data);
        Log::info('callback');
        if(env('SMART_PAY_MERCHANT_ID') == $input_data['MERCHANT_ID']) {
            $sign = Helpers::make_signature($input_data, env('SMART_PAY_KEY'));
            Log::info('true merch');
            if($input_data['PAYMENT_HASH'] == $sign) {
                Log::info('true hash');
                $order = Order::getByCode($input_data['PAYMENT_ORDER_ID']);
                Log::info($order);
                if ($order) {
                    if ($input_data['PAYMENT_STATUS'] != 'paid') {
                        return response()->json(['RESULT'=>'OK']);
                    } 
                    if (!$order->is_paid) {
                        $packet = Packet::where('packet_id', $order->packet_id)->first();
                    
                        $user_packet = new UserPacket();
                        $user_packet->user_id = $order->user_id;
                        $user_packet->packet_id = $order->packet_id;
                        $user_packet->user_packet_type = 'item';
                        $user_packet->packet_price = $packet->packet_price;
                        $user_packet->is_active = 0;
                        $user_packet->is_epay = 0;
                        $user_packet->is_portfolio = $packet->is_portfolio;
                        $user_packet->save();                    
                        app(\App\Http\Controllers\Admin\PacketController::class)->implementPacketBonuses($user_packet->user_packet_id);
                        Order::changeIsPaid($input_data['PAYMENT_ORDER_ID']);
                        return response()->json(['RESULT'=>'OK']);
                    } 
                }                
            } else {
                Log::info('true hash');
                // не совпадает цифровая подпись.
                return response()->json(['RESULT' => 'RETRY', 'DESC' => 'invalid_signature']);
            }
        }
        Log::info('false merch');
        return response()->json(['RESULT' => 'RETRY', 'DESC' => 'invalid_signature']);
    }

    public function createOrderPartnerProduct(Request $request)
    {
        $result['message'] = 'Временно недоступно';
        $result['status'] = false; 
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'address' => 'required|string',
            'delivery_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all(); 
            $result['message'] = $error[0];           
            return response()->json($result);
        }
        if (!Auth::check()) {
            return response()->json($result);
        }
        $order_code = time();
        $name = 'Покупка товаров на сайте Qpartner.club';
        $sum = 0;
        $products_all = [];
        $products_item = [];
        $products = UserBasket::where('user_id', Auth::user()->user_id)->where('is_active', 0)->get();
        foreach ($products as $item) {
            $product_price = Product::where('product_id', $item->product_id)->first();
            $sum += $product_price->product_price * $item->unit;
            $products_item['product_id'] = $product_price->product_id;
            $products_item['product_name'] = $product_price->product_name_ru;
            $products_item['count'] = $item->unit;
            $products_item['ball'] = $product_price->ball;
            array_push($products_all, $products_item);
        }
        if ($request->type == 'is_partner') {
            $is_partner = UserPacket::where('user_id', Auth::user()->user_id)->where('is_active', 1)->exists();
            if (!$is_partner) {
                $result['error'] = 'Вы не являетесь партнером';
                $result['status'] = false;
                return response()->json($result);
            }
            $sum = $sum - ($sum * \App\Models\Currency::PartnerDiscount);
            $sum = round($sum);
        }
        else {
            $sum = $sum - ($sum * \App\Models\Currency::ClientDiscount);
            $sum = round($sum);
        }    
        
        $sum = $sum * \App\Models\Currency::pvToKzt();
        
        $data = [
            'MERCHANT_ID' => env('SMART_PAY_MERCHANT_ID'),
            'PAYMENT_AMOUNT' => $sum,
            'PAYMENT_ORDER_ID' => $order_code,
            'PAYMENT_INFO' => $name,
            'PAYMENT_CALLBACK_URL' => env('SMART_PAY_CALLBACK_PARTNER_PRODUCT_URL'),
            'PAYMENT_RETURN_URL' => env('SMART_PAY_RETURN_URL'),
            'PAYMENT_RETURN_FAIL_URL' => env('SMART_PAY_FAIL_URL'),
        ];

        $sign = Helpers::make_signature($data, env('SMART_PAY_KEY')); // формируем ключ
        $data['PAYMENT_HASH'] = $sign;
        $response = Helpers::send_request('https://spos.kz/merchant/api/create_invoice', $data);        
        if($response->status === 0) { // проверяем статус выполнения
            $data_order = [
                'order_code' => time(),
                'user_id' => Auth::user()->user_id,
                'username' => Auth::user()->name .' '. Auth::user()->last_name ,
                'email' => Auth::user()->email,
                'address' => $request->address,
                'contact' => Auth::user()->phone,
                'sum' => $sum,
                'products' => \json_encode($products_all),
                'packet_id' => null,
                'payment_id' => $response->data->id,
                'delivery_id' => $request->delivery_id,
                'is_paid' => 0
            ];
            $order = Order::createOrder($data_order);
            if ($order) {
                return response()->json(['url' => $response->data->url]);
                // return  redirect()->away($response->data->url); // направляем пользователя на страницу оплаты
            }
            return response()->json($result);
            // $payment_id = $response->data->id; // для удобства можно привязать к номеру заказа, чтобы проверять статус, используя запрос /merchant/api/status
        } else { // произошла ошибка при выполнении (на стороне Smart Pay)                         
            return response()->json($result);
        }        
    }

    public function callbackPartnerProduct(Request $request) {  
        
        $input_data = $request->all();
        Log::info($input_data);
        Log::info('callback');
        if(env('SMART_PAY_MERCHANT_ID') == $input_data['MERCHANT_ID']) {
            $sign = Helpers::make_signature($input_data, env('SMART_PAY_KEY'));
        
            if($input_data['PAYMENT_HASH'] == $sign) {
                $order = Order::getByCode($input_data['PAYMENT_ORDER_ID']);
                if ($order) {
                    if ($input_data['PAYMENT_STATUS'] != 'paid') {
                        return response()->json(['RESULT'=>'OK']);
                    }
                    if (!$order->is_paid) {
                        app(\App\Http\Controllers\Admin\OnlineController::class)->implementCashback($order->user_id);
                        Order::changeIsPaid($input_data['PAYMENT_ORDER_ID']);
                        return response()->json(['RESULT'=>'OK']);
                    }
                }
            } else {
                // не совпадает цифровая подпись.
                return response()->json(['RESULT' => 'RETRY', 'DESC' => 'invalid_signature']);
            }
        }
        return response()->json(['RESULT' => 'RETRY', 'DESC' => 'invalid_signature']);        
    }
    
    public function createOrderProduct(Request $request) {
        $result['message'] = 'Временно недоступно';
        $result['status'] = false;  
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'product_count' => 'required|integer',
            'username' => 'required|string',
            'contact' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string',
            'delivery' => 'required|string',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all(); 
            $result['message'] = $error[0];           
            return response()->json($result);
        }

        $product = Product::where('product_id', $request->product_id)->first();
        
        $price = 0;
        $name = 'Покупка товара на сайте Qpartner.club';
        $order_code = time();
        $price = ($product->product_price * $request->product_count ) * \App\Models\Currency::pvToKzt();
        $products = [['product_id' => $product->product_id, 'product_name' => $product->product_name_ru, 'count' => $request->product_count]];
        $data = [
            'MERCHANT_ID' => env('SMART_PAY_MERCHANT_ID'),
            'PAYMENT_AMOUNT' => $price,
            'PAYMENT_ORDER_ID' => $order_code,
            'PAYMENT_INFO' => $name,
            'PAYMENT_CALLBACK_URL' => env('SMART_PAY_CALLBACK_PRODUCT_URL'),
            'PAYMENT_RETURN_URL' => env('SMART_PAY_RETURN_URL'),
            'PAYMENT_RETURN_FAIL_URL' => env('SMART_PAY_FAIL_URL'),
        ];

        $sign = Helpers::make_signature($data, env('SMART_PAY_KEY')); // формируем ключ
        $data['PAYMENT_HASH'] = $sign;
        $response = Helpers::send_request('https://spos.kz/merchant/api/create_invoice', $data);        
        if($response->status === 0) { // проверяем статус выполнения            
            $data_order = [
                'order_code' => $order_code,
                'user_id' => null,
                'username' => $request->username ,
                'email' => $request->email,
                'address' => $request->address,
                'contact' => $request->contact,
                'sum' => $price,
                'products' => \json_encode($products),
                'packet_id' => null,
                'payment_id' => $response->data->id,
                'delivery_id' => $request->delivery
            ];
            $order = Order::createOrder($data_order);             
            if ($order) {                
                return response()->json(['url' => $response->data->url]);
                // return  redirect()->away($response->data->url); // направляем пользователя на страницу оплаты
            }
            return response()->json($result);
            // $payment_id = $response->data->id; // для удобства можно привязать к номеру заказа, чтобы проверять статус, используя запрос /merchant/api/status
        } else { // произошла ошибка при выполнении (на стороне Smart Pay)                         
            return response()->json($result);
        }
    }

    public function callbackProduct(Request $request) {
        $input_data = $request->all();
        Log::info($input_data);
        Log::info('callback');
        if(env('SMART_PAY_MERCHANT_ID') == $input_data['MERCHANT_ID']) {
            $sign = Helpers::make_signature($input_data, env('SMART_PAY_KEY'));            
            if($input_data['PAYMENT_HASH'] == $sign) {
                $order = Order::getByCode($input_data['PAYMENT_ORDER_ID']);                
                if ($order) {
                    if ($input_data['PAYMENT_STATUS'] == 'paid') {
                        Order::changeIsPaid($input_data['PAYMENT_ORDER_ID']);   
                    }
                    // маркируем заказ с ИД PAYMENT_ORDER_ID как оплаченый
                    return response()->json(['RESULT'=>'OK']);
                }                
            } else {
                // не совпадает цифровая подпись.
                return response()->json(['RESULT' => 'RETRY', 'DESC' => 'invalid_signature']);
            }
        }        
        return response()->json(['RESULT' => 'RETRY', 'DESC' => 'invalid_signature']);
    }

    public function fail(Request $request) {
        Log::info($request);
        return $request;
    }

    public function return(Request $request) {

        Log::info('ssss');
        return redirect('/')->withInput(['success' => 'Оплата прошла удачно']);
        return $request;
    }

    public function hasNeedPackets($inviterPacketId, $order)
    {
        $actualPackets = [Packet::CLASSIC, Packet::PREMIUM, Packet::ELITE, Packet::VIP2, Packet::VIP, Packet::GAP1, Packet::GAP2, Packet::GAP];
        $boolean = false;
        if ($inviterPacketId == Packet::ELITE_FREE) {
            $inviterPacketId = Packet::ELITE;
        }
        $inviterPacket = Packet::where(['packet_id' => $inviterPacketId])->first();
        $packet_available_level = $inviterPacket->packet_available_level;
        if ($order <= $packet_available_level) {
            $boolean = true;
        }
        return $boolean;
    }
}
