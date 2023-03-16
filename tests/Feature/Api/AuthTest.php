<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

#php artisan test --filter=AuthTest
class AuthTest extends TestCase
{
    /**
     * Test Validation Auth
     */
    #php artisan test --filter=AuthTest::testValidationAuth
    public function testValidationAuth(): void
    {
        $response = $this->postJson('/api/auth/token');

        $response->assertStatus(422);
    }

    /**
     * Test Auth With Client Fake
     */
    #php artisan test --filter=AuthTest::testAuthClientFake
    public function testAuthClientFake(): void
    {
        $payload = [
            'email' => 'fake@mail.com',
            'password' => '1234',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(404)
                    ->assertExactJson([
                        'message' => trans('messages.invalid_credentials'),
                    ]);
    }

     /**
     * Test Auth Success
     */
    #php artisan test --filter=AuthTest::testAuthSuccess
    public function testAuthSuccess(): void
    {  
        $client = Client::factory()->create();

        $payload = [
            'email' => $client->email,
            'password' => 'password',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(200)
                    ->assertJsonStructure(['token']);
    }

    /**
     * Error Get Me
     */
    #php artisan test --filter=AuthTest::testErrorGetMe
    public function testErrorGetMe(): void
    {  
        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(401);
    }

    /**
     * Success Get Me
     */
    #php artisan test --filter=AuthTest::testGetMe
    public function testGetMe(): void
    {  
        $client = Client::factory()->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->getJson('/api/auth/me',[
            'Authorization'=> "Bearer {$token}",
        ]);

        $response->assertStatus(200)
                    ->assertExactJson([
                        'data' => [
                            'name' => $client->name,
                            'email' => $client->email,
                        ]
                    ]);
    }

     /**
     * Logout
     */
    #php artisan test --filter=AuthTest::testLogout
    public function testLogout(): void
    {  
        $client = Client::factory()->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->postJson('/api/auth/logout',[],[
            'Authorization'=> "Bearer {$token}",
        ]);

        $response->assertStatus(204);
    }


}
