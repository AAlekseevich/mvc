<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('password');
        $table->integer('age');
        $table->string('email');
        $table->text('description');
        $table->string('photo');
        $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}