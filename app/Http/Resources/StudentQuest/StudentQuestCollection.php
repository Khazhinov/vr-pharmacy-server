<?php

namespace App\Http\Resources\StudentQuest;

use App\Models\StudentQuest;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Khazhinov\LaravelLighty\Http\Resources\CollectionResource;

/**
 * @property  StudentQuest[] $collection
 */
class StudentQuestCollection extends CollectionResource
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
