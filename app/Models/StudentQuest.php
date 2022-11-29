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
 * App\Models\StudentQuest
 *
 * @property string $id Уникальный идентификатор сеанса
 * @property string $quest_id Идентификатор кейса
 * @property string $group_id Идентификатор группы
 * @property string $student_id Идентификатор студента
 * @property \Illuminate\Support\Carbon|null $start_at Временная метка начала кейса
 * @property \Illuminate\Support\Carbon|null $end_at Временная метка окончания кейса
 * @property \Illuminate\Support\Carbon $created_at Временная метка создания записи
 * @property \Illuminate\Support\Carbon|null $updated_at Временная метка изменения записи
 * @property \Illuminate\Support\Carbon|null $deleted_at Временная метка удаления записи
 * @property-read \App\Models\Group|null $group
 * @property-read \App\Models\Quest|null $quest
 * @property-read \App\Models\Student|null $student
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StudentTask[] $studentTasks
 * @property-read int|null $student_tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest newQuery()
 * @method static \Illuminate\Database\Query\Builder|StudentQuest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest whereQuestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentQuest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StudentQuest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StudentQuest withoutTrashed()
 * @mixin \Eloquent
 */
final class StudentQuest extends Model implements UuidableContract
{
    use Uuidable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'quest_id',
        'group_id',
        'student_id',
        'start_at',
        'end_at',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    #[
        Relationship(
            related: Quest::class,
            type: RelationshipTypeEnum::BelongsTo,
        )
    ]
    public function quest(): BelongsTo
    {
        return $this->belongsTo(Quest::class);
    }

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
            related: Student::class,
            type: RelationshipTypeEnum::BelongsTo,
        )
    ]
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
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
