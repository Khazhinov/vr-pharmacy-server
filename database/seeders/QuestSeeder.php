<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Quest;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Khazhinov\LaravelLighty\Services\SystemUserPayloadService;

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
