<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegistersTable extends Migration
{

    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->enum('type', ['entry', 'remove']);
            $table->text('info')->nullable();
            $table->integer('provider_id')->nullable()->unsigned();
            $table->integer('created')->unsigned();
            $table->integer('updated')->unsigned();

            $table->foreign('created')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated')->references('id')->on('users')->onDelete('cascade');     
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('product_register', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('register_id')->unsigned();
            $table->integer('quantity')->nullable();
            $table->timestamps();
            
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_register');
        Schema::dropIfExists('registers');
    }
}
