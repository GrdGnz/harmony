<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ROUTE', function (Blueprint $table) {
            $table->id();
            $table->string('ROUTE_CODE');
            $table->string('ROUTE_DESCR');
            $table->boolean('STATUS');
        });

        // Insert default values
        DB::table('ROUTE')->insert([
            ['ROUTE_CODE' => 'D', 'ROUTE_DESCR' => 'Domestic', 'status' => 1],
            ['ROUTE_CODE' => 'I', 'ROUTE_DESCR' => 'International', 'status' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ROUTE');
    }
}
