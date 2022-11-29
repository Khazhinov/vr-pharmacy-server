<?php

namespace Database\Seeders;

use App\Models\Group;
use Exception;
use Illuminate\Database\Seeder;

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
