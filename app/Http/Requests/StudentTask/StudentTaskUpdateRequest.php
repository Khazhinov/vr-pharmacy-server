<?php

declare(strict_types=1);

namespace App\Http\Requests\StudentTask;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class StudentTaskUpdateRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'student_quest_id' => [
                'sometimes',
                'string',
                'exists:student_quests,id',
            ],
            'task_id' => [
                'sometimes',
                'string',
                'exists:tasks,id',
            ],
            'quest_id' => [
                'sometimes',
                'string',
                'exists:quests,id',
            ],
            'group_id' => [
                'sometimes',
                'string',
                'exists:groups,id',
            ],
            'student_id' => [
                'sometimes',
                'string',
                'exists:students,id',
            ],
            'answer' => [
                'sometimes',
                'boolean',
            ],
        ];
    }
}


