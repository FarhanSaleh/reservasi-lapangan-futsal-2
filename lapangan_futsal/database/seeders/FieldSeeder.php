<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Field::create([
            'name' => 'Lapangan 1',
            'type' => 'vinyl',
            'price_per_hour' => 100000,
        ]);

        Field::create([
            'name' => 'Lapangan 2',
            'type' => 'sintetik',
            'price_per_hour' => 150000,
        ]);
    }
}
