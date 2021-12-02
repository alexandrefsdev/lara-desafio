<?php

namespace Tests\Feature\app\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\Client;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use DatabaseMigrations;


    public function testShouldCreateAClientAndReceive201()
    {
        // Prepare
        $payload = [
            'name' => 'Alexandre Silveira',
            'phone' => '1518186186',
            'CPF' => '03315844879',
            'license_plate' => 'AAA7897',
        ];

        // Act
        $result = $this->post('/api/cliente/', $payload);

        // Assert
        $result->assertStatus(201);

    }
}
