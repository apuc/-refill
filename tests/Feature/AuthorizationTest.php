<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function registered_user_can_log_in()
    {
        $userEmail = 'test@test.test';
        $userPassword = 'test123';

        $this->postJson('/api/login', [
            'email' => $userEmail,
            'password' => $userPassword
        ])->assertStatus(200);
    }

    /** @test */
    public function not_registered_user_cant_log_in()
    {
        $userEmail = 'wrongemail@test.test';
        $userPassword = 'wrong password';

        $this->postJson('/api/login', [
            'email' => $userEmail,
            'password' => $userPassword
        ])->assertStatus(400);
    }

    /** @test */
    public function not_authorized_user_cant_see_list_of_operators()
    {
        $this->getJson('/api/providers')
            ->assertStatus(401);
    }


    /** @test */
    public function authorized_user_can_see_list_of_operators()
    {
        $this->defaultHeaders = [
            'Authorization' => 'Bearer ' . $this->getAuthToken()
        ];
        $this->getJson('/api/providers')
            ->assertStatus(200);
    }
}
