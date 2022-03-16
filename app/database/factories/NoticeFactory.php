<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Note::class;
    public function definition()
    {
        $title = $this->faker->title;
        $text = $this->faker->sentence(rand(500,1000));


        return [
            'title' => $title,
            'text' => $text,
            'user_id' => 1
        ];
    }
}
