<?php

namespace Database\Seeders;

use App\Models\WorkingTime;
use Illuminate\Database\Seeder;

class WorkingTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkingTime::truncate();

        $workingTime = [
            [
                'weekday' => 1,
                'starttime' => '08:00:00',
                'endtime' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'weekday' => 2,
                'starttime' => '08:00:00',
                'endtime' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'weekday' => 3,
                'starttime' => '08:00:00',
                'endtime' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'weekday' => 4,
                'starttime' => '08:00:00',
                'endtime' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'weekday' => 5,
                'starttime' => '08:00:00',
                'endtime' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'weekday' => 6,
                'starttime' => '08:00:00',
                'endtime' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'weekday' => 7,
                'starttime' => '08:00:00',
                'endtime' => '12:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'weekday' => 7,
                'starttime' => '15:00:00',
                'endtime' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        WorkingTime::insert($workingTime);
    }
}
