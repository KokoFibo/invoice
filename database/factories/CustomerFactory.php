<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstname,
            'salutation' => fake()->title,
            'title' => fake()->randomElement(['CEO', 'CAO', 'Senior VP', 'VP', 'Senior Manager', 'Managing Director']),
            'company' => fake()->company,
            'address' => fake()->address,
            'mobile' => fake()->phoneNumber,
            'email' => fake()->unique()->safeEmail,
            'notes' => fake()->words(5, true),
        ];
    }
}
