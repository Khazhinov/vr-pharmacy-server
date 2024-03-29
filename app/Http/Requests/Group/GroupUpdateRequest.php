<?php

declare(strict_types = 1);

namespace App\Http\Requests\Group;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class GroupUpdateRequest extends BaseRequest
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
            'email' => [
                'sometimes',
                'string',
                'max:255',
                'email',
            ],
        ];
    }
}
