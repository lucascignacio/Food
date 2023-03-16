<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

#php artisan test --filter=CategoryTest
class CategoryTest extends TestCase
{
    /**
     * Error Get All Categories by Tenant
     */
    #php artisan test --filter=CategoryTest::testGetAllCategoriesTenantError
    public function testGetAllCategoriesTenantError(): void
    {
        $response = $this->getJson('/api/v1/categories');

        $response->assertStatus(422);
    }

     /**
     * Get Categories All by Tenant
     */
    #php artisan test --filter=CategoryTest::testGetAllCategoriesByTenant
    public function testGetAllCategoriesByTenant()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

     /**
     * Error Get Category by Tenant
     */
    #php artisan test --filter=CategoryTest::testErrorGetCategoryByTenant
    public function testErrorGetCategoryByTenant()
    {
        $category = 'fake_value';
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");

        $response ->assertStatus(404);
    }

    /**
     * Get Category by Tenant
     */
    #php artisan test --filter=CategoryTest::testGetCategoryByTenant
    public function testGetCategoryByTenant()
    {
        $category = Category::factory()->create();
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");

        $response ->assertStatus(200);
    }
}
