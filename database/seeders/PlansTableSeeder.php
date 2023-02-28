<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Businers',
            'url' => 'businers',
            'price' => 499.99,
            'description' => 'Plano Empresarial',
        ]);

        Plan::create([
            'name' => 'Premium',
            'url' => 'premium',
            'price' => 299.99,
            'description' => 'Plano Pessoal',
        ]);

        Plan::create([
            'name' => 'Free',
            'url' => 'free',
            'price' => 0.00,
            'description' => 'Plando Grátis'
        ]);
    }
}
