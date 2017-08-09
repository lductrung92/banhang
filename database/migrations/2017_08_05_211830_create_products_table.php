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
            $table->string('code');
            $table->integer('cid')->unsigned();
            $table->integer('pid')->nullable();
            $table->string('name')->unique();
            $table->string('title')->nullable();
            $table->string('slug');
            $table->string('price');
            $table->string('options')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('isnew')->nullable();
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
