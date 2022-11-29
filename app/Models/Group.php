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
 * App\Models\Group
 *
 * @property string $id Уникальный идентификатор группы
 * @property string $name Название группы
 * @property \Illuminate\Support\Carbon $created_at Временная метка создания записи
 * @property \Illuminate\Support\Carbon|null $updated_at Временная метка изменения записи
 * @property \Illuminate\Support\Carbon|null $deleted_at Временная метка удаления записи
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StudentQuest[] $studentQuests
 * @property-read int|null $student_quests_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @method static \Database\Factories\GroupFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group newQuery()
 * @method static \Illuminate\Database\Query\Builder|Group onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Group withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Group withoutTrashed()
 * @mixin \Eloquent
 */
final class Group extends Model implements UuidableContract
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
        'students',
    ];

    #[
        Relationship(
            related: Student::class,
            type: RelationshipTypeEnum::HasMany,
        )
    ]
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
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
}
