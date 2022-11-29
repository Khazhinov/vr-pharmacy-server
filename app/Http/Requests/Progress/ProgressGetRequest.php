<?php

declare(strict_types = 1);

namespace App\Http\Requests\Progress;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class ProgressGetRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'group_id' => [
                'required',
                'string',
                'exists:groups,id',
            ],
            'quest_id' => [
                'required',
                'string',
                'exists:quests,id',
            ],
        ];
    }
}
