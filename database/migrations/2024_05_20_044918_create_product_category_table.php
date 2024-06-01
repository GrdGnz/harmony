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
            $table->string('PROD_CAT');
            $table->string('PROD_CAT_DESCR');
            $table->boolean('STATUS');
            $table->timestamps();
        });

        // Insert default values
        DB::table('PRODUCT_CATEGORY')->insert([
            ['PROD_CAT' => 'A', 'PROD_CAT_DESCR' => 'AIR', 'STATUS' => 1],
            ['PROD_CAT' => 'H', 'PROD_CAT_DESCR' => 'HOTEL', 'STATUS' => 1],
            ['PROD_CAT' => 'C', 'PROD_CAT_DESCR' => 'CAR / TRANSFER', 'STATUS' => 1],
            ['PROD_CAT' => 'M', 'PROD_CAT_DESCR' => 'MISCELLANEOUS', 'STATUS' => 1],
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
