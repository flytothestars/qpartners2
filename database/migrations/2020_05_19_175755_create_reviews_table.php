<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('review_text')->nullable();
            $table->integer('review_type_id')->comment = 'Тип отзыва';
            $table->integer('user_id')->comment = 'Идентификатор пльзователя';
            $table->integer('rating')->comment = 'Показатель рейтига в звездачках';
            $table->string('user_name')->comment = 'Имя пльзователя который ставил отзыв';
            $table->string('user_email')->comment = 'Почта пользователя котопый отставил отзыв';
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
        Schema::dropIfExists('reviews');
    }
}
