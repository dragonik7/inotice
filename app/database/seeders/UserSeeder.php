<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::factory(10)->create();
        $dataArr = [
            'name' => 'Ибрагимов Шамиль Русланович',
            'email' => 'Shamil79797@gmail.com',
            'avatar' => json_encode("storage/avatar_user/rSO1AHAdrVhqK9M9P9UrZwAPkhnStKsd7bSwPojT.png"),
            'email_verified_at' => now(),
            'password' => Hash::make('qwer1234'), // password
            'role_id' => User::ROLE_USER,
            'remember_token' => Str::random(10),
        ];
        DB::table('users')->insert($dataArr);
    }
}
