<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunityFAQsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunity_faq', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->comment = 'Имя отправителя';
            $table->string('user_email')->comment = 'Почта отправителя';
            $table->string('user_phone')->nullable()->comment = 'Телефон отправителя';
            $table->text('question')->comment = 'Вопрос';
            $table->text('answer')->nullable()->comment = 'Ответ';
            $table->integer('status_id')->comment = 'ID статуса';
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
        Schema::dropIfExists('opportunity_f_a_qs');
    }
}
