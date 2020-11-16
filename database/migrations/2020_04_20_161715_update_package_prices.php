<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePackagePrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('packet')
            ->where('packet_id', 23)
            ->update([
                "packet_price" => 10,
            ]);

        DB::table('packet')
            ->where('packet_id', 24)
            ->update([
                "packet_price" => 50,
            ]);

        DB::table('packet')
            ->where('packet_id', 25)
            ->update([
                "packet_price" => 100,
            ]);
        DB::table('packet')
            ->where('packet_id', 26)
            ->update([
                "packet_price" => 400,
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
