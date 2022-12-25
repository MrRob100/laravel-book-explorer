<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookCSV>
 */
class BookCSVFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'book_title' => fake()->sentence(),
            'book_author' => fake()->name,
            'date_published' => fake()->date(),
            'unique_identifier' => Str::uuid(),
            'publisher_name' => fake()->name(),
            'file_name' => fake()->word() . Str::uuid(),
        ];
    }
}
