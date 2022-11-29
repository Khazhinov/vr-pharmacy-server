<?php

namespace App\Http\Resources\StudentTask;

use App\Http\Resources\Group\GroupResource;
use App\Http\Resources\Quest\QuestResource;
use App\Http\Resources\Student\StudentResource;
use App\Http\Resources\StudentQuest\StudentQuestResource;
use App\Http\Resources\Task\TaskResource;
use App\Models\StudentTask;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;
use Khazhinov\LaravelLighty\Http\Resources\SingleResource;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @property  StudentTask $resource
 */
class StudentTaskResource extends SingleResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<int|string, mixed>|Arrayable|JsonSerializable
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->resource->id,
            'student_quest_id' => $this->resource->student_quest_id,
            'task_id' => $this->resource->task_id,
            'quest_id' => $this->resource->quest_id,
            'group_id' => $this->resource->group_id,
            'student_id' => $this->resource->student_id,
            'answer' => $this->resource->answer,

            // Для отношений, позволяет избегать проблемы N+1
            $this->mergeWhenByClosure($this->hasWith('relationships.student_quest'), static function ($context) {
                return [
                     'student_quest' => new StudentQuestResource($context->studentQuest),
                ];
            }),
            $this->mergeWhenByClosure($this->hasWith('relationships.task'), static function ($context) {
                return [
                    'task' => new TaskResource($context->task),
                ];
            }),
            $this->mergeWhenByClosure($this->hasWith('relationships.quest'), static function ($context) {
                return [
                    'quest' => new QuestResource($context->quest),
                ];
            }),
            $this->mergeWhenByClosure($this->hasWith('relationships.group'), static function ($context) {
                return [
                    'group' => new GroupResource($context->group),
                ];
            }),
            $this->mergeWhenByClosure($this->hasWith('relationships.student'), static function ($context) {
                return [
                    'student' => new StudentResource($context->student),
                ];
            }),

            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'deleted_at' => $this->resource->deleted_at,
        ];
    }
}
