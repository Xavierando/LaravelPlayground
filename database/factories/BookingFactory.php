<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            's_date' => '2025-06-'.rand(9, 29),
            's_time' => fake()->randomElement(['08', '09', '10', '11', '15', '17', '18'])
                .':'.fake()->randomElement(['00', '15', '30', '45']).':00',
            'payed' => fake()->boolean(),
            'service_id' => Service::inRandomOrder()->first(),
            'user_id' => User::inRandomOrder()->first(),
        ];
    }
}
