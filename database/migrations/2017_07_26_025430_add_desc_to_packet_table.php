<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescToPacketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packet', function (Blueprint $table) {
            $table->string('packet_desc_ru');
            $table->string('packet_desc_kz');
            $table->string('packet_desc_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packet', function (Blueprint $table) {
            $table->dropColumn('packet_desc_ru');
            $table->dropColumn('packet_desc_kz');
            $table->dropColumn('packet_desc_en');
        });
    }
}
