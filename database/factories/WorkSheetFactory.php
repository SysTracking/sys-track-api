<?php

namespace Database\Factories;

use App\Models\WorkSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkSheet>
 */
class WorkSheetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkSheet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'work_day_id' => function () {
                return \App\Models\WorkDay::factory()->create()->id;
            },
            'arrived_at' => $this->faker->time(),
            'leave_at' => $this->faker->time(),
        ];
    }
}
