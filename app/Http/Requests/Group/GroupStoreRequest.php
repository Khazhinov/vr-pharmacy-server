<?php

declare(strict_types=1);

namespace App\Http\Requests\Group;

use Khazhinov\LaravelLighty\Http\Requests\BaseRequest;

final class GroupStoreRequest extends BaseRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}


