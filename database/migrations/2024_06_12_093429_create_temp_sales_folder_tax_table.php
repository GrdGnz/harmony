<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempSalesFolderTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TEMP_SALES_FOLDER_TAX', function (Blueprint $table) {
            $table->id();
            $table->string('TAX_CODE', 3)->nullable();
            $table->string('TAX_NUM', 20)->nullable();
            $table->string('COST_CURR_CODE', 3)->nullable(false);
            $table->decimal('COST_CURR_RATE', 10, 6)->nullable(false);
            $table->decimal('COST_AMOUNT', 13, 2)->nullable(false);
            $table->string('SELL_CURR_CODE', 3)->nullable(false);
            $table->decimal('SELL_CURR_RATE', 10, 6)->nullable(false);
            $table->decimal('SELL_AMOUNT', 13, 2)->nullable(false);
            $table->char('BILL_FLAG', 1)->nullable(false);
            $table->char('INCL_FLAG', 1)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TEMP_SALES_FOLDER_TAX');
    }
}
