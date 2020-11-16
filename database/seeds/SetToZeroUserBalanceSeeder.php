<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetToZeroUserBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            DB::beginTransaction();
            DB::table('user_operation')->truncate();

            $user_packets = \App\Models\UserPacket::where(['is_active' => true])->get();
            foreach ($user_packets as $item) {
                $item->is_active = false;
                $item->save();
            }

            $users = \App\Models\Users::where('user_id', '!=', 1000)->get();
            foreach ($users as $user) {
                $user->user_money = 0;
                $user->product_balance = 0;
                $user->status_id = null;
                $user->save();
            }

        } catch (Exception $exception) {
            DB::rollback();
            var_dump($exception->getFile() . ' ' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}
