<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $names = [
            'admin',
            'user',
        ];

        foreach ($names as $name) {
            $dataArr = [
                'name' => $name,
            ];

            DB::table('roles')->insert($dataArr);
        }
    }
}
