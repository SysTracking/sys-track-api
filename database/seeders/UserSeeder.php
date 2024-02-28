<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'jdoe@example.com',
            'password' => bcrypt('password'),
            'position' => 'Directeur technique',
            'status' => 'A3',
            'daily_hours' => 7,
        ]);

        User::create([
            'first_name' => 'Jean',
            'last_name' => 'Dupont',
            'email' => 'jdupont@example.com',
            'password' => bcrypt('password'),
            'position' => 'Comptable',
            'status' => 'A2',
            'daily_hours' => 7,
        ]);

        User::create([
            'first_name' => 'Gita',
            'last_name' => 'Ramesh',
            'email' => 'gramesh@example.com',
            'password' => bcrypt('password'),
            'position' => 'Alternant',
            'status' => 'A1',
            'daily_hours' => 7,
        ]);
    }
}
