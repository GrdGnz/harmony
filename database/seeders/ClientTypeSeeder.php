<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientTypeSeeder extends Seeder
{
    public function run()
    {
        $clientTypes = [
            ['code' => 'CC', 'name' => 'Corporate'],
            ['code' => 'CP', 'name' => 'Personal'],
            ['code' => 'CW', 'name' => 'Walk-In'],
            ['code' => 'EM', 'name' => 'Employees'],
        ];

        DB::table('CLIENT_TYPE')->insert($clientTypes);
    }
}
