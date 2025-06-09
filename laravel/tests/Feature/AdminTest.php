<?php

use Tests\Builders\AccountBuilder;

test('Admin Login', function () {

    $admin = (new AccountBuilder())
        ->withPassword('Testing123')
        ->withGoogle2fa('OOERZLXOU2NTCUK4')
        ->createAdmin()
    ;
    $body = [
        'Email' => $admin->Email,
        'Password' => 'Testing123',

        'Google2fa' => '735308',
    ];

    $response = $this->post('/api/admin/login',$body);
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

test('Admin Reset', function () {
    $response = $this->put('/api/admin/reset');
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
        ]);
});

test('Admin Notification', function () {
    $response = $this->get('/api/admin/notification');
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
        ]);
});

test('Admin Create', function () {

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

    $response = $this->withHeaders($headers)->post('/api/admin/create',$body);
    $response->assertStatus(201)
        ->assertJsonStructure([
            'message',
        ]);
});
