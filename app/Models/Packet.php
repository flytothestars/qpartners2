<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use DB;

class Packet extends Model
{
    protected $table = 'packet';
    protected $primaryKey = 'packet_id';
    protected $fillable = ['packet_price', 'packet_name_ru', 'packet_share', 'packet_lection', 'packet_thing', 'sort_num', 'packet_price', 'is_show'];
    const ELITE_FREE = 22;
    const CLASSIC = 23;
    const PREMIUM = 24;
    const ELITE = 25;
    const VIP = 26;
    const VIP2 = 27;
    const GAP1 = 28;
    const  GAP2 = 29;
    const GAP = 30;
    const SUPER = 31;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public static function actualPacket()
    {
        return [
            self::CLASSIC,
            self::PREMIUM,
            self::ELITE,
            self::GAP,
            self::VIP2,
            self::VIP,
        ];
    }


    public static function limit($user)
    {
        $messageBody = '';
        $success = true;
        $userId = $user->user_id;
        $userStatus = $user->user_status;
        $availableBonuses = [1, 32, 22];
        $monday = date('Y-m-d H:i:s', strtotime('monday this week'));
        $sunday = date('Y-m-d H:i:s', strtotime('sunday this week'));
        $firstDay = date('Y-m-d H:i:s', strtotime('first day of this month'));
        $lastDay = date('Y-m-d H:i:s', strtotime('last day of this month'));

        $incomeForMonth = UserOperation::where(['recipient_id' => $userId])
            ->where(['operation_type_id' => $availableBonuses])
            ->whereBetween(['created_at', [$firstDay, $lastDay]])
            ->get();

        $incomeWeek = UserOperation::where(['recipient_id' => $userId])
            ->where(['operation_type_id' => $availableBonuses])
            ->whereBetween('created_at', [$monday, $sunday])
            ->get();

        $incomeForMonth = collect($incomeForMonth);
        $incomeForMonth = $incomeForMonth->map(function ($item) {
            return $item->money;
        });

        $incomeForMonth = array_map($incomeForMonth->all());

        $incomeWeek = collect($incomeWeek);
        $incomeWeek = $incomeWeek->map(function ($item) {
            return $item->money;
        });
        $incomeWeek = array_sum($incomeWeek->all());

        switch ($userStatus) {
            case UserStatus::CONSULTANT;                
                if ($incomeForMonth >= 200) {
                    $messageBody = 'Ваш лимит на неделю не превышает 200$. ';
                    $success = false;
                }
                break;
            case UserStatus::PREMIUM_MANAGER:                
                if ($incomeForMonth >= 1000) {
                    $messageBody = 'Ваш лимит на неделю не превышает 1000$. ';
                    $success = false;
                }
                break;
            case UserStatus::ELITE_MANAGER:
                if ($incomeForMonth >= 1000) {
                    $messageBody = 'Ваш лимит на неделю не превышает 2 000$. ';
                    $success = false;
                }
                break;            
            case UserStatus::VIP_MANAGER:                
                if ($incomeForMonth >= 1000000) {
                    $messageBody = 'Ваш лимит на неделю не превышает 4 000$. ';
                    $success = false;
                }
                break;            
        }
        return [
            'message' => $messageBody,
            'success' => $success,
        ];
    }

    public static function limitBonus($user)
    {
        $messageBody = '';
        $success = true;
        $userId = $user->user_id;
        $userStatus = $user->user_status;
        $availableBonuses = [1, 32, 22];
        $firstDay = date('Y-m-d H:i:s', strtotime('first day of this month'));
        $lastDay = date('Y-m-d H:i:s', strtotime('last day of this month'));

        $incomeForMonth = UserOperation::where(['recipient_id' => $userId])
            ->where(['operation_type_id' => $availableBonuses])
            ->whereBetween('created_at', [$firstDay, $lastDay])
            ->get();

        $incomeForMonth = collect($incomeForMonth);
        $incomeForMonth = $incomeForMonth->map(function ($item) {
            return $item->money;
        });

        Log::info($incomeForMonth);

        $incomeForMonth = array_sum($incomeForMonth->all());    
        Log::info($incomeForMonth);
        switch ($userStatus) {
            case UserStatus::CONSULTANT;                
                if ($incomeForMonth >= 200) {
                    $messageBody = 'Ваш лимит на месяц не превышает 200$. ';
                    $success = false;
                }
                break;
            case UserStatus::PREMIUM_MANAGER:
                if ($incomeForMonth >= 500) {
                    $messageBody = 'Ваш лимит на месяц не превышает 500$. ';
                    $success = false;
                }
                break;
            case UserStatus::ELITE_MANAGER:
                if ($incomeForMonth >= 1000) {
                    $messageBody = 'Ваш лимит на месяц не превышает 1 000$. ';
                    $success = false;
                }
                break;            
            case UserStatus::VIP_MANAGER:
                if ($incomeForMonth >= 10000) {
                    $messageBody = 'Ваш лимит на месяц не превышает 10 000$. ';
                    $success = false;
                }
                break;            
        }
        return [
            'message' => $messageBody,
            'success' => $success,
        ];
    }

    public static function checkQualificationBonusTime($user, $bonusTime) 
    {        
        $success = true;
        $userId = $user->user_id;
        $userPacketActivate = UserPacket::where(['user_id' => $userId, 'is_active' => 1])->orderBy('packet_id','desc')->first();
        $day = date("Y-m-d", strtotime("-".$bonusTime." day"));

        if ($userPacketActivate->updated_at < $day) {
            $success = false;
        }
        Log::info($userPacketActivate);
        Log::info($day);
        
        return $success;
    }

    public function userPacket()
    {
        $this->hasMany('App\Models\UserPacket');
    }
}
