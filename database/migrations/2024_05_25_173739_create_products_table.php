<?php

use Illuminate\Support\Facades\DB;
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
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('price');
            $table->string('description');
            $table->string('material');
            $table->string('size');
            $table->integer('max_weight');


            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')->references('id')->on('products_images');


            $table->timestamp('created_at')->useCurrent();
            $table->unsignedBigInteger('created_by')->default(1);
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
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
