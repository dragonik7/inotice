<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $names = [
            'работа',
            'учеба',
            'заметки ни о чем'
        ];

        foreach ($names as $name) {

            $dataArr = [
                'name' => $name,
                'user_id' => User::get()->random()->id
            ];

            DB::table('tags')->insert($dataArr);
        }
    }
}
