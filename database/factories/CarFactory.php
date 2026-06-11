<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'vin' => $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'brand' => $this->faker->randomElement(['Audi', 'BMW', 'Mercedes-Benz', 'Toyota', 'Honda', 'Volvo']),
            'model' => $this->faker->word(),
            'production_year' => $this->faker->numberBetween(2012, 2024),
            'first_registration_date' => $this->faker->dateTimeBetween('-10 years', '-1 month'),
            'engine_capacity' => $this->faker->randomElement([1390, 1598, 1968, 1995, 2998]),
            'engine_power' => $this->faker->numberBetween(110, 350),
            'engine_code' => $this->faker->bothify('??-####'),
            'fuel_type' => $this->faker->randomElement(['Benzyna', 'Diesel', 'Hybryda']),
            'transmission' => $this->faker->randomElement(['Manualna', 'Automatyczna']),
            'drive_type' => $this->faker->randomElement(['FWD', 'RWD', 'AWD']),
            'current_mileage' => $this->faker->numberBetween(15000, 280000),
            'usage_description' => $this->faker->paragraph(),
            'previous_owners_count' => $this->faker->numberBetween(1, 3),
            'origin_country' => $this->faker->randomElement(['Polska', 'Niemcy', 'Szwajcaria']),
            'is_accident_free' => $this->faker->boolean(80), // 80% szans, że jest bezwypadkowy
            'accident_description' => null,
            'status' => 'gotowy do sprzedaży',
        ];
    }
}
