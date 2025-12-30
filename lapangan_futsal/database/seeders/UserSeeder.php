<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('name', 'admin')->first();
        $pengelola = Role::where('name', 'pengelola')->first();
        $user = Role::where('name', 'user')->first();

        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@mail.com',
            'password' => Hash::make('112233'),
            'role_id' => $admin->id,
            'phone_number' => '081234567890',
        ]);

        User::create([
            'name' => 'Pengelola Lapangan',
            'email' => 'pengelola@mail.com',
            'password' => Hash::make('112233'),
            'role_id' => $pengelola->id,
            'phone_number' => '081234567890',
        ]);

        User::create([
            'name' => 'User Biasa 1',
            'email' => 'user@mail.com',
            'password' => Hash::make('112233'),
            'role_id' => $user->id,
            'phone_number' => '081234567890',
        ]);

        User::create([
            'name' => 'User Biasa 2',
            'email' => 'user2@mail.com',
            'password' => Hash::make('112233'),
            'role_id' => $user->id,
            'phone_number' => '081234567891',
        ]);
    }
}
