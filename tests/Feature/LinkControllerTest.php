<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


# php artisan test --filter=LinkControllerTest
class LinkControllerTest extends TestCase
{

    # php artisan test --filter=LinkControllerTest::test_store
    public function test_store(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user);

        $response = $this->post('/api/links', [
            'long_link' => 'https://www.esteticaexperts.com.br',
        ]);

        $response->dump();

        $response->assertStatus(200);
    }

    # php artisan test --filter=LinkControllerTest::test_index
    public function test_index(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user);

        $response = $this->get('/api/links');

        $response->dump();

        $response->assertStatus(200);
    }

    # php artisan test --filter=LinkControllerTest::test_update
    public function test_update(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user);

        $response = $this->put('/api/links/2', [
            'long_link' => 'https://www.esteticaexperts.com.br',
            'slug' => 'rase45322',
            'title' => 'TESTE EDITADO'
        ]);

        $response->dump();

        $response->assertStatus(200);
    }


    # php artisan test --filter=LinkControllerTest::test_show
    public function test_show(): void
    {
        $user = User::find(1);
        $response = $this->actingAs($user);

        $response = $this->get('/api/links/2');

        $response->dump();

        $response->assertStatus(200);
    }

    # php artisan test --filter=LinkControllerTest::test_redirect
    public function test_redirect(): void
    {
        $response = $this->get('/hkcGV9s');

        $response->assertStatus(302);
    }
}
