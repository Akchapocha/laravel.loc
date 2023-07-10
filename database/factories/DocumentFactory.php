<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(['Паспорт', 'Водительское у-е', 'Свид. о рождении']),
            'lastName' => $this->faker->lastName(),
            'firstName' => $this->faker->firstName(),
            'middleName' => $this->faker->firstName(),
            'birthdate' => $this->faker->date(),
            'country' => $this->faker->country()
        ];
    }
}
