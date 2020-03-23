<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 23.03.2020
 * Time: 14:04
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->foreign('category')
                ->references('name')
                ->on('category')
                ->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->decimal('price');
            $table->integer('count');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}