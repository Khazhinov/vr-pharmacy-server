<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Student;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * @var Student
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'group_id' => Group::query()->inRandomOrder()->first()->id,
        ];
    }
}
