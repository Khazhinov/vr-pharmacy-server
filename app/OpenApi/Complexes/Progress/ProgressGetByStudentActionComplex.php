<?php

namespace App\OpenApi\Complexes\Progress;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Khazhinov\LaravelFlyDocs\Generator\Factories\ComplexFactory;
use Khazhinov\LaravelFlyDocs\Generator\Factories\ComplexFactoryResult;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Responses\ErrorResponse;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Responses\SuccessResponse;

class ProgressGetByStudentActionComplex extends ComplexFactory
{
    /**
     * @param  mixed  ...$arguments
     * @return ComplexFactoryResult
     */
    public function build(...$arguments): ComplexFactoryResult
    {
        $complex_result = new ComplexFactoryResult();

        $complex_result->parameters[] = Parameter::query()
            ->name('student_id')
            ->description('Идентификатор студента')
            ->required(true)
            ->schema(Schema::string())
        ;

        $complex_result->responses = [
            SuccessResponse::build(
                data: [
                    Schema::string('student_id')->description('Идентификатор студента'),
                    Schema::string('group_id')->description('Идентификатор группы студента'),
                    Schema::array('student_quests')->description('Список прохождения кейсов')->items(
                        Schema::object()->properties(
                            Schema::string('student_quest_id')->description('Идентификатор прохождения кейса'),
                            Schema::string('quest_id')->description('Идентификатор кейса'),
                            Schema::string('quest_id')->description('Идентификатор кейса'),
                            Schema::string('quest_start_at')->description('Время начала прохождения кейса'),
                            Schema::string('quest_end_at')->description('Время окончания прохождения кейса'),
                            Schema::integer('quest_total_tasks_count')->description('Общее количество заданий в кейсе'),
                            Schema::integer('quest_true_answer_count')->description('Количество правильно выполненных заданий'),
                            Schema::integer('quest_false_answer_count')->description('Количество неправильно выполненных заданий'),
                            Schema::array('tasks')
                                ->items(
                                    Schema::object()->properties(
                                        Schema::string('task_id')->description('Идентификатор задания'),
                                        Schema::string('task_name')->description('Название задания'),
                                        Schema::boolean('answer')->description('Ответ студента'),
                                        Schema::string('answered_at')->description('Время ответа студента'),
                                    )
                                )
                                ->description('Полный перечень ответов на задание студента'),
                        )
                    ),

                ]
            ),
            ErrorResponse::build(),
        ];

        return $complex_result;
    }
}
