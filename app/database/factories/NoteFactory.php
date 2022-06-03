<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Note::class;

    /**
     * @throws \Exception
     */
    public function definition()
    {
        $paths = array();
        $createdAt= $this->faker->date('Y-m-d','2000-9-12');
        $updatedAt = $this->faker->dateTimeBetween($createdAt,'now');
        for($i=1; $i<=random_int(1,2);$i++){
            $paths[] = $this->faker->imageUrl();
        }
        return [
            'title' => $this->faker->sentence(rand(1,5)),
            'text' => $this->faker->sentence(rand(10,20)),
            'photos' => json_encode($paths),
            'user_id' => User::get()->random()->id,
            'tag_id' => Tag::get()->random()->id,
            'created_at'=>$createdAt,
            'updated_at'=>$updatedAt
        ];
    }
}
