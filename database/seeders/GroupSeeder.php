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
        $groups = [
            [
                'name' => 'КВБО-01-19',
            ],
            [
                'name' => 'КВБО-02-19',
            ],
            [
                'name' => 'КВБО-03-19',
            ],
            [
                'name' => 'КВБО-04-19',
            ],
            [
                'name' => 'КВБО-01-20',
            ],
            [
                'name' => 'КВБО-02-20',
            ],
            [
                'name' => 'КВБО-03-20',
            ],
            [
                'name' => 'КВБО-04-20',
            ],
            [
                'name' => 'КВБО-01-21',
            ],
            [
                'name' => 'КВБО-02-21',
            ],
            [
                'name' => 'КВБО-03-21',
            ],
            [
                'name' => 'КВБО-04-21',
            ],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
