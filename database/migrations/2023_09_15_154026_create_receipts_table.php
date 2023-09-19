<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('sales');

            $table->string('file_name');
            $table->string('mime');
            $table->string('hash');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        DB::statement("ALTER TABLE `receipts` ADD `file` LONGBLOB AFTER `sale_id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
}
