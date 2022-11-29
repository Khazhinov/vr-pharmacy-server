<?php

declare(strict_types = 1);

namespace App\Http\Requests\Student;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class StudentStoreRequest extends BaseRequest
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
            'full_name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
