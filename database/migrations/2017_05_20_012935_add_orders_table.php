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
            $table->date('date');
            $table->string('title');
            $table->enum('type', ['service', 'entry', 'remove'])->default('service');
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('provider_id')->nullable()->unsigned();
            $table->enum('status', ['confirmed', 'on_hold'])->default('on_hold');
            $table->string('locale')->nullable();
            $table->string('notes')->nullable();
            $table->integer('total')->nullable();
            $table->integer('created')->unsigned();
            $table->integer('updated')->unsigned();

            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->nullable();
            $table->integer('total_p')->nullable();
            $table->timestamps();
            
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
}
