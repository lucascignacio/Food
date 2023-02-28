<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'cnpj' => '23882706000120',
            'name' => 'TenantTi',
            'url' => 'Tenanti',
            'email' => 'tenant@gmail.com',
        ]);
    }
}
