<?php

namespace Tests\Feature\Api;

use App\Models\Tenant;
use Carbon\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

#php artisan test --filter=TenantTest
class TenantTest extends TestCase
{
    /**
     * Test Get All Tenants
     */
    #php artisan test --filter=TenantTest::testGetAllTenants
    public function testGetAllTenants(): void
    {
        Tenant::factory(10)->create();
    
        $response = $this->getJson('/api/v1/tenants');

        $response->assertStatus(200)
                ->assertJsonCount(10, 'data');
    }

    /**
     * Test Get Single Tenants
     */
    #php artisan test --filter=TenantTest::testErrorGetTenant
    public function testErrorGetTenant(): void
    {
        $tenant = 'fake_value';
        
        $response = $this->getJson("/api/v1/tenants/{$tenant}");

        $response->assertStatus(404);
    }

      /**
     * Test Get Error Single Tenants
     */
    #php artisan test --filter=TenantTest::testGetTenantByIdentify
    public function testGetTenantByIdentify(): void
    {
        $tenant = Tenant::factory()->create();
        
        $response = $this->getJson("/api/v1/tenants/{$tenant->uuid}");

        $response->assertStatus(200);
    }
}
