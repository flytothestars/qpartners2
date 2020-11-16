<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGuide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->comment = 'Загаловок';
            $table->text('text_body')->nullable()->comment = 'Текст';
            $table->string('author_full_name')->nullable()->comment = 'ФИО автора';
            $table->string('author_responsibility')->nullable()->comment = 'Должность автора';
            $table->string('author_instagram_link')->nullable()->comment = 'Ссылка на instagram автора';
            $table->string('author_facebook_link')->nullable()->comment = 'Ссылка на facebook автора';
            $table->string('author_whatsapp_link')->nullable()->comment = 'Ссылка на whatsapp автора';
            $table->string('author_twitter_link')->nullable()->comment = 'Ссылка на twitter автора';
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
