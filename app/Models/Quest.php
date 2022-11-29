<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\Relationship;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\RelationshipTypeEnum;
use Khazhinov\LaravelLighty\Models\Model;
use Khazhinov\LaravelLighty\Models\UUID\Uuidable;
use Khazhinov\LaravelLighty\Models\UUID\UuidableContract;

/**
 * App\Models\Quest
 *
 * @property string $id Уникальный идентификатор кейса
 * @property string $name Название кейса
 * @property \Illuminate\Support\Carbon $created_at Временная метка создания записи
 * @property \Illuminate\Support\Carbon|null $updated_at Временная метка изменения записи
 * @property \Illuminate\Support\Carbon|null $deleted_at Временная метка удаления записи
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Database\Factories\QuestFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Quest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quest newQuery()
 * @method static \Illuminate\Database\Query\Builder|Quest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Quest query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Quest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Quest withoutTrashed()
 * @mixin \Eloquent
 */
final class Quest extends Model implements UuidableContract
{
    use Uuidable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'tasks',
    ];

    #[
        Relationship(
            related: Task::class,
            type: RelationshipTypeEnum::HasMany,
        )
    ]
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
