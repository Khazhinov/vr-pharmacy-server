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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Уникальный идентификатор студента');

            $table->uuid('group_id')->index()->comment('Идентификатор группы');
            $table->string('full_name')->index()->comment('ФИО студента');

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
        Schema::dropIfExists('students');
    }
};
