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
                'email' => '0119@msmsu.ru',
            ],
            [
                'name' => 'КВБО-02-19',
                'email' => '0219@msmsu.ru',
            ],
            [
                'name' => 'КВБО-03-19',
                'email' => '0319@msmsu.ru',
            ],
            [
                'name' => 'КВБО-04-19',
                'email' => '0419@msmsu.ru',
            ],
            [
                'name' => 'КВБО-01-20',
                'email' => '0120@msmsu.ru',
            ],
            [
                'name' => 'КВБО-02-20',
                'email' => '0220@msmsu.ru',
            ],
            [
                'name' => 'КВБО-03-20',
                'email' => '0320@msmsu.ru',
            ],
            [
                'name' => 'КВБО-04-20',
                'email' => '0420@msmsu.ru',
            ],
            [
                'name' => 'КВБО-01-21',
                'email' => '0121@msmsu.ru',
            ],
            [
                'name' => 'КВБО-02-21',
                'email' => '0221@msmsu.ru',
            ],
            [
                'name' => 'КВБО-03-21',
                'email' => '0321@msmsu.ru',
            ],
            [
                'name' => 'КВБО-04-21',
                'email' => '0421@msmsu.ru',
            ],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
