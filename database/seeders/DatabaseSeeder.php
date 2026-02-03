<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'id' => '123e4567-e89b-12d3-a456-426614174000',
            'password' => bcrypt('password'),
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
