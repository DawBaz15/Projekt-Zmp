<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PragmaRX\Google2FA\Google2FA;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $google2fa = new Google2FA();
        return [
            'Email' => fake()->unique()->safeEmail(),
            'Phone' => fake()->unique()->numberBetween(100000000, 999999999),
            'Name' => fake()->name(),
            'Surname' => fake()->name(),
            'Password' => static::$password ??= Hash::make('password'),
            'AccountDate' => now(),
            '_token' => Str::random(60),
            'Google2fa' => $google2fa->generateSecretKey(),
            '_tokenExpiry' => now()->addHours(14),
        ];
    }
}
