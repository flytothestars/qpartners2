<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertGlobalBonusToTableOperationType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('operation_type')->insert([
            'operation_type_id' => 34,
            'operation_type_name_ru' => 'Глобальный бонус',
            'created_at' => date('Y:m:d H:m:i'),
            'updated_at' => date('Y:m:d H:m:i')

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
