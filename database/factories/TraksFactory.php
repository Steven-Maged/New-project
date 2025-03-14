<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Traks>
 */
class TraksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trackName'=>fake()->name(),
            'trackPhoto'=>fake()->url(),
            'trackDescription'=>fake()->text(),
            'trackCategory'=>fake()->word()
        ];
    }
}
