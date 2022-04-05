<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)->create();


         $this->call(TagSeeder::class);
         Note::factory(100)->create();
         Favorite::factory(10)->create();
    }
}
