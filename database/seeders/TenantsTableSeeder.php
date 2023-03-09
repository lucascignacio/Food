<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '12345678901234',
            'name' => 'TenantTi',
            'url' => 'tenanti',
            'email' => 'marcosbras@gmail.com',
        ]);
    }
}
