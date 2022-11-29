<?php

namespace Database\Seeders;

use App\Models\Quest;
use App\Models\Student;
use App\Models\StudentQuest;
use App\Models\StudentTask;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        /** @var Quest[] $quests */
        $quests = Quest::all();
        Student::query()->chunk(10, function (Collection $students) use ($quests) {
            /** @var Student[] $students */
            foreach ($students as $student) {
                foreach ($quests as $quest) {
                    /** @var StudentQuest $session */
                    $session = StudentQuest::create([
                        'quest_id' => $quest->id,
                        'group_id' => $student->group_id,
                        'student_id' => $student->id,
                        'start_at' => now()->subHour(),
                        'end_at' => now(),
                    ]);

                    foreach ($quest->tasks as $task) {
                        $task_result = StudentTask::create([
                            'student_quest_id' => $session->id,
                            'task_id' => $task->id,
                            'quest_id' => $quest->id,
                            'group_id' => $student->group_id,
                            'student_id' => $student->id,
                            'answer' => $this->getAnswer(),
                        ]);
                    }
                }
            }
        });
    }

    protected function getAnswer(): bool
    {
        return fake()->randomElement([
            true,
            false,
        ]);
    }
}
