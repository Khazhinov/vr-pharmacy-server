<?php

namespace Database\Seeders;

use App\Models\Task;
use Exception;
use Illuminate\Database\Seeder;

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
