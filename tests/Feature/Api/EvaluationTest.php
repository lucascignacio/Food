<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

#php artisan test --filter=EvaluationTest
class EvaluationTest extends TestCase
{
    /**
     * Test Error Create New Evaluation
     */
    #php artisan test --filter=EvaluationTest::testErrorCreateNewEvaluation
    public function testErrorCreateNewEvaluation(): void
    {
        $order = 'fake_value';

        $response = $this->postJson("/auth/v1/orders/{$order}/evaluations");

        $response->assertStatus(404);
    }
}
