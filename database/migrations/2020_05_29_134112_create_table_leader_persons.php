<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLeaderPersons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leader_persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')->nullable()->comment = 'Фамилия Имя Отчество лидера';
            $table->string('address')->nullable()->comment = 'Адрес лидера ';
            $table->string('image')->nullable()->comment = 'Изображение';
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
