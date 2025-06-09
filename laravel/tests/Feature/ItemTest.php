<?php

use Tests\Builders\AccountBuilder;

test('Item Create', function () {
    $admin = (new AccountBuilder())
        ->createAdmin()
    ;
    $headers = [
        'Token' => $admin->_token,
    ];
    $body = [
        'Name' => fake()->country(),
    ];

    $response = $this->withHeaders($headers)->post('/api/item/create',$body);
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
        ]);
});

test('Item Modify', function () {
    $admin = (new AccountBuilder())
        ->createAdmin()
    ;
    $headers = [
        'Token' => $admin->_token,
    ];
    $body = [
        'ID' => 1,
        'Name' => fake()->name(),
    ];

    $response = $this->withHeaders($headers)->put('/api/item/modify',$body);
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
        ]);
});

test('Item Index', function () {
    $admin = (new AccountBuilder())
        ->createAdmin()
    ;
    $headers = [
        'Token' => $admin->_token,
    ];

    $response = $this->withHeaders($headers)->get('/api/item/index');
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'array'
        ]);
});
