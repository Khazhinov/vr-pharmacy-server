<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Khazhinov\LaravelLighty\Services\SystemUserPayloadService;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        Group::factory()->count(5)->create();
    }
}
