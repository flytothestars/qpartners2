<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Currency extends Model
{
    protected $table = 'currency';
    protected $primaryKey = 'currency_id';

    const DOLLAR = 1;
    const PV = 2;
    const PartnerDiscount = 20/100;
    const ClientDiscount = 10/100;
    const PacketDiscount = 33.33/100;

    public static function usdToKzt()
    {
        $usdToKzt = 0;
        $currency = Currency::where(['currency_id' => self::DOLLAR])->first();
        $usdToKzt = $currency->money;
        return $usdToKzt;
    }

    public static function pvToKzt()
    {
        $pvToKzt = 0;
        $currency = Currency::where(['currency_id' => self::PV])->first();
        $pvToKzt = $currency->money;
        return $pvToKzt;
    }


}
