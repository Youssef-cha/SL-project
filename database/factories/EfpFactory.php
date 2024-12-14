<?php

namespace Database\Factories;

use App\Models\Complexe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Efp>
 */
class EfpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_complexe' => Complexe::factory(),
            'nom_efp' => fake()->name(),
        ];
    }
}
