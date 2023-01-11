<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DefaultUsersSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(QuestSeeder::class);
//        $this->call(TaskSeeder::class);
        $this->call(ProgressSeeder::class);
    }
}
