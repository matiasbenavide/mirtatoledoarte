<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('phone_number');
            $table->string('email');
            $table->integer('document_number');
            $table->json('products');
            $table->integer('total_amount');
            $table->unsignedBigInteger('shipping_option');
            $table->foreign('shipping_option')->references('id')->on('shipping_options');
            $table->string('province');
            $table->string('locality');
            $table->string('zip_code');
            // $table->unsignedBigInteger('receipt_id');
            $table->unsignedBigInteger('reference_code');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
