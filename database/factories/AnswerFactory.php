<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Answer;
use Illuminate\Support\Str; 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        return [
            'id' => (string)Str::uuid(),
            'content' => $this->faker->paragraph(),
            'user_id' => \App\Models\User::factory(),
            'question_id' => \App\Models\Question::factory(),
        ];
    }
}
