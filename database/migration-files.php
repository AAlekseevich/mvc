<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 23.03.2020
 * Time: 13:57
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{

    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(1);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('file');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('files');
    }
}