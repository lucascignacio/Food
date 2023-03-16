<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;

use Tests\TestCase;

#php artisan test --filter=OrderTest
class OrderTest extends TestCase
{
    /**
     * Validation Create New Orders
     */
    #php artisan test --filter=OrderTest::testValidationCreateNewOrder
    public function testValidationCreateNewOrder(): void
    {
        $payload = [];

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(422)
                    ->assertJsonPath('errors.token_company', [
                        trans('validation.required', ['attribute' => 'token company'])
                    ])
                    ->assertJsonPath('errors.products', [
                        trans('validation.required', ['attribute' => 'products'])
                    ]);
    }

    /**
     * Create New Orders
     */
    #php artisan test --filter=OrderTest::testCreateNewOrder
    public function testCreateNewOrder(): void
    {
        $tenant = Tenant::factory()->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];

        $products = Product::factory(10)->create();
        foreach($products as $product){
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    /**
     * Test Total Orders
     */
    #php artisan test --filter=OrderTest::testTotalOrder
    public function testTotalOrder(): void
    {
        $tenant = Tenant::factory()->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];

        $products = Product::factory(2)->create();
        foreach($products as $product){
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201)
                    ->assertJsonPath('data.total', 25.8);
    }

    /**
     * Test Order Not Found
     */
    #php artisan test --filter=OrderTest::testOrderNotFound
    public function testOrderNotFound()
    {
        $order = 'fake_value';

        $response = $this->getJson("api/v1/orders/{$order}");

        $response->assertStatus(404);
    }


    /**
     * Test Get Found
     */
    #php artisan test --filter=OrderTest::testGetOrder
    public function testGetOrder()
    {
        $order = Order::factory()->create();

        $response = $this->getJson("api/v1/orders/{$order->identify}");

        $response->assertStatus(200);
    }

    /**
     * Test Create New Total Authenticated
     */
    #php artisan test --filter=OrderTest::testTotalOrderAuthenticated
    public function testTotalOrderAuthenticated(): void
    {
        $client = Client::factory()->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;
        $tenant = Tenant::factory()->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];

        $products = Product::factory(2)->create();
        foreach($products as $product){
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1
            ]);
        }

        $response = $this->postJson('/api/auth/v1/orders', $payload, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(201);
    }

      /**
     * Test Create New Total With Table
     */
    #php artisan test --filter=OrderTest::testTotalOrderWithTable
    public function testTotalOrderWithTable(): void
    {
        $table = Table::factory()->create();
        $tenant = Tenant::factory()->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'table' => $table->uuid,
            'products' => [],
        ];

        $products = Product::factory(2)->create();
        foreach($products as $product){
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }

        /**
     * Test Get My Orders
     */
    #php artisan test --filter=OrderTest::testGetMyOrder
    public function testGetMyOrder(): void
    {
        $client = Client::factory()->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        Order::factory(10)->create(['client_id' => $client->id]);

        $response = $this->getJson('/api/auth/v1/my-orders', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
                    ->assertJsonCount(10, ['data']);
    }
}
