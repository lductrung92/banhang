<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cid')->unsigned();
            $table->integer('pid')->nullable();
            $table->string('name')->unique();
            $table->string('title')->nullable();
            $table->string('slug');
            $table->integer('price');
            $table->string('options');
            $table->longText('description');
            $table->tinyInteger('status');
            $table->tinyInteger('isnew');
            $table->foreign('cid')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}