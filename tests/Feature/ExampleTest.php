<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
