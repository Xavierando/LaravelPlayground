<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        $this->call(ServiceSeeder::class);
        $this->call(BookingSeeder::class);
        $this->call(WorkingTimeSeeder::class);
    }
}
