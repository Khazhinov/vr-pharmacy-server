<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Api\V1_0\Progress;

use App\Http\Requests\Progress\ProgressGetByStudentRequest;
use App\Http\Requests\Progress\ProgressGetRequest;
use App\Models\Group;
use App\Models\Quest;
use App\Models\Student;
use App\Models\StudentQuest;
use App\Models\StudentTask;
use App\OpenApi\Complexes\Progress\ProgressGetActionComplex;
use App\OpenApi\Complexes\Progress\ProgressGetByStudentActionComplex;
use JsonException;
use Khazhinov\LaravelFlyDocs\Generator\Attributes as OpenApi;
use Khazhinov\LaravelLighty\Http\Controllers\Api\ApiController;
use ReflectionException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\HttpFoundation\Response;

#[OpenApi\PathItem]
class ProgressController extends ApiController
{
    /**
     * Получение последнего прогресса студентов по номеру группы и кейса.
     *
     * @throws ReflectionException
     * @throws UnknownProperties
     * @throws JsonException
     */
    #[OpenApi\Operation(tags: ['Progress'])]
    #[OpenApi\Complex(
        factory: ProgressGetActionComplex::class,
    )]
    public function get(ProgressGetRequest $request): Response
    {
        /** @var Group $group */
        $group = Group::find($request->get('group_id'));
        /** @var Quest $quest */
        $quest = Quest::find($request->get('quest_id'));

        $result = [];
        /** @phpstan-ignore-next-line */
        foreach ($group->students()->orderBy('full_name', 'ASC')->get() as $student) {
            /** @var StudentQuest $student_last_quest_session */
            $student_last_quest_session = $student->studentQuests()
                ->where([
                    'quest_id' => $quest->id,
                ])
                ->orderBy('created_at', 'DESC')
                ->first()
            ;

            if (! $student_last_quest_session) {
                $result[] = [
                    'student_id' => $student->id,
                    'student_full_name' => $student->full_name,
                    'quest_start_at' => null,
                    'quest_end_at' => null,
                    'quest_total_tasks_count' => 0, /** @phpstan-ignore-line */
                    'quest_true_answer_count' => 0,
                    'quest_false_answer_count' => 0,
                    'tasks' => [],
                ];

                continue;
            }

            $student_last_quest_session_tasks_detail = [];
            $true_count = 0;
            $false_count = 0;

            /** @var StudentTask $student_task_result */
            foreach ($student_last_quest_session->studentTasks as $student_task_result) {
                if ($student_task_result->answer) {
                    $true_count++;
                } else {
                    $false_count++;
                }
                $student_last_quest_session_tasks_detail[] = [
                    'task_id' => $student_task_result->task_id,
                    'task_name' => $student_task_result->task->name, /** @phpstan-ignore-line */
                    'answer' => $student_task_result->answer,
                    'answered_at' => $student_task_result->created_at,
                ];
            }

            $result[] = [
                'student_id' => $student->id,
                'student_full_name' => $student->full_name,
                'quest_start_at' => $student_last_quest_session->start_at,
                'quest_end_at' => $student_last_quest_session->end_at,
                'quest_total_tasks_count' => $student_last_quest_session->studentTasks()->count(), /** @phpstan-ignore-line */
                'quest_true_answer_count' => $true_count,
                'quest_false_answer_count' => $false_count,
                'tasks' => $student_last_quest_session_tasks_detail,
            ];
        }

        return $this->respond(
            $this->buildActionResponseDTO(
                data: $result,
            )
        );
    }

    /**
     * Получение прогресса по всем кейсам студента по идентификатору студента.
     *
     * @param  ProgressGetByStudentRequest  $request
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws UnknownProperties
     */
    #[OpenApi\Operation(tags: ['Progress'])]
    #[OpenApi\Complex(
        factory: ProgressGetByStudentActionComplex::class,
    )]
    public function getByStudent(ProgressGetByStudentRequest $request): Response
    {
        /** @var Student $quest */
        $student = Student::find($request->get('student_id'));

        // TODO возможное узкое горло
        $student_quest_sessions = $student->studentQuests()
            ->orderBy('created_at', 'DESC')
            ->get()
        ;

        $quest_results = [];
        /** @var StudentQuest $student_quest_session */
        foreach ($student_quest_sessions as $student_quest_session) {
            $student_last_quest_session_tasks_detail = []; /** @phpstan-ignore-line */
            $true_count = 0;
            $false_count = 0;

            /** @var StudentTask $student_task_result */
            foreach ($student_quest_session->studentTasks as $student_task_result) {
                if ($student_task_result->answer) {
                    $true_count++;
                } else {
                    $false_count++;
                }
                $student_last_quest_session_tasks_detail[] = [
                    'task_id' => $student_task_result->task_id,
                    'task_name' => $student_task_result->task->name, /** @phpstan-ignore-line */
                    'task_service_id' => $student_task_result->task->service_id, /** @phpstan-ignore-line */
                    'answer' => $student_task_result->answer,
                    'answered_at' => $student_task_result->created_at,
                ];
            }

            $quest_results[] = [
                'student_quest_id' => $student_quest_session->id,
                'quest_id' => $student_quest_session->quest_id,
                'quest_service_id' => $student_quest_session->quest->service_id,
                'quest_start_at' => $student_quest_session->start_at,
                'quest_end_at' => $student_quest_session->end_at,
                'quest_total_tasks_count' => $student_quest_session->studentTasks()->count(),
                'quest_true_answer_count' => $true_count,
                'quest_false_answer_count' => $false_count,
                'tasks' => $student_last_quest_session_tasks_detail,
            ];
        }

        return $this->respond(
            $this->buildActionResponseDTO(
                data: [
                    'student_id' => $student->id,
                    'student_full_name' => $student->full_name,
                    'group_id' => $student->group_id,
                    'student_quests' => $quest_results
                ],
            )
        );
    }
}
