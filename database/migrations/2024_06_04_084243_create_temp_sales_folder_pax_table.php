<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempSalesFolderPaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TEMP_SALES_FOLDER_PAX', function (Blueprint $table) {
            $table->string('SF_NO');
            $table->integer('DOC_ID');
            $table->string('PROD_CAT')->nullable();
            $table->string('PAX_NAME')->nullable();
            $table->string('TICKET_NO');
            $table->string('PNR')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TEMP_SALES_FOLDER_PAX');
    }
}
