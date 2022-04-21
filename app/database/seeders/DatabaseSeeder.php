<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Note;
use App\Models\Subscriber;
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
         User::factory(20)->create();
         $this->call(TagSeeder::class);
         Note::factory(50)->create();
         Favorite::factory(100)->create();
         Subscriber::factory(20)->create();
    }
}
