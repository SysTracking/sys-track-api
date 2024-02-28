<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\WorkDay;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkDay::all()->each(function ($workDay) {
            Comment::factory()->create(['work_day_id' => $workDay->id]);
        });
    }
}
