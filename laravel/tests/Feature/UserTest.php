<?php

test('Index', function () {

    $data = [
        'Token' => 'test_token3'
    ];

    $response = $this->getJson('/api/user/index',$data);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => ['Token']
        ]);
});
