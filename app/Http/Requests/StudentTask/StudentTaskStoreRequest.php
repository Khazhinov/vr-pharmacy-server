<?php

declare(strict_types=1);

namespace App\Http\Requests\StudentTask;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class StudentTaskStoreRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'student_quest_id' => [
                'required',
                'string',
                'exists:student_quests,id',
            ],
            'task_id' => [
                'required',
                'string',
                'exists:tasks,id',
            ],
            'quest_id' => [
                'required',
                'string',
                'exists:quests,id',
            ],
            'group_id' => [
                'required',
                'string',
                'exists:groups,id',
            ],
            'student_id' => [
                'required',
                'string',
                'exists:students,id',
            ],
            'answer' => [
                'required',
                'boolean',
            ],
        ];
    }
}


