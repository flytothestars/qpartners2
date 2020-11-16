<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFaqStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->comment = 'Тип статуса';
            $table->string('fa_symbol')->nullable()->comment = 'fa icon статуса';
            $table->string('back-color')->nullable()->comment = 'Цвет статуса';
            $table->timestamps();
        });
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
