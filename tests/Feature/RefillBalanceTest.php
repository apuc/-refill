<?php

namespace Tests\Feature;

use App\CellProvider;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class RefillBalanceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->defaultHeaders = [
            'Authorization' => 'Bearer ' . $this->getAuthToken()
        ];

    }

    /** @test */
    public function user_cant_send_invalidate_data()
    {
        $requestData1 = [
            'amount' => '10000', //max = 1000
            'phone' => '123232112312' //incorrect format
        ];
        $requestData2 = [
            //void fields
        ];
        $requestData3 = [
            'amount' => '-10', //min = 1
            'phone' => '7777777777777' //incorrect format
        ];

        $this->postJson('/api/providers/1', $requestData1)
            ->assertStatus(404);
        $this->postJson('/api/providers/1', $requestData2)
            ->assertStatus(404);
        $this->postJson('/api/providers/1', $requestData3)
            ->assertStatus(404);

    }

    /** @test */
    public function user_can_see_his_last_refill_for_current_operator()
    {
        $currentOperator = CellProvider::all()->first();
        $refillData = [
            'amount' => 500,
            'phone' => 74957654321
        ];
        $this->postJson('/api/replenish/' . $currentOperator->id, $refillData)
            ->assertStatus(200);
        $response = $this->getJson('/api/replenish/' . $currentOperator->id)
            ->assertStatus(200);
        $responseContent = json_decode($response->getContent());
        $this->assertEquals($refillData['phone'], $responseContent->phone);
        $this->assertEquals($refillData['amount'], $responseContent->amount);
    }
}
