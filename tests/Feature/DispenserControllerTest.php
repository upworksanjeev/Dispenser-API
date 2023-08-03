<?php
// tests/Feature/DispenserControllerTest.php

namespace Tests\Feature;

use App\Models\Dispenser;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DispenserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCreateDispenser()
    {
        $flowVolume = 0.5; // liters per second
        $data = [
            'flow_volume' => $flowVolume,
        ];

        $response = $this->postJson('/api/dispensers', $data);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Dispenser created successfully',
                'dispenser' => [
                    'flow_volume' => $flowVolume,
                    'status' => 'close',
                ],
            ]);
    }

    public function testUpdateDispenserStatusToOpen()
    {
        $dispenser = Dispenser::factory()->create(['status' => 'close']);

        $data = [
            'status' => 'open',
        ];

        $response = $this->postJson("/api/dispensers/{$dispenser->id}", $data);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Dispenser status updated successfully',
            ]);

        $this->assertDatabaseHas('dispensers', [
            'id' => $dispenser->id,
            'status' => 'open',
        ]);
    }

    public function testUpdateDispenserStatusToClose()
    {
        $dispenser = Dispenser::factory()->create(['status' => 'open']);

        // Simulate a delay before closing the dispenser
        sleep(2);

        $data = [
            'status' => 'close',
        ];

        $response = $this->postJson("/api/dispensers/{$dispenser->id}", $data);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Dispenser status updated successfully',
            ]);

        $this->assertDatabaseHas('dispensers', [
            'id' => $dispenser->id,
            'status' => 'close',
        ]);

        // Verify that the usage and total spend information is correctly stored in the database (You can customize this part based on your implementation).
    }

    // Add additional test cases for 'getUsage' and 'getReport' methods if needed.
}
