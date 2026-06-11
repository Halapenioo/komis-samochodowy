<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RepairFactory extends Factory
{
    public function definition(): array
    {
        return [
            'replaced_part_name' => $this->faker->randomElement(['Komplet rozrządu', 'Klocki i tarcze przód', 'Olej silnikowy i filtry', 'Dwumasa', 'Turbosprężarka']),
            'oem_number' => $this->faker->bothify('???-####-###'),
            'part_status' => $this->faker->randomElement(['nowa oryginalna', 'markowy zamiennik', 'regenerowana']),
            'repair_date' => $this->faker->dateTimeBetween('-3 years', 'now'),
            'mileage_at_repair' => $this->faker->numberBetween(20000, 250000),
            'part_cost' => $this->faker->randomFloat(2, 100, 4000),
            'labor_cost' => $this->faker->randomFloat(2, 150, 2000),
        ];
    }
}
