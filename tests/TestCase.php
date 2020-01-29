<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getAuthToken()
    {
        $userEmail = 'test@test.test';
        $userPassword = 'test123';

        $response = json_decode($this->postJson('/api/login', [
            'email' => $userEmail,
            'password' => $userPassword
        ])->content());

        return $response->access_token ?: '';
    }
}
