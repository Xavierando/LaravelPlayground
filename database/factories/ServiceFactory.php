<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->realText(200),
            'price' => fake()->numberBetween(50, 100),
            'duration' => fake()->randomElement([1800, 3600, 5400, 7200]),
        ];
    }

    public function bookings(): Collection
    {
        return $this->hasMany(Booking::class);
    }
}
