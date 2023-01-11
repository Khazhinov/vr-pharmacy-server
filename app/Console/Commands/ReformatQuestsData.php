<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReformatQuestsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:quests-reformat-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Генерирует UUID для квестов';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \JsonException
     */
    public function handle()
    {
    }
}
