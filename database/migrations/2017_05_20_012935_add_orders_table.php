<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('user_id')->unsigned();
            $table->date('date');
            $table->enum('condition', ['confirmed', 'on_hold', 'Rejected'])->default('on_hold');
            $table->integer('created')->unsigned();
            $table->integer('updated')->unsigned();

            $table->foreign('created')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated')->references('id')->on('users')->onDelete('cascade');
         //   $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('description');
            $table->string('quantity');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
}
