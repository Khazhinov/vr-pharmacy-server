<?php

namespace App\OpenApi\Complexes\Progress;

use App\OpenApi\Complexes\Auth\LoginAction\LoginActionArgumentsDTO;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use JsonException;
use Khazhinov\LaravelFlyDocs\Generator\Factories\ComplexFactory;
use Khazhinov\LaravelFlyDocs\Generator\Factories\ComplexFactoryResult;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Reflector\ModelReflector;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Reflector\RequestReflector;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Responses\ErrorResponse;
use Khazhinov\LaravelLighty\OpenApi\Complexes\Responses\SuccessResponse;
use ReflectionException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ProgressGetActionComplex extends ComplexFactory
{
    /**
     * @param  mixed  ...$arguments
     * @return ComplexFactoryResult
     */
    public function build(...$arguments): ComplexFactoryResult
    {
        $complex_result = new ComplexFactoryResult();

        $complex_result->parameters[] = Parameter::query()
            ->name('group_id')
            ->description('Идентификатор группы')
            ->required(true)
            ->schema(Schema::string())
        ;

        $complex_result->parameters[] = Parameter::query()
            ->name('quest_id')
            ->description('Идентификатор кейса')
            ->required(true)
            ->schema(Schema::string())
        ;

        $complex_result->responses = [
            SuccessResponse::build(
                data: Schema::object('')
                    ->properties(
                        Schema::string('student_id')->description('Идентификатор студента'),
                        Schema::string('student_full_name')->description('ФИО студента'),
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
                    ->description('Объект результата студента в контексте кейса'),
                data_type: 'array'
            ),
            ErrorResponse::build(),
        ];

        return $complex_result;
    }
}
