<?php
// database/factories/DispenserFactory.php

namespace Database\Factories;

use App\Models\Dispenser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DispenserFactory extends Factory
{
    protected $model = Dispenser::class;

    public function definition()
    {
        return [
            'flow_volume' => $this->faker->randomFloat(2, 0.1, 2), // Random flow_volume between 0.1 to 2 (liters per second).
            'status' => 'close',
        ];
    }
}

