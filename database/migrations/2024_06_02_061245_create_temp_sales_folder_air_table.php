<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempSalesFolderAirTable extends Migration
{
    public function up()
    {
        Schema::create('TEMP_SALES_FOLDER_AIR', function (Blueprint $table) {
            $table->string('SF_NO', 50); // Maximizing length to 50 characters
            $table->integer('DOC_ID');
            $table->string('AL_CODE', 50); // Maximizing length to 50 characters
            $table->string('FLIGHT_NUM', 50)->nullable(); // Maximizing length to 50 characters
            $table->string('DEPT_CITY', 50)->nullable(); // Maximizing length to 50 characters
            $table->dateTime('DEPT_DATE')->nullable();
            $table->string('DEPT_TIME', 50)->nullable(); // Maximizing length to 50 characters
            $table->string('ARVL_CITY', 50)->nullable(); // Maximizing length to 50 characters
            $table->dateTime('ARVL_DATE')->nullable();
            $table->string('ARVL_TIME', 50)->nullable(); // Maximizing length to 50 characters
            $table->string('SERVICE_CLASS', 50)->nullable(); // Maximizing length to 50 characters
        });
    }

    public function down()
    {
        Schema::dropIfExists('TEMP_SALES_FOLDER_AIR');
    }
}
