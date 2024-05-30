<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PRODUCT_CATEGORY', function (Blueprint $table) {
            $table->id();
            $table->string('prod_cat');
            $table->string('prod_name');
            $table->boolean('status');
            $table->timestamps();
        });

        // Insert default values
        DB::table('PRODUCT_CATEGORY')->insert([
            ['prod_cat' => 'A', 'prod_name' => 'AIR', 'status' => 1],
            ['prod_cat' => 'H', 'prod_name' => 'HOTEL', 'status' => 1],
            ['prod_cat' => 'C', 'prod_name' => 'CAR / TRANSFER', 'status' => 1],
            ['prod_cat' => 'M', 'prod_name' => 'MISCELLANEOUS', 'status' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PRODUCT_CATEGORY');
    }
}
