<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


# php artisan test --filter=MetricControllerTest
class MetricControllerTest extends TestCase
{

    # php artisan test --filter=MetricControllerTest::test_metrics
    public function test_metrics(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user);

        $response = $this->get('/api/metrics');

        $response->dump();

        $response->assertStatus(200);
    }

}
