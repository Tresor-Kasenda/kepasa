<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_create_user(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('api.paypal.create.transaction', [
            $user,
        ]);
        $response->assertOk();
    }
}
