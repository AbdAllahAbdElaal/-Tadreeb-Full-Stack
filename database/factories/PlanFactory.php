<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement(['Basic', 'Professional', 'Enterprise']);

        $price = match($name) {
            'Basic'        => 99,
            'Professional' => 249,
            'Enterprise'   => 999,
        };

        $maxStudents = match($price) {
            99       => 100,
            249      => 500,
            999      => 999,
        };

        $maxProgram = match($price) {
            99       => 5,
            249      => 20,
            999      => 99,
        };

        $duration = match($price) {
            99       => 'month',
            249      => 'month',
            999      => 'year',
        };

        $description = match($name) {
            'Basic'        => 'Basic reporting',
            'Professional' => 'Advanced analytics',
            'Enterprise'   => 'Custom features',
        };

        return [
            'name' => $name,
            'price' => $price,
            'max_student' => $maxStudents,
            'max_program' => $maxProgram,
            'duration' => $duration,
            'description' => $description,
        ];
    }
}
