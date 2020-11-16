<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRefSocialNetworkItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_social_network_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('social_network_id')->comment = 'ID социальной сети';
            $table->integer('item_id')->comment = 'ID значение';
            $table->integer('type_id')->comment = 'ID типа';
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
