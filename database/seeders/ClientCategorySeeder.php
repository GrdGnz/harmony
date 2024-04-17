<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clientCategories = [
            ['code' => 'EA', 'name' => 'Employee Account'],
            ['code' => 'PA', 'name' => 'Personal Account'],
            ['code' => 'RA', 'name' => 'Corporate Account'],
            ['code' => 'SH', 'name' => 'Supplier Account'],
            ['code' => 'SUBAGN', 'name' => 'Sub-agent'],
            ['code' => 'WA', 'name' => 'Walk-in Account'],
        ];

        DB::table('CLIENT_CATEGORY')->insert($clientCategories);
    }
}
