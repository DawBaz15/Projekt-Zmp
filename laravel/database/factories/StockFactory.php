<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StockFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'ProductID' => rand(1, 300),
            'Amount' => $this->faker->numberBetween(1, 80),
            'Location' => Str::random(4),
            'Date' => $this->faker->date(),
        ];
    }
}
