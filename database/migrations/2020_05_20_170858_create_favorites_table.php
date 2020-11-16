<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->comment = 'ID пользователя';
            $table->string('session_id')->nullable()->comment = 'Сессионный ID временного пользователя (неавторизованного)';
            $table->integer('item_id')->comment = 'ID продукта';
            $table->tinyInteger('is_authorized')->comment = 'Был авторизован';
            $table->tinyInteger('is_active')->comment = 'Активный';
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
        Schema::dropIfExists('favorites');
    }
}
