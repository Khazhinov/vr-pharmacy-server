<?php

declare(strict_types = 1);

namespace App\Http\Requests\Task;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class TaskStoreRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'quest_id' => [
                'required',
                'string',
                'exists:quests,id',
            ],
            'service_id' => [
                'required',
                'string',
                'max:255',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
