<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1_0\Quest;

use App\Http\Requests\Quest\QuestStoreRequest;
use App\Http\Requests\Quest\QuestUpdateRequest;
use App\Http\Resources\Quest\QuestCollection;
use App\Http\Resources\Quest\QuestResource;
use App\Models\Quest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as DatabaseBuilder;
use JsonException;
use Khazhinov\LaravelFlyDocs\Generator\Attributes as OpenApi;
use Khazhinov\LaravelLighty\Http\Controllers\Api\CRUD\ApiCRUDController;
use Khazhinov\LaravelLighty\Http\Controllers\Api\CRUD\DTO\ActionClosureModeEnum;
use Khazhinov\LaravelLighty\Http\Controllers\Api\CRUD\DTO\ApiCRUDControllerMetaDTO;
use Khazhinov\LaravelLighty\Http\Requests\CRUD\BulkDestroyRequest;
use Khazhinov\LaravelLighty\Http\Requests\CRUD\IndexRequest;
use Khazhinov\LaravelLighty\Http\Requests\CRUD\SetPositionRequest;
use Khazhinov\LaravelLighty\OpenApi\Complexes\BulkDestroyActionComplex;
use Khazhinov\LaravelLighty\OpenApi\Complexes\DestroyActionComplex;
use Khazhinov\LaravelLighty\OpenApi\Complexes\IndexActionComplex;
use Khazhinov\LaravelLighty\OpenApi\Complexes\SetPositionActionComplex;
use Khazhinov\LaravelLighty\OpenApi\Complexes\ShowActionComplex;
use Khazhinov\LaravelLighty\OpenApi\Complexes\StoreActionComplex;
use Khazhinov\LaravelLighty\OpenApi\Complexes\UpdateActionComplex;
use Khazhinov\LaravelLighty\Transaction\WithDBTransaction;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

#[OpenApi\PathItem]
final class QuestCRUDController extends ApiCRUDController
{
    use WithDBTransaction;

    /**
     * @throws UnknownProperties
     * @throws ReflectionException
     */
    public function __construct()
    {
        parent::__construct(new ApiCRUDControllerMetaDTO([
            'model_class' => Quest::class,
            'single_resource_class' => QuestResource::class,
            'collection_resource_class' => QuestCollection::class,
        ]));
    }

    /**
     * Поиск сущностей
     *
     * @param  IndexRequest  $request
     * @return BinaryFileResponse|Response
     * @throws ReflectionException
     * @throws UnknownProperties
     * @throws JsonException
     */
    #[OpenApi\Operation(tags: ['Quest'])]
    #[OpenApi\Complex(
        factory: IndexActionComplex::class,
        model_class: Quest::class,
        collection_resource: QuestCollection::class,
        options: []
    )]
    public function index(IndexRequest $request): mixed
    {
        return $this->indexAction(
            request: $request,
            options: []
        );
    }

    /**
     * Позиционирование сущностей
     *
     * @param  SetPositionRequest  $request
     * @return Response
     * @throws UnknownProperties
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Throwable
     */
    #[OpenApi\Operation(tags: ['Quest'])]
    #[OpenApi\Complex(
        factory: SetPositionActionComplex::class,
        model_class: Quest::class,
        options: []
    )]
    public function setPosition(SetPositionRequest $request): Response
    {
        return $this->setPositionAction(
            request: $request,
            options: []
        );
    }

    /**
     * Массовое удаление сущностей
     *
     * @param  BulkDestroyRequest  $request
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws Throwable
     * @throws UnknownProperties
     */
    #[OpenApi\Operation(tags: ['Quest'])]
    #[OpenApi\Complex(
        factory: BulkDestroyActionComplex::class,
        model_class: Quest::class,
        options: []
    )]
    public function bulkDestroy(BulkDestroyRequest $request): Response
    {
        return $this->bulkDestroyAction(
            request: $request,
            options: [],
            closure: static function (mixed $model_class, ActionClosureModeEnum $mode) {
                if ($mode === ActionClosureModeEnum::AfterDeleting) {
                    // do something...
                }
            }
        );
    }

    /**
     * Получение сущности по идентификатору
     *
     * @param  string $key Идентификатор сущности
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws UnknownProperties
     */
    #[OpenApi\Operation(tags: ['Quest'])]
    #[OpenApi\Complex(
        factory: ShowActionComplex::class,
        model_class: Quest::class,
        single_resource: QuestResource::class,
        options: []
    )]
    public function show(string $key): Response
    {
        return $this->showAction(
            key: $key,
            options: []
        );
    }

    /**
     * Создание сущности
     *
     * @param  QuestStoreRequest  $request
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws Throwable
     * @throws UnknownProperties
     */
    #[OpenApi\Operation(tags: ['Quest'])]
    #[OpenApi\Complex(
        factory: StoreActionComplex::class,
        model_class: Quest::class,
        single_resource: QuestResource::class,
        validation_request: QuestStoreRequest::class,
        options: []
    )]
    public function store(QuestStoreRequest $request): Response
    {
        return $this->storeAction(
            request: $request,
            options: [],
            closure: static function (mixed $model_class, ActionClosureModeEnum $mode) {
                if ($mode === ActionClosureModeEnum::BeforeFilling) {
                    // do something...
                }
            }
        );
    }

    /**
     * Изменение сущности по идентификатору
     *
     * @param  QuestUpdateRequest  $request
     * @param  string $key Идентификатор сущности
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws Throwable
     * @throws UnknownProperties
     */
    #[OpenApi\Operation(tags: ['Quest'])]
    #[OpenApi\Complex(
        factory: UpdateActionComplex::class,
        model_class: Quest::class,
        single_resource: QuestResource::class,
        validation_request: QuestUpdateRequest::class,
        options: []
    )]
    public function update(QuestUpdateRequest $request, string $key): Response
    {
        return $this->updateAction(
            request: $request,
            key: $key,
            options: [],
            closure: static function (mixed $model_class, ActionClosureModeEnum $mode) {
                if ($mode === ActionClosureModeEnum::AfterSave) {
                    // do something...
                }
            }
        );
    }

    /**
     * Удаление сущности по идентификатору
     *
     * @param  string  $key Идентификатор сущности
     * @return Response
     * @throws JsonException
     * @throws ReflectionException
     * @throws Throwable
     * @throws UnknownProperties
     */
    #[OpenApi\Operation(tags: ['Quest'])]
    #[OpenApi\Complex(
        factory: DestroyActionComplex::class,
        model_class: Quest::class,
        options: []
    )]
    public function destroy(string $key): Response
    {
        return $this->destroyAction(
            key: $key,
            options: [],
            closure: static function (mixed $model_class, ActionClosureModeEnum $mode) {
                if ($mode === ActionClosureModeEnum::BeforeDeleting) {
                    // do something...
                }
            }
        );
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultOrder(): array
    {
        return [
            '-id',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getQueryBuilder(): Builder|DatabaseBuilder
    {
        /** @var Builder|DatabaseBuilder $builder */
        $builder = Quest::query();

        return $builder;
    }
}
