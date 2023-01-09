<?php

declare(strict_types = 1);

namespace App\Http\Requests\Progress;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class ProgressGetByStudentRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'student_id' => [
                'required',
                'string',
                'exists:students,id',
            ],
        ];
    }
}
