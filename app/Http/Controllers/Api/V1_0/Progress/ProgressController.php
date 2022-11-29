<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\V1_0\Progress;

use App\Http\Requests\Progress\ProgressGetRequest;
use App\Models\Group;
use App\Models\Quest;
use App\Models\StudentQuest;
use App\Models\StudentTask;
use App\OpenApi\Complexes\Progress\ProgressGetActionComplex;
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
        foreach ($group->students()->orderBy('full_name', 'ASC')->get() as $student) {
            /** @var StudentQuest $student_last_quest_session */
            $student_last_quest_session = $student->studentQuests()
                ->where([
                    'quest_id' => $quest->id,
                ])
                ->orderBy('created_at', 'DESC')
                ->first()
            ;

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
                    'task_name' => $student_task_result->task->name,
                    'answer' => $student_task_result->answer,
                    'answered_at' => $student_task_result->created_at,
                ];
            }

            $result[] = [
                'student_id' => $student->id,
                'student_full_name' => $student->full_name,
                'quest_start_at' => $student_last_quest_session->start_at,
                'quest_end_at' => $student_last_quest_session->end_at,
                'quest_total_tasks_count' => $student_last_quest_session->quest->tasks()->count(),
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
}
