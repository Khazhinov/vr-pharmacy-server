<?php

namespace App\Http\Resources\Quest;

use App\Models\Quest;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Khazhinov\LaravelLighty\Http\Resources\CollectionResource;

/**
 * @property  Quest[] $collection
 */
class QuestCollection extends CollectionResource
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
