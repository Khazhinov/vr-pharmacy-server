<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\Group\GroupResource;
use App\Http\Resources\StudentQuest\StudentQuestResource;
use App\Models\Student;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use JsonSerializable;
use Khazhinov\LaravelLighty\Http\Resources\SingleResource;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * @property  Student $resource
 */
class StudentResource extends SingleResource
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
            'group_id' => $this->resource->group_id,
            'full_name' => $this->resource->full_name,

            // Для отношений, позволяет избегать проблемы N+1
            $this->mergeWhenByClosure($this->hasWith('relationships.group'), static function ($context) {
                return [
                     'group' => new GroupResource($context->group),
                ];
            }),
            $this->mergeWhenByClosure($this->hasWith('relationships.student_quests'), static function ($context) {
                return [
                    'student_quests' => StudentQuestResource::collection($context->studentQuests),
                ];
            }),

            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'deleted_at' => $this->resource->deleted_at,
        ];
    }
}
