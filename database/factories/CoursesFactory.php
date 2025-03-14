<?php

namespace Database\Factories;

use App\Models\Traks;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courses>
 */
class CoursesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'courseName'=>fake()->word(),
            'courseDescription'=>fake()->text(),
            'coursePhoto'=>fake()->url(),
            'Price'=>fake()->numberBetween(50,100000),
            'bayState'=>fake()->boolean(),
            'track_id' => Traks::factory()
        ];
    }
}
