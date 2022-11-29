<?php

declare(strict_types=1);

namespace App\Http\Requests\StudentQuest;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class StudentQuestStoreRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'quest_id'  => [
                'required',
                'string',
                'exists:quests,id',
            ],
            'group_id'  => [
                'required',
                'string',
                'exists:groups,id',
            ],
            'student_id'  => [
                'required',
                'string',
                'exists:students,id',
            ],
            'start_at'  => [
                'required',
                'string',
                'date_format:Y-m-d H:i:s',
            ],
            'end_at'  => [
                'sometimes',
                'nullable',
                'string',
                'date_format:Y-m-d H:i:s',
            ],
        ];
    }
}


