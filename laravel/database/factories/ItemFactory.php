<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'Name' => fake()->country(),
        ];
    }
}
