<?php

namespace Database\Seeders;

use App\Models\Quest;
use App\Models\Task;
use Exception;
use Illuminate\Database\Seeder;
use Khazhinov\LaravelLighty\Transaction\WithDBTransaction;
use Khazhinov\LaravelLighty\Transaction\WithDBTransactionInterface;
use Throwable;

class QuestSeeder extends Seeder implements WithDBTransactionInterface
{
    use WithDBTransaction;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     * @throws Throwable
     */
    public function run(): void
    {
        $this->beginTransaction();

        try {
            $base_quests_data_path = database_path('/seeders/Quests');
            foreach (scandir($base_quests_data_path) as $file_name) {
                if ($file_name === '.' || $file_name === '..') {
                    continue;
                }

                $full_file_path = $base_quests_data_path . DIRECTORY_SEPARATOR . $file_name;
                $exploded_file_name = explode('.', $file_name);
                $quest_service_id = $exploded_file_name[0];
                $quest_name = match ($quest_service_id) {
                    'DrugsPlacement' => 'Размещение лекарственных препаратов и товаров аптечного ассортимента при приеме товара в аптеке',
                    'QuizConsumersCorner' => 'Знакомство с должностью заведующего аптекой и оформление уголка потребителя',
                    'QuizOfficialDuties' => 'Знакомство с должностными обязанностями сотрудников аптеки',
                    'SanitaryRegime' => 'Санитарный режим в аптечном учреждении',
                };
                if (file_exists($full_file_path)) {
                    $quest_data = file_get_contents($full_file_path);
                    $quest_data = iconv("UTF-16LE", "UTF-8", $quest_data);
                    $quest_data = str_replace("\n", "", $quest_data);
                    $quest_data = str_replace("\t", "", $quest_data);
                    $quest_data = str_replace("\r", "", $quest_data);
                    $quest_data = trim($quest_data);
                    $quest_data = substr($quest_data, 3, strlen($quest_data));
                    $quest_data = json_decode($quest_data, true, 512, JSON_THROW_ON_ERROR);

                    $quest = Quest::create([
                        'name' => $quest_name,
                        'service_id' => $quest_service_id,
                    ]);

                    foreach ($quest_data as $task) {
                        $task_name = null;
                        if (array_key_exists('DrugName', $task)) {
                            $task_name = $this->getTaskName($task['DrugName']);
                        } elseif (array_key_exists('Question', $task)) {
                            $task_name = $this->getTaskName($task['Question']);
                        } elseif (array_key_exists('ActionName', $task)) {
                            $task_name = $this->getTaskName($task['ActionName']);
                        } else {
                            continue;
                        }

                        Task::create([
                            'quest_id' => $quest->id,
                            'name' => $task_name,
                            'service_id' => $task['Name'],
                        ]);
                    }
                }
            }

            $this->commit();
        } catch (Throwable $exception) {
            $this->rollback();

            dd($exception);
        }
    }

    protected function getTaskName(string $data): string
    {
        preg_match('/\"(\[.{32}\])\"\, \"(.{32})\"\, \"(.*)\"/', $data, $result);

        return $result[3];
    }
}
