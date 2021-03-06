<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->string('lastname', 50)->nullable();
            $table->string('fullname', 250);
            $table->enum('type', ['person', 'organization']);
            $table->enum('level', ['member', 'admin'])->default('member');
            $table->string('email')->unique();
            $table->string('identification', 25)->unique();
            $table->string('telephone', 25);
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
