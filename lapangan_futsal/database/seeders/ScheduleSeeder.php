<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create([
            'day' => 'Senin',
            'start_time' => '16:00',
            'end_time' => '17:00',
            'status' => 'available',
            'field_id' => 1,
        ]);

        Schedule::create([
            'day' => 'Senin',
            'start_time' => '19:00',
            'end_time' => '21:00',
            'status' => 'available',
            'field_id' => 1,
        ]);

        Schedule::create([
            'day' => 'Selasa',
            'start_time' => '16:00',
            'end_time' => '17:00',
            'status' => 'available',
            'field_id' => 1,
        ]);

        Schedule::create([
            'day' => 'Selasa',
            'start_time' => '19:00',
            'end_time' => '21:00',
            'status' => 'available',
            'field_id' => 1,
        ]);

        Schedule::create([
            'day' => 'Rabu',
            'start_time' => '16:00',
            'end_time' => '17:00',
            'status' => 'available',
            'field_id' => 1,
        ]);
        Schedule::create([
            'day' => 'Rabu',
            'start_time' => '19:00',
            'end_time' => '21:00',
            'status' => 'available',
            'field_id' => 1,
        ]);

        Schedule::create([
            'day' => 'Kamis',
            'start_time' => '16:00',
            'end_time' => '17:00',
            'status' => 'available',
            'field_id' => 1,
        ]);

        Schedule::create([
            'day' => 'Kamis',
            'start_time' => '19:00',
            'end_time' => '21:00',
            'status' => 'available',
            'field_id' => 1,
        ]);

        Schedule::create([
            'day' => 'Jumat',
            'start_time' => '16:00',
            'end_time' => '17:00',
            'status' => 'available',
            'field_id' => 1,
        ]);

        Schedule::create([
            'day' => 'Jumat',
            'start_time' => '19:00',
            'end_time' => '21:00',
            'status' => 'available',
            'field_id' => 1,
        ]);
    }
}
