<?php

namespace Database\Factories;

use App\Models\Quest;
use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * @var Task
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'name' => fake()->realText(15),
            'quest_id' => Quest::query()->inRandomOrder()->first()->id,
        ];
    }
}
