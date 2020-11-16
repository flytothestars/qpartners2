<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdministrationPerson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administration_persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')->nullable()->comment = 'Фамилия Имя Отчество Администраций';
            $table->string('responsibility')->nullable()->comment = 'Должность предпринимателей';
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
