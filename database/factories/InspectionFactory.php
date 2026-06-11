<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InspectionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'last_inspection_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'next_inspection_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'insurance_expiry_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'mileage_at_inspection' => $this->faker->numberBetween(10000, 270000),
            'paint_thickness_hood' => $this->faker->numberBetween(90, 140),
            'paint_thickness_roof' => $this->faker->numberBetween(90, 140),
            'paint_thickness_left_side' => $this->faker->numberBetween(90, 160),
            'paint_thickness_right_side' => $this->faker->numberBetween(90, 250), // Wyższe wartości sugerują drugą warstwę lakieru
            'known_defects' => $this->faker->randomElement(['Brak', 'Drobne rysy na tylnym zderzaku', 'Odprysk na szybie czołowej']),
        ];
    }
}
