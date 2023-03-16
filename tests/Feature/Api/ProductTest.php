<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

#php artisan test --filter=ProductTest
class ProductTest extends TestCase
{
    /**
     * Error Get All Products
     */
    #php artisan test --filter=ProductTest::testErrorGetAllProducts
    public function testErrorGetAllProducts(): void
    {
        $tenant = 'fake_value';

        $response = $this->getJson("/api/v1/products?token_company={$tenant}");

        $response->assertStatus(422);
    }

     /**
     * Get All Products
     */
    #php artisan test --filter=ProductTest::testGetAllProducts
    public function testGetAllProducts(): void
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/products?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

     /**
     * Product Not Found (404)
     */
    #php artisan test --filter=ProductTest::testNotFoundProduct
    public function testNotFoundProduct(): void
    {
        $tenant = Tenant::factory()->create();
        $product = 'fake_value';

        $response = $this->getJson("/api/v1/products/{$product}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }


     /**
     * Get Product By Identify
     */
    #php artisan test --filter=ProductTest::testGetProductByIdentify
    public function testGetProductByIdentify(): void
    {
        $tenant = Tenant::factory()->create();
        $product = Product::factory()->create();

        $response = $this->getJson("/api/v1/products/{$product->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
