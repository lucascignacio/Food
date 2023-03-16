<?php

namespace Tests\Feature\Api;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

#php artisan test --filter=TableTest
class TableTest extends TestCase
{
      /**
     * Error Get All Tables by Tenant
     */
    #php artisan test --filter=TableTest::testGetAllTablesTenantError
    public function testGetAllTablesTenantError(): void
    {
        $response = $this->getJson('/api/v1/tables');

        $response->assertStatus(422);
    }

     /**
     * Get Tables All by Tenant
     */
    #php artisan test --filter=TableTest::testGetAllTablesByTenant
    public function testGetAllTablesByTenant()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

     /**
     * Error Get Tables by Tenant
     */
    #php artisan test --filter=TableTest::testErrorGetTablesByTenant
    public function testErrorGetTablesByTenant()
    {
        $table = 'fake_value';
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");

        $response ->assertStatus(404);
    }

    /**
     * Get Tables by Tenant
     */
    #php artisan test --filter=TableTest::testGetTablesByTenant
    public function testGetTablesByTenant()
    {
        $table = Table::factory()->create();
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");

        $response ->assertStatus(200);
    }
}
