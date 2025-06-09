<?php

use Illuminate\Support\Str;
use Tests\Builders\AccountBuilder;

test('Stock Add', function () {

    $user = (new AccountBuilder())
        ->createUser()
    ;
    $headers = [
        'Token' => $user->_token,
    ];
    $body = [
        'ProductID' => 1,
        'Amount' => rand(1, 100),
        'Location' => Str::random(4),
        'Date' => '2020-01-01',
    ];
    $response = $this->withHeaders($headers)->post('/api/stock/add',$body);
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
        ]);
});

test('Stock Locate', function () {

    $user = (new AccountBuilder())
        ->createUser()
    ;
    $headers = [
        'Token' => $user->_token,
    ];
    $body = [
        'ProductID' => 1,
    ];
    $response = $this->withHeaders($headers)->post('/api/stock/locate',$body);
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'array',
        ]);
});

test('Stock Index', function () {

    $admin = (new AccountBuilder())
        ->createAdmin()
    ;
    $headers = [
        'Token' => $admin->_token,
    ];
    $response = $this->withHeaders($headers)->get('/api/stock/index');
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'array',
        ]);
});

test('Stock Modify', function () {

    $admin = (new AccountBuilder())
        ->createAdmin()
    ;
    $headers = [
        'Token' => $admin->_token,
    ];
    $body = [
        'ID' => 1,
        'ProductID' => 1,
        'Amount' => rand(1, 100),
        'Location' => Str::random(4),
    ];
    $response = $this->withHeaders($headers)->put('/api/stock/modify',$body);
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
        ]);
});
