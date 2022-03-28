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
    public function definition()
    {
        $title = $this->faker->sentence(rand(1,5));
        $text = $this->faker->sentence(rand(10,20));


        return [
            'title' => $title,
            'text' => $text,
            'image'=>$this->faker->imageUrl(),
            'user_id' => User::get()->random()->id,
            'tag_id' => Tag::get()->random()->id,
        ];
    }
}
