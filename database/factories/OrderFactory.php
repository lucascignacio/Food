<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Tenant;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory()->create(),
            'identify' => uniqid() . Str::random(10),
            'total' => 80.0,
            'status' => 'open',
        ];
    }
}
