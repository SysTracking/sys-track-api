<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WorkDay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            WorkDay::factory()->create(['user_id' => $user->id]);
        });
    }
}
