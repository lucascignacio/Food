<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
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
            'identify' => Str::random(5).uniqid(),
            'description' => fake()->sentence,
        ];
    }
}
