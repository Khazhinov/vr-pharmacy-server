<?php

declare(strict_types = 1);

namespace App\Http\Requests\Task;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class TaskUpdateRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'quest_id' => [
                'sometimes',
                'string',
                'exists:quests,id',
            ],
            'name' => [
                'sometimes',
                'string',
                'max:255',
            ],
        ];
    }
}
