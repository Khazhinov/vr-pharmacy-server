<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\Relationship;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\RelationshipTypeEnum;
use Khazhinov\LaravelLighty\Models\Model;
use Khazhinov\LaravelLighty\Models\UUID\Uuidable;
use Khazhinov\LaravelLighty\Models\UUID\UuidableContract;

/**
 * App\Models\Student
 *
 * @property string $id Уникальный идентификатор студента
 * @property string $group_id Идентификатор группы
 * @property string $full_name ФИО студента
 * @property \Illuminate\Support\Carbon $created_at Временная метка создания записи
 * @property \Illuminate\Support\Carbon|null $updated_at Временная метка изменения записи
 * @property \Illuminate\Support\Carbon|null $deleted_at Временная метка удаления записи
 * @property-read \App\Models\Group|null $group
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StudentQuest[] $studentQuests
 * @property-read int|null $student_quests_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StudentTask[] $studentTasks
 * @property-read int|null $student_tasks_count
 * @method static \Database\Factories\StudentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Query\Builder|Student onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Student withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Student withoutTrashed()
 * @mixin \Eloquent
 */
final class Student extends Model implements UuidableContract
{
    use Uuidable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'group_id',
        'full_name',
    ];

    #[
        Relationship(
            related: Group::class,
            type: RelationshipTypeEnum::BelongsTo,
        )
    ]
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    #[
        Relationship(
            related: StudentQuest::class,
            type: RelationshipTypeEnum::HasMany,
            aliases: [
                'student_quests',
            ]
        )
    ]
    public function studentQuests(): HasMany
    {
        return $this->hasMany(StudentQuest::class);
    }

    #[
        Relationship(
            related: StudentTask::class,
            type: RelationshipTypeEnum::HasMany,
            aliases: [
                'student_tasks',
            ]
        )
    ]
    public function studentTasks(): HasMany
    {
        return $this->hasMany(StudentTask::class);
    }
}
