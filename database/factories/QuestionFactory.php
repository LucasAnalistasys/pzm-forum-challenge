<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title) . '-' . \Illuminate\Support\Str::random(5),
            'content' => $this->faker->paragraph(), // Mudamos para content aqui também
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
