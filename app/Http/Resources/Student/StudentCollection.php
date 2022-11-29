<?php

namespace App\Http\Resources\Student;

use App\Models\Student;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Khazhinov\LaravelLighty\Http\Resources\CollectionResource;

/**
 * @property  Student[] $collection
 */
class StudentCollection extends CollectionResource
{
    /**
     * @param $request
     * @return array <mixed>|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'data' => $this->collection,
        ];
    }
}
