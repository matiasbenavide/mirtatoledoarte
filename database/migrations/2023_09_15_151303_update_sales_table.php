<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('province')->nullable()->change();
            $table->string('locality')->nullable()->change();
            $table->integer('zip_code')->nullable()->change();
            $table->string('direction')->after('shipping_option');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('province')->change();
            $table->string('locality')->change();
            $table->integer('zip_code')->change();
        });
    }
}
