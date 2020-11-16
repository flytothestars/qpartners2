<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Order extends Model
{
    const PICKUP_DELIVERY = 1;
    const COURIER_DELIVERY = 2;
    const POST_DELIVERY = 3;
    protected $primaryKey = 'id';
    protected $fillable = ['order_code', 'user_id', 'username', 'email', 'address', 'contact', 'sum', 'products', 'packet_id', 'is_paid', 'payment_id', 'delivery_id'];

    public static function createOrder($data) {
        $order = Order::create([
            'order_code' => $data['order_code'],
            'user_id' => $data['user_id'],
            'username' => $data['username'],
            'email' => $data['email'],
            'address' => $data['address'],
            'contact' => $data['contact'],
            'sum' => $data['sum'],
            'products' => $data['products'],
            'packet_id' => $data['packet_id'],
            'is_paid' => $data['is_paid'] ?? 0,
            'payment_id' => $data['payment_id'],
            'delivery_id' => $data['delivery_id'],
        ]);

        return $order;
    }

    public static function changeIsPaid($order_code) {
        return Order::where('order_code', $order_code)->update(['is_paid' => 1]);
    }

    public static function getByCode($order_code) {
        return Order::where('order_code', $order_code)->first();
    }

    public function getDelivery() {
        if ($this->delivery_id == self::PICKUP_DELIVERY) {
            return 'Самовывоз';
        }
        else if ($this->delivery_id == self::COURIER_DELIVERY) {
            return 'Курьером';
        }
        if ($this->delivery_id == self::POST_DELIVERY) {
            return 'По почте';
        }
    }

}
