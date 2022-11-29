<?php

namespace Database\Seeders;

use App\Models\Student;
use Exception;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        Student::factory()->count(60)->create();
    }
}
