<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Khazhinov\LaravelLighty\Services\SystemUserPayloadService;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        Task::factory()->count(20)->create();
    }
}
