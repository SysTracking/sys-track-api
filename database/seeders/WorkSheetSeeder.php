<?php

namespace Database\Seeders;

use App\Models\WorkDay;
use App\Models\WorkSheet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkDay::all()->each(function ($workDay) {
            WorkSheet::factory(rand(1, 3))->create(['work_day_id' => $workDay->id]);
        });
    }
}
