<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('student_tasks', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Уникальный идентификатор результата');

            $table->uuid('student_quest_id')->index()->comment('Идентификатор сеанса');
            $table->uuid('task_id')->index()->comment('Идентификатор задачи');
            $table->uuid('quest_id')->index()->comment('Идентификатор кейса');
            $table->uuid('group_id')->index()->comment('Идентификатор группы');
            $table->uuid('student_id')->index()->comment('Идентификатор студента');

            $table->boolean('answer')->comment('Флаг правильности выполнения задачи');

            $table->timestamp('created_at')->index()->comment('Временная метка создания записи');
            $table->timestamp('updated_at')->nullable()->index()->comment('Временная метка изменения записи');
            $table->timestamp('deleted_at')->nullable()->index()->comment('Временная метка удаления записи');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('student_tasks');
    }
};
