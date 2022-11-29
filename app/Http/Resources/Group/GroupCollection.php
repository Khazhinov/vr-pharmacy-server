<?php

namespace App\Http\Resources\Group;

use App\Models\Group;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Khazhinov\LaravelLighty\Http\Resources\CollectionResource;

/**
 * @property  Group[] $collection
 */
class GroupCollection extends CollectionResource
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
