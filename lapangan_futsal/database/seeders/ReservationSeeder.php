<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::create([
            'reservation_date' => '2023-10-01',
            'status' => 'pending',
            'user_id' => 3,
            'schedule_id' => 1,
        ]);
    }
}
