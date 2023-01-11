<?php

declare(strict_types = 1);

namespace App\Http\Requests\Quest;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class QuestUpdateRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'service_id' => [
                'sometimes',
                'string',
                'max:255',
            ],
        ];
    }
}
