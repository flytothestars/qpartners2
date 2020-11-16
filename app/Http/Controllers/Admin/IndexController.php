<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use App\Models\UserOperation;
use App\Models\UserPacket;
use App\Models\UserRequest;
use App\Models\Users;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use Auth;
use View;
use DB;
use URL;


class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile', ['only' => ['index', 'callFriend']]);
    }

    public function index(Request $request)
    {
        $request->profit_all = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '!=', 2)
            ->where('operation_type_id', '!=', 3)
            ->where('operation_type_id', '!=', 28)
            ->where('operation_type_id', '!=', 29)
            ->sum('money');

        $request->profit_today = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '!=', 2)
            ->where('operation_type_id', '!=', 3)
            ->where('operation_type_id', '!=', 28)
            ->where('operation_type_id', '!=', 29)
            ->where('created_at', '>', date("Y-m-d"))
            ->sum('money');

        $request->profit_last_week = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '!=', 2)
            ->where('operation_type_id', '!=', 3)
            ->where('operation_type_id', '!=', 28)
            ->where('operation_type_id', '!=', 29)
            ->where('created_at', '>', date("Y-m-d", strtotime("-7 day")))
            ->sum('money');

        $request->profit_last_month = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '!=', 2)
            ->where('operation_type_id', '!=', 3)
            ->where('operation_type_id', '!=', 28)
            ->where('operation_type_id', '!=', 29)
            ->where('created_at', '>', date("Y-m-d", strtotime("-30 day")))
            ->sum('money');

        $request->passive_profit_all = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 3)
            ->sum('money');

        $request->passive_profit_today = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 3)
            ->where('created_at', '>', date("Y-m-d"))
            ->sum('money');

        $request->passive_profit_last_week = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 3)
            ->where('created_at', '>', date("Y-m-d", strtotime("-7 day")))
            ->sum('money');

        $request->passive_profit_last_month = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 3)
            ->where('created_at', '>', date("Y-m-d", strtotime("-30 day")))
            ->sum('money');


        $request->home_profit_all = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 32)
            ->sum('money');

        $request->home_profit_today = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 32)
            ->where('created_at', '>', date("Y-m-d"))
            ->sum('money');

        $request->home_profit_last_week = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 32)
            ->where('created_at', '>', date("Y-m-d", strtotime("-7 day")))
            ->sum('money');

        $request->home_profit_last_month = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 32)
            ->where('created_at', '>', date("Y-m-d", strtotime("-30 day")))
            ->sum('money');


        $request->auto_profit_all = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 27)
            ->sum('money');

        $request->auto_profit_today = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 27)
            ->where('created_at', '>', date("Y-m-d"))
            ->sum('money');

        $request->auto_profit_last_week = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 27)
            ->where('created_at', '>', date("Y-m-d", strtotime("-7 day")))
            ->sum('money');

        $request->auto_profit_last_month = UserOperation::where('recipient_id', Auth::user()->user_id)
            ->where('operation_id', 1)
            ->where('operation_type_id', '=', 27)
            ->where('created_at', '>', date("Y-m-d", strtotime("-30 day")))
            ->sum('money');


        $request->my_shareholder_money = Users::where('user_id', '=', Auth::user()->user_id)->sum('user_share');
        $request->shareholder_money_all = Users::where('user_share', '>', 0)->sum('user_share');

        $request->shareholder_profit_today = UserOperation::where('operation_type_id', 5)
            //  ->where('created_at','>',date("Y-m-d"))
            ->sum('money');

        $request->shareholder_count = Users::where('users.user_share', '>', 0)->count();

        $request->user_share_sum = Users::where('users.user_share', '>', 0)->sum('users.user_share');

        if ($request->shareholder_profit_today != 0 && $request->user_share_sum != 0)
            $request->shareholder_average_mount = round($request->shareholder_profit_today / $request->user_share_sum, 2);
        else $request->shareholder_average_mount = 0;


        $request->my_shareholder_money2 = Users::where('user_id', '=', Auth::user()->user_id)->sum('user_share2');
        $request->shareholder_money_all2 = Users::where('user_share2', '>', 0)->sum('user_share2');

        $request->shareholder_profit_today2 = UserOperation::where('operation_type_id', 25)
            // ->where('created_at','>',date("Y-m-d"))
            ->sum('money');

        $request->shareholder_count2 = Users::where('users.user_share2', '>', 0)->count();

        $request->user_share_sum2 = Users::where('users.user_share2', '>', 0)->sum('users.user_share2');

        if ($request->shareholder_profit_today2 != 0 && $request->user_share_sum2 != 0)
            $request->shareholder_average_mount2 = round($request->shareholder_profit_today2 / $request->user_share_sum2, 2);
        else $request->shareholder_average_mount2 = 0;


        $request->currency = Currency::where('currency_id', 2)->first();

        $request->packet = UserPacket::leftJoin('users', 'users.user_id', '=', 'user_packet.user_id')
            ->leftJoin('packet', 'packet.packet_id', '=', 'user_packet.packet_id')
            ->where('user_packet.user_id', Auth::user()->user_id)
            ->orderBy('packet.sort_num')
            ->get();

        $request->out_money = UserOperation::where('operation_type_id', 12)
            ->where('recipient_id', Auth::user()->user_id)
            ->sum('money');

        $request->send_money = UserOperation::where('operation_type_id', 28)->where('recipient_id', Auth::user()->user_id)->sum('money');

        return view('admin.index.index', ['row' => $request]);
    }

    public function callFriend(Request $request)
    {
        $url = URL('/') . '/' . Auth::user()->user_id . '/' . \App\Http\Helpers::getTranslatedSlugRu(Auth::user()->login);

        return view('admin.call-friend.call-friend',
            [
                'url' => $url
            ]);
    }

    public function profitRobotAfterMonth()
    {
        return;

        $users = Users::get();

        foreach ($users as $key => $item) {
            $user = Users::where('user_id', $item->user_id)->first();
            $diff = abs(strtotime(date("Y-m-d", strtotime($user->activated_date))) - strtotime(date("Y-m-d")));
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

            $user_status = UserStatus::where('user_status_id', $user->status_id)->first();

            if ($months > 0 && $user->user_money > 24) {
                $activation_money = 24;

                $user->user_money = $user->user_money - $activation_money;
                $user->activated_date = date("Y-m-d");
                $user->is_activated = 1;
                $user->save();

                $operation = new UserOperation();
                $operation->author_id = null;
                $operation->recipient_id = $item->user_id;
                $operation->money = -1 * $activation_money;
                $operation->operation_id = 2;
                $operation->operation_type_id = 14;
                $operation->operation_comment = 'Ежемесячная активация';
                $operation->save();

                $user_id = $user->recommend_user_id;
                $counter = 0;
                $send_money = 0;
                while ($user_id != null) {
                    $counter++;
                    $parent = Users::where('user_id', $user_id)->first();
                    if ($parent == null) break;

                    $user_id = $parent->recommend_user_id;

                    if ($parent->is_activated == 0) continue;

                    $parent_packet = UserPacket::leftJoin('packet', 'packet.packet_id', '=', 'user_packet.packet_id')
                        ->where('user_packet.user_id', $parent->user_id)
                        ->where('user_packet.is_active', 1)
                        ->where('user_packet.packet_type', 1)
                        ->orderBy('packet.sort_num', 'desc')
                        ->first();

                    if ($parent_packet == null) continue;

                    if ($counter > 0 && $counter <= 8) {
                        $money = $activation_money * 8.34 / 100;
                    }

                    $operation = new UserOperation();
                    $operation->author_id = $item->user_id;
                    $operation->recipient_id = $parent->user_id;
                    $operation->money = $money;
                    $operation->operation_id = 1;
                    $operation->operation_type_id = 14;
                    $operation->operation_comment = 'Ежемесячная активация. Уровень - ' . $counter;
                    $operation->save();

                    $parent->user_money = $parent->user_money + $money;
                    $parent->save();

                    $send_money = $send_money + $money;

                    if ($counter >= 8) break;
                }

                $operation = new UserOperation();
                $operation->author_id = $item->user_id;
                $operation->recipient_id = 1;
                $operation->money = $activation_money - $send_money;
                $operation->operation_id = 1;
                $operation->operation_type_id = 14;
                $operation->operation_comment = 'Ежемесячная активация. Пополнение фонда компании';
                $operation->save();

                $company = Users::where('user_id', 1)->first();
                $company->user_money = $company->user_money + $activation_money - $send_money;
                $company->save();
            } elseif ($months > 0) {
                $user->is_activated = 0;
                $user->save();
            }
        }
        echo 'Успешно выполнено';
    }

    public function deleteInactiveUserPacketAfterDay()
    {
        $request = UserPacket::where('is_active', 0)->get();
        foreach ($request as $key => $item) {
            $diff = abs(strtotime(date("Y-m-d", strtotime($item->created_at))) - strtotime(date("Y-m-d")));
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

            if ($days > 0) UserPacket::where('user_packet_id', $item->user_packet_id)->delete();

        }
        echo 'Успешно выполнено';
    }

    public function setUserStatus($user_id)
    {
        $users = Users::where('user_id', $user_id)
            ->where('status_id', '>=', 2)
            ->where('qualification_profit', '>=', 500)
            ->get();

        foreach ($users as $key => $item) {
            $user = Users::where('user_id', $item->user_id)->first();

            $user_status = UserStatus::where('user_status_id', $user->status_id)->first();

            if ($user_status == null) continue;

            $status_list = UserStatus::where('sort_num', '>', $user_status->sort_num)->orderBy('sort_num', 'asc')->get();

            foreach ($status_list as $status_item) {
                if ($status_item->user_status_minimum_money <= $user->qualification_profit
                    && $status_item->user_status_binar_limit_money_in_week <= $user->week_qualification_profit
                    && $status_item->condition_minumum_status_id <= $user->status_id
                ) {
                    $user->status_id = $status_item->user_status_id;
                    $user->user_money = $user->user_money + $status_item->user_status_money;
                    $user->user_share2 = $user->user_share2 + $status_item->user_status_share;
                    $user->save();

                    $operation = new UserOperation();
                    $operation->author_id = null;
                    $operation->recipient_id = $user->user_id;
                    $operation->money = $status_item->user_status_money;
                    $operation->operation_id = 1;
                    $operation->operation_type_id = 10;
                    $operation->operation_comment = 'Поздравляем! Ваш новый статус - "' . $status_item->user_status_name . '"';
                    $operation->save();

                    $operation = new UserOperation();
                    $operation->author_id = null;
                    $operation->recipient_id = $user->user_id;
                    $operation->money = $status_item->user_status_share;
                    $operation->operation_id = 1;
                    $operation->operation_type_id = 2;
                    $operation->operation_comment = 'За переход на новый статус- "' . $status_item->user_status_name . '"';
                    $operation->save();

                    $operation = new UserOperation();
                    $operation->author_id = $user->user_id;
                    $operation->recipient_id = 1;
                    $operation->money = $status_item->user_status_money * -1;
                    $operation->operation_id = 2;
                    $operation->operation_type_id = 12;
                    $operation->operation_comment = 'За переход на новый статус- "' . $status_item->user_status_name . '"';
                    $operation->save();

                    $company = Users::where('user_id', 1)->first();
                    $company->user_money = $company->user_money - $status_item->user_status_money;
                    $company->save();
                }
            }
        }
    }

    public function robotBinarProfit()
    {
        ini_set('memory_limit', '-1');

        $users = Users::where('left_child_profit', '>', 0)
            ->where('right_child_profit', '>', 0)
            ->select('user_id')
            ->get();

        foreach ($users as $key => $item) {
            $user = Users::where('user_id', $item->user_id)->first();

            $left_child_count = Users::where('recommend_user_id', $item->user_id)->where('is_left_part', 0)->count();
            $right_child_count = Users::where('recommend_user_id', $item->user_id)->where('is_left_part', 1)->count();

            if ($left_child_count == 0 || $right_child_count == 0) continue;

            if ($user->left_child_profit >= $user->right_child_profit)
                $minus_profit = $user->right_child_profit;
            else $minus_profit = $user->left_child_profit;

            $user->left_child_profit = $user->left_child_profit - $minus_profit;
            $user->right_child_profit = $user->right_child_profit - $minus_profit;
            $user->qualification_profit = $user->qualification_profit + $minus_profit;
            $user->week_qualification_profit = $minus_profit;


            $user->save();


            $this->setUserStatus($user->user_id);

            $user = Users::where('user_id', $item->user_id)->first();
            $user_status = UserStatus::where('user_status_id', $user->status_id)->first();

            if ($user_status == null) {
                continue;
            }

            $procent_profit = 0;
            if ($user_status->user_status_binar_procent > 0) {
                $procent_profit = $minus_profit * $user_status->user_status_binar_procent / 100;
            } else {
                continue;
            }

            if ($procent_profit > $user_status->user_status_binar_limit_money)
                $procent_profit = $user_status->user_status_binar_limit_money;

            $operation = new UserOperation();
            $operation->author_id = null;
            $operation->recipient_id = $user->user_id;
            $operation->money = $procent_profit;
            $operation->operation_id = 1;
            $operation->operation_type_id = 17;
            $operation->operation_comment = $minus_profit . 'PV';
            $operation->save();

            $user->user_money = $user->user_money + $procent_profit;
            $user->save();

            $operation = new UserOperation();
            $operation->author_id = $user->user_id;
            $operation->recipient_id = 1;
            $operation->money = $procent_profit * -1;
            $operation->operation_id = 2;
            $operation->operation_type_id = 12;
            $operation->operation_comment = 'Бинарный доход';
            $operation->save();

            $company = Users::where('user_id', 1)->first();
            $company->user_money = $company->user_money - $procent_profit;
            $company->save();

            $user_id = $user->recommend_user_id;
            $counter = 0;

            while ($user_id != null) {
                $counter++;
                $parent = Users::where('user_id', $user_id)->first();
                if ($parent == null) break;
                $user_id = $parent->recommend_user_id;

                if ($parent->is_activated == 0 || $parent->status_id < 1) continue;

                $parent_status = UserStatus::where('user_status_id', $parent->status_id)->first();

                if ($parent_status == null) continue;

                if ($parent_status->user_status_available_level < $counter) continue;

                $money = $procent_profit / 10;

                $operation = new UserOperation();
                $operation->author_id = $user->user_id;
                $operation->recipient_id = $parent->user_id;
                $operation->money = $money;
                $operation->operation_id = 1;
                $operation->operation_type_id = 18;
                $operation->operation_comment = 'Чек от чека. Уровень - ' . $counter;
                $operation->save();

                $parent->user_money = $parent->user_money + $money;
                $parent->save();

                $operation = new UserOperation();
                $operation->author_id = $user->user_id;
                $operation->recipient_id = 1;
                $operation->money = $money * -1;
                $operation->operation_id = 2;
                $operation->operation_type_id = 12;
                $operation->operation_comment = 'Чек от чека. Уровень - ' . $counter;
                $operation->save();

                $company = Users::where('user_id', 1)->first();
                $company->user_money = $company->user_money - $procent_profit;
                $company->save();

                if ($counter >= 5) break;
            }
        }
    }

    public function robotCareer()
    {
        $users = Users::where('status_id', '>=', 23)
            ->select('user_id', 'status_id', 'created_at')
            ->get();

        foreach ($users as $key => $item) {

            $check_child = Users::where('status_id', $item->status_id)->where('recommend_user_id', $item->user_id)->count();
            if ($check_child > 4) {

                $operation = new UserOperation();
                $operation->author_id = null;
                $operation->recipient_id = $item->user_id;
                $operation->money = null;
                $operation->operation_id = 1;
                $operation->operation_type_id = 10;

                $status_id = 0;
                if ($item->status_id == 23) {
                    $operation->operation_comment = 'Вы стали Менеджером';
                    $status_id = 24;
                } elseif ($item->status_id == 24) {
                    $operation->operation_comment = 'Вы стали Бронзовым Менеджером';
                    $status_id = 25;

                    /*$diff = abs(strtotime(date("Y-m-d",strtotime($item->created_at))) - strtotime(date("Y-m-d")));
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                    if($days < 15) {
                        $user = Users::where('user_id',$item->user_id)->first();
                        $user->user_money += 250;
                        $user->save();

                        $operation = new UserOperation();
                        $operation->author_id = $user->user_id;
                        $operation->recipient_id = null;
                        $operation->money = 250;
                        $operation->operation_id = 1;
                        $operation->operation_type_id = 20;
                        $operation->operation_comment = 'За 14 дней успели стать менеджером! Поздравляем!' ;
                        $operation->save();
                    }*/
                } elseif ($item->status_id == 25) {
                    $operation->operation_comment = 'Вы стали Серебряным Менеджером';
                    $status_id = 26;

                    /*$diff = abs(strtotime(date("Y-m-d",strtotime($item->created_at))) - strtotime(date("Y-m-d")));
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                    if($days < 31) {
                        $user = Users::where('user_id',$item->user_id)->first();
                        $user->user_money += 1000;
                        $user->save();

                        $operation = new UserOperation();
                        $operation->author_id = $user->user_id;
                        $operation->recipient_id = null;
                        $operation->money = 1000;
                        $operation->operation_id = 1;
                        $operation->operation_type_id = 20;
                        $operation->operation_comment = 'За 30 дней успели стать директором! Поздравляем!' ;
                        $operation->save();
                    }*/
                } elseif ($item->status_id == 26) {
                    $operation->operation_comment = 'Вы стали Золотым директором';
                    $status_id = 27;
                } elseif ($item->status_id == 27) {
                    $operation->operation_comment = 'Вы стали Бриллиантовым директором';
                    $status_id = 28;
                }


                $operation->save();

                $user = Users::where('user_id', $item->user_id)->first();
                $user->status_id = $status_id;
                $user->save();

            }
        }

    }
}
