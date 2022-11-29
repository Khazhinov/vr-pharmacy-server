<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\Relationship;
use Khazhinov\LaravelLighty\Models\Attributes\Relationships\RelationshipTypeEnum;
use Khazhinov\LaravelLighty\Models\Model;
use Khazhinov\LaravelLighty\Models\UUID\Uuidable;
use Khazhinov\LaravelLighty\Models\UUID\UuidableContract;

/**
 * App\Models\StudentTask
 *
 * @property string $id Уникальный идентификатор результата
 * @property string $student_quest_id Идентификатор сеанса
 * @property string $task_id Идентификатор задачи
 * @property string $quest_id Идентификатор кейса
 * @property string $group_id Идентификатор группы
 * @property string $student_id Идентификатор студента
 * @property bool $answer Флаг правильности выполнения задачи
 * @property \Illuminate\Support\Carbon $created_at Временная метка создания записи
 * @property \Illuminate\Support\Carbon|null $updated_at Временная метка изменения записи
 * @property \Illuminate\Support\Carbon|null $deleted_at Временная метка удаления записи
 * @property-read \App\Models\Group|null $group
 * @property-read \App\Models\Quest|null $quest
 * @property-read \App\Models\Student|null $student
 * @property-read \App\Models\StudentQuest|null $studentQuest
 * @property-read \App\Models\Task|null $task
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask newQuery()
 * @method static \Illuminate\Database\Query\Builder|StudentTask onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask whereQuestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask whereStudentQuestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentTask whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|StudentTask withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StudentTask withoutTrashed()
 * @mixin \Eloquent
 */
final class StudentTask extends Model implements UuidableContract
{
    use Uuidable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'student_quest_id',
        'task_id',
        'quest_id',
        'group_id',
        'student_id',
        'answer',
    ];

    protected $casts = [
        'answer' => 'boolean',
    ];

    #[
        Relationship(
            related: StudentQuest::class,
            type: RelationshipTypeEnum::BelongsTo,
            aliases: [
                'student_quest',
            ]
        )
    ]
    public function studentQuest(): BelongsTo
    {
        return $this->belongsTo(StudentQuest::class);
    }

    #[
        Relationship(
            related: Task::class,
            type: RelationshipTypeEnum::BelongsTo,
        )
    ]
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

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
}
