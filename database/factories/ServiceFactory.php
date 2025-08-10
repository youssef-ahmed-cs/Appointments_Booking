<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'provider_id' => User::where('role', 'provider')->inRandomOrder()->first()->id ?? User::factory()->create(['role' => 'provider'])->id,
            'name' => $this->faker->word().' Service',
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10,300),
            'duration_minutes' => $this->faker->randomElement([30, 60, 90, 120]),
        ];
    }
}
