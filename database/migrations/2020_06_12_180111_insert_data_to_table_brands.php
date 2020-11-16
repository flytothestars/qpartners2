<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDataToTableBrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('brands')->insert([
            'id' => 9,
            'name' => 'Q-TV',
            'description' => 'Q-TV',
            'created_at' => date('Y-m-d H:m:i'),
            'updated_at' => date('Y-m-d H:m:i'),
            'is_show' => true,
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
