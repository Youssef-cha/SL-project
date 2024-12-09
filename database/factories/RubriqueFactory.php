<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rubrique>
 */
class RubriqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'REFERENCE_RUBRIQUE' => fake()->name(),
            'ANNEE_BUDGETAIRE' => 2024,
            'BUDGET' => 10000,
        ];
    }
}
