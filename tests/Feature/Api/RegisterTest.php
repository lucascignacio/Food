<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

#php artisan test --filter=RegisterTest
class RegisterTest extends TestCase
{
    /**
     * Error Create New Client
     */
    #php artisan test --filter=RegisterTest::testErrorCreateNewClient
    public function testErrorCreateNewClient(): void
    {
        $payload = [
            'name' => 'Marcos Brás',
            'email' => 'marcosbras@gmail.com',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(422);
    }

    /**
     * Success Create New Client
     */
    #php artisan test --filter=RegisterTest::testCreateNewClient
    public function testCreateNewClient(): void
    {
        $payload = [
            'name' => 'Marcos Brás',
            'email' => 'marcosbras@gmail.com',
            'password' => '123456',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(201)
                    ->assertExactJson([
                        'data' => [
                            'name' => $payload['name'],
                            'email' => $payload['email']
                        ]
                    ]);
    }
}
