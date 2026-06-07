<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BaseContract
{
    public const LIMIT = 9;

    public const ORDER_BY = 'id';

    public const ORDER_DIR = 'desc';

    public function create(array $attributes = []): mixed;

    public function update(Model $model, array $attributes = []): mixed;

    public function updateAll(array $attributes = []): mixed;

    public function createOrUpdate(array $attributes = [], $id = null): mixed;

    public function remove(Model $model): mixed;

    public function canRemove(Model $model);

    public function find(int $id, array $relations = [], array $filters = []): mixed;

    public function findOrFail(int $id, array $relations = [], array $filters = []): mixed;

    public function findBy(string $key, mixed $value): mixed;

    /**
     * @param  mixed  $fields
     */
    public function findByFields(array $fields): mixed;

    public function whereOrCreate(array $wheres, ?array $data = null): mixed;

    public function findAllForFormSelect(
        ?string $labelField = null,
        string $valueField = 'id',
        bool $applyOrder = false,
        string $orderBy = self::ORDER_BY,
        string $orderDir = self::ORDER_DIR,
        array $conditions = []
    ): mixed;

    public function findAll(
        array $fields = [],
        bool $applyOrder = true,
        string $orderBy = self::ORDER_BY,
        string $orderDir = self::ORDER_DIR
    ): mixed;

    public function search(
        array $filters = [],
        array $relations = [],
        array $data = [],
    ): mixed;

    public function getQueryResult($query, array $data): mixed;

    /**
     * Create a Pagination From Items Of  array Or collection.
     */
    public function paginate(array|Collection $items, int $perPage = 15, ?int $page = null, array $options = []): LengthAwarePaginator;

    /**
     * toggle boolean field in model.
     */
    public function toggleField($model, string $field): mixed;
}
