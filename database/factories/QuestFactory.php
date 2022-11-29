<?php

namespace Database\Factories;

use App\Models\Quest;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quest>
 */
class QuestFactory extends Factory
{
    /**
     * @var Quest
     */
    protected $model = Quest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'name' => fake()->streetName(),
        ];
    }
}
