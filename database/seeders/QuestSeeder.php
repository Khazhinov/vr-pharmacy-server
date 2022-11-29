<?php

namespace Database\Seeders;

use App\Models\Quest;
use Exception;
use Illuminate\Database\Seeder;

class QuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        Quest::factory()->count(4)->create();
    }
}
