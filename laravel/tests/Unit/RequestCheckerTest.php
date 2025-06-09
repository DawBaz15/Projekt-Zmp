<?php

use App\Http\Controllers\RequestChecker;

test('Account Creation', function () {
    $email = fake()->unique()->safeEmail();
    $phone = fake()->unique()->numberBetween(100000000, 999999999);
    $name = fake()->name();
    $surname = fake()->name();

    $this->assertEquals(RequestChecker::accountCreation($email, $phone, $name, $surname, $phone),true);
});

test('Email Validation', function () {
    $email = fake()->unique()->safeEmail();
    $this->assertEquals(RequestChecker::emailValidation($email),true);
});

test('Phone Validation', function () {
    $phone = fake()->unique()->numberBetween(100000000, 999999999);
    $this->assertEquals(RequestChecker::phoneValidation($phone),true);
});

test('String Validation', function () {
    $string = fake()->name();
    $this->assertEquals(RequestChecker::stringValidation($string),true);
});

test('Account Active Validation', function () {
    $boolean = fake()->boolean();
    $this->assertEquals(RequestChecker::accountActiveValidation($boolean),true);
});
