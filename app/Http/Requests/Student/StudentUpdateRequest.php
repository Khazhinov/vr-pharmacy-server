<?php

declare(strict_types=1);

namespace App\Http\Requests\Student;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class StudentUpdateRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'group_id' => [
                'sometimes',
                'string',
                'exists:groups,id',
            ],
            'full_name' => [
                'sometimes',
                'string',
                'max:255',
            ],
        ];
    }
}


