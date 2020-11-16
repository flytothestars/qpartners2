<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePriceGAP extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('packet')
            ->where('packet_id', 28)
            ->update([
                "packet_price" => 100,
                "packet_name_ru" => 'GAP 1',
            ]);
        DB::table('packet')
            ->where('packet_id', 29)
            ->update([
                "packet_price" => 200,
                "packet_name_ru" => 'GAP 2',
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
