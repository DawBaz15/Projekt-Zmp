<?php

use Tests\Builders\AccountBuilder;

test('User Index', function () {

    $admin = (new AccountBuilder())
        ->createAdmin()
    ;
    $headers = [
        'Token' => $admin->_token,
    ];

    $response = $this->withHeaders($headers)->get('/api/user/index');
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'array',
        ]);
});

test('User Login', function () {

    $user = (new AccountBuilder())
        ->withPassword('Testing123')
        ->withGoogle2fa('OOERZLXOU2NTCUK4')
        ->createUser()
    ;
    $body = [
        'Email' => $user->Email,
        'Password' => 'Testing123',

        'Google2fa' => '735308',
    ];

    $response = $this->post('/api/user/login',$body);
    $response->assertStatus(400)
        ->assertJsonStructure([
            'message',
        ]);
    /*
    $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'message',
        ]);
    */
});

test('User Create', function () {

    $admin = (new AccountBuilder())
        ->createAdmin()
    ;
    $headers = [
        'Token' => $admin->_token,
    ];
    $body = [
        'Email' => fake()->unique()->safeEmail(),
        'Phone' => fake()->unique()->numberBetween(100000000, 999999999),
        'Name' => fake()->name(),
        'Surname' => fake()->name(),
    ];

    $response = $this->withHeaders($headers)->post('/api/user/create',$body);
    $response->assertStatus(201)
        ->assertJsonStructure([
            'message',
        ]);
});

test('User Modify', function () {

    $admin = (new AccountBuilder())
        ->createAdmin()
    ;
    $headers = [
        'Token' => $admin->_token,
    ];
    $body = [
        'UserId' => 1,
        'Email' => fake()->unique()->safeEmail(),
        'Phone' => fake()->unique()->numberBetween(100000000, 999999999),
        'Name' => fake()->name(),
        'Surname' => fake()->name(),
        'AccountActive' => true,
    ];

    $response = $this->withHeaders($headers)->put('/api/user/modify',$body);
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
        ]);
});

test('User Reset', function () {
    $response = $this->put('/api/user/reset');
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
        ]);
});
