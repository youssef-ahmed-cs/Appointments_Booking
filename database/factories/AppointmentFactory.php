<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Service;

class AppointmentFactory extends Factory
{
    public function definition(): array
    {
        $provider = User::where('role', 'provider')->inRandomOrder()->first() ?? User::factory()->create(['role' => 'provider']);
        $client = User::where('role', 'client')->inRandomOrder()->first() ?? User::factory()->create(['role' => 'client']);
        $service = Service::where('provider_id', $provider->id)->inRandomOrder()->first() ?? Service::factory()->create(['provider_id' => $provider->id]);

        $date = fake()->dateTimeBetween('+1 days', '+10 days');
        $startTime = fake()->time('H:i:s');
        $endTime = date('H:i:s', strtotime($startTime) + (30 * 60));

        return [
            'client_id' => $client->id,
            'provider_id' => $provider->id,
            'service_id' => $service->id,
            'date' => $date->format('Y-m-d'),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled', 'completed']),
            'notes' => fake()->sentence(),
        ];
    }
}
