<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AvailableSlotFactory extends Factory
{
    public function definition(): array
    {
        $date = fake()->dateTimeBetween('+1 days', '+10 days');
        $startTime = fake()->time('H:i:s');
        $endTime = date('H:i:s', strtotime($startTime) + (30 * 60));

        return [
            'provider_id' => User::where('role', 'provider')->inRandomOrder()->first()->id ?? User::factory()->create(['role' => 'provider'])->id,
            'date' => $date->format('Y-m-d'),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
