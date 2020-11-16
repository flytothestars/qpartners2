<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('order_code')->notNull()->unique();
            $table->integer('user_id')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->integer('sum')->nullable();            
            $table->text('products')->nullable();            
            $table->integer('packet_id')->nullable();
            $table->integer('is_paid')->default(0);            
            $table->integer('payment_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
