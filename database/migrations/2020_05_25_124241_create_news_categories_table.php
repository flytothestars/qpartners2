<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment = 'Название категорий';
            $table->text('description')->nullable()->comment = 'Описание категорий';
            $table->tinyInteger('is_active')->nullable()->comment = 'Активный';
            $table->timestamps();
        });
        Schema::table('news', function (Blueprint $table) {
            $table->integer('category_id')->after('news_id')->comment = 'Идентификатор категорий новости';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_categories');
    }
}
