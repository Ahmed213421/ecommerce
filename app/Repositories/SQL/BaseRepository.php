<?php

namespace App\Repositories\SQL;

use App\Exceptions\CantDeleteModelException;
use App\Repositories\Contracts\BaseContract;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

abstract class BaseRepository implements BaseContract
{
    protected Model $model;

    protected string $modelName;

    protected Builder $query;

    protected array $defaultFilters = [];

    /**
     * BaseRepository constructor.
     */
    public function __construct(Model $model)
    {
        $this->query = $model->query();
        $this->model = $model;
        $this->modelName = class_basename($this->model);
    }

    public function freshRepo(): static
    {
        $this->query = $this->model->query();

        return $this;
    }

    public function create(array $attributes = []): mixed
    {
        if (! empty($attributes)) {
            // Clean the attributes from unnecessary inputs
            $filtered = $this->cleanUpAttributes($attributes);
            $model = $this->query->create($filtered);
            if (method_exists($this, 'syncRelations')) {
                $this->syncRelations($attributes, $model);
            }

            if (method_exists($this, 'afterCreate')) {
                $this->afterCreate($model, $attributes);
            }

            return $model->refresh();
        }

        return false;
    }

    public function update(Model $model, array $attributes = []): mixed
    {
        if (! empty($attributes)) {
            // Clean the attributes from unnecessary inputs
            $filtered = $this->cleanUpAttributes($attributes);
            $model = tap($model)->update($filtered)->fresh();
            if (method_exists($this, 'syncRelations')) {
                $this->syncRelations($attributes, $model);
            }

            return $model;
        }

        return false;
    }

    public function attach(Model $model, string $relation, array $attributes = []): mixed
    {
        if (! empty($attributes)) {
            return $model->{$relation}()->attach($attributes);
        }

        return false;
    }

    public function detach(Model $model, string $relation, array $attributes = []): mixed
    {
        if (! empty($attributes)) {
            return $model->{$relation}()->detach($attributes);
        }

        return false;
    }

    public function sync(Model $model, string $relation, array $attributes = []): mixed
    {
        if (! empty($attributes)) {
            return $model->{$relation}()->sync($attributes);
        }

        return false;
    }

    public function updateAll(array $attributes = []): mixed
    {
        if (! empty($attributes)) {
            // Clean the attributes from unnecessary inputs
            $filtered = $this->cleanUpAttributes($attributes);

            return $this->query->update($filtered);
        }

        return false;
    }

    public function updateAllByKey($key, ?array $values = null, array $attributes = []): int|bool
    {
        $values ??= [];
        if (! empty($attributes) && ! empty($values)) {
            // Clean the attributes from unnecessary inputs
            $filtered = $this->cleanUpAttributes($attributes);

            return $this->query->whereIn($key, $values)->update($filtered);
        }

        return false;
    }

    /**
     * @param  null  $id
     * @return bool|mixed
     */
    public function createOrUpdate(array $attributes = [], $id = null): mixed
    {
        if (empty($attributes)) {
            return false;
        }
        // Clean the attributes from unnecessary inputs
        $filtered = $this->cleanUpAttributes($attributes);
        if ($id) {
            $model = $this->query->find($id);

            return $this->update($model, $filtered);
        }

        return $this->create($filtered);
    }

    /**
     * @return bool|mixed|null
     *
     * @throws Exception
     */
    public function remove(Model $model): mixed
    {
        // Check if has relations
        foreach ($model->getDefinedRelations() as $relation) {
            if ($model->$relation()->count()) {
                return response()->json([
                    'status' => 400,
                    'error' => __("messages.responses.can_not_delete"),
                    'message' => __("messages.responses.can_not_delete"),
                ], 400);
            }
        }
        $model->delete();
        return response()->json([
            'status' => 200,
            'message' => __("messages.responses.deleted"),
        ], 200);
    }

    public function canRemove(Model $model): bool
    {
        // Check if model has relations
        foreach ($model->getDefinedRelations() as $relation) {
            if ($model->$relation()->count()) {
                return false;
            }
        }

        return true;
    }

    public function has(array $relations = []): static
    {
        foreach ($relations as $relation) {
            $this->query->has($relation);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function doesntHave(array $relations = []): static
    {
        foreach ($relations as $relation) {
            $this->query->has($relation);
        }

        return $this;
    }

    public function havingRaw($sql): static
    {
        $this->query->havingRaw($sql);

        return $this;
    }

    /**
     * @return $this
     */
    public function whereHas(array $relations = []): static
    {
        foreach ($relations as $relationName => $filters) {
            if (! method_exists($this->model, $relationName)) {
                return $this;
            }
            $this->query->whereHas($relationName, function ($query) use ($filters, $relationName) {
                if (! empty($filters)) {
                    $relatedModel = $this->getRelatedModel($relationName);
                    if (! $relatedModel) {
                        return $this;
                    }
                    foreach ($relatedModel->getFilters() as $filter) {
                        //                        info($filter);
                        if (isset($filters[$filter])) {
                            $withFilter = 'of'.ucfirst($filter);
                            $query->$withFilter($filters[$filter]);
                        }
                    }
                }
            });
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withSum(array $columns = []): static
    {
        foreach ($columns as $column) {
            $split = explode('.', $column);
            if (count($split) == 2) {
                $this->query->withSum($split[0], $split[1]);
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withCount(array $relations = []): static
    {
        foreach ($relations as $relation) {
            $this->query->withCount($relation);
        }

        return $this;
    }

    public function count(): int
    {
        return $this->query->count();
    }

    public function countWithFilters($filters): int
    {
        $query = $this->query;
        foreach ($this->model->getFilters() as $filter) {
            if (isset($filters[$filter])) {
                $withFilter = 'of'.ucfirst($filter);
                $query = $query->$withFilter($filters[$filter]);
            }
        }

        return $query->count();
    }

    public function withFilters($query, array $filters = []): Builder
    {
        if (count($filters)) {
            foreach ($this->model->getFilters() as $filter) {
                if (isset($filters[$filter])) {
                    $withFilter = 'of'.ucfirst($filter);
                    $query = $query->$withFilter($filters[$filter]);
                }
            }
        }

        return $query;
    }

    public function first(): ?object
    {
        return $this->query->first();
    }

    public function exists(): bool
    {
        return $this->query->exists();
    }

    public function doesntExist(): bool
    {
        return $this->query->doesntExist();
    }

    public function increment(Model $model, $column, $value): void
    {
        $model->increment($column, $value);
    }

    public function decrement(Model $model, $column, $value): void
    {
        $model->decrement($column, $value);
    }

    public function sum($column): mixed
    {
        return $this->aggregate('sum', $column);
    }

    public function aggregate($function, $column): mixed
    {
        return $this->query->{$function}($column);
    }

    public function findIds($ids): mixed
    {
        return $this->query->findOrFail($ids);
    }

    public function find(int $id, array $relations = [], array $filters = []): mixed
    {
        $query = $this->query;
        $query = $this->applyRelations($query, $relations);

        return $this->withFilters($query, $filters)->find($id);
    }

    public function getByKey($column, $data): mixed
    {
        return $this->query->whereIn($column, (array) $data)->get();
    }

    public function findOrFail(int $id, array $relations = [], array $filters = []): mixed
    {
        $query = $this->query;
        $query = $this->applyRelations($query, $relations);

        return $this->withFilters($query, $filters)->findOrFail($id);
    }

    public function findBy(string $key, mixed $value, bool $fail = true): mixed
    {
        $model = $this->query->where($key, $value);
        if ($fail) {
            return $model->firstOrFail();
        }

        return $model->first();
    }

    /**
     * @param  mixed  $fields
     */
    public function findByFields(array $fields): mixed
    {
        $query = $this->query;
        if (isset($fields['and'])) {
            $query = $query->where($fields['and']);
        }
        if (isset($fields['or'])) {
            $query = $query->orWhere(function (Builder $query) use ($fields) {
                foreach ($fields['or'] as $condition) {
                    $query = $query->orWhere($condition[0], $condition[1]);
                }
            });
        }

        return $query->first();
    }

    public function whereOrCreate(array $wheres, ?array $data = null): mixed
    {
        return $this->query->firstOrCreate($data ?? $wheres, $wheres);
    }

    public function applyConditions($query, $conditions)
    {
        if (! empty($conditions)) {
            foreach ($conditions as $conditionType => $whereConditions) {
                if ($conditionType == 'where' && ! empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->where($field, $value);
                    }
                }

                if ($conditionType == 'whereNot' && ! empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->where($field, '!=', $value);
                    }
                }

                if ($conditionType == 'whereDateLess' && ! empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereDate($field, '<=', Carbon::parse($value));
                    }
                }
                if ($conditionType == 'whereDateMore' && ! empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereDate($field, '>=', Carbon::parse($value));
                    }
                }

                if ($conditionType == 'whereIn' && ! empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereIn($field, $value);
                    }
                }

                if ($conditionType == 'whereNotIn' && ! empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereNotIn($field, $value);
                    }
                }

                if ($conditionType == 'whereLike' && ! empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->where($field, 'like', '%'.$value.'%');
                    }
                }

                if ($conditionType == 'whereBetween' && ! empty($whereConditions)) {
                    foreach ($whereConditions as $field => $value) {
                        $query = $query->whereBetween($field, $value);
                    }
                }
            }
        }

        return $query;
    }

    public function applyRelations($query, $relations)
    {
        if (! empty($relations)) {
            $query = $query->with($relations);
        }

        return $query;
    }

    public function findAllForFormSelect(
        ?string $labelField = null,
        string $valueField = 'id',
        bool $applyOrder = false,
        string $orderBy = self::ORDER_BY,
        string $orderDir = self::ORDER_DIR,
        array $conditions = []
    ): mixed {
        $query = $this->query;
        if ($applyOrder) {
            $query = $query->orderBy($orderBy, $orderDir);
        }
        $query = $this->applyConditions($query, $conditions);

        return $query->pluck($valueField, $labelField);
    }

    public function findAll(array $fields = ['*'], bool $applyOrder = true, string $orderBy = self::ORDER_BY, string $orderDir = self::ORDER_DIR): mixed
    {
        $query = $this->query;
        if ($applyOrder) {
            $query = $query->orderBy($orderBy, $orderDir);
        }

        return $query->get($fields);
    }

    public function baseSearch(
        $query,
        array $filters = [],
        array $relations = [],
        array $data = []
    ): mixed {

        /* $classname = "App\Models\\$this->modelName";
        $query = $classname::query(); */

        $query = $this->applyRelations($query, $relations);

        if (! empty($filters)) {
            foreach ($this->model->getFilters() as $filter) {

                if (isset($filters[$filter]) and ! empty($filters[$filter])) {
                    if (isset($query)) {
                        $withFilter = 'of'.ucfirst($filter);
                        $query = $query->$withFilter($filters[$filter]);
                    }
                }
            }
        }

        return $query;
    }

    public function search(array $filters = [], array $relations = [], array $data = []): mixed
    {
        $query = $this->baseSearch($this->query, $filters, $relations, $data);

        return $this->getQueryResult($query, $data);
    }

    public function searchWithTrashed(
        array $filters = [],
        array $relations = [],
        array $data = []
    ): mixed {
        $query = $this->baseSearch(
            $this->query->withTrashed(),
            $filters,
            $relations,
            $data
        );

        return $this->getQueryResult($query, $data);
    }

    public function getQueryResult($query, array $data = []): mixed
    {

        $page = $data['page'] ?? true;
        $limit = $data['limit'] ?? self::LIMIT;
        $customizePaginationURI = $data['customizePaginationUri'] ?? null;
        $paginationURI = $data['paginationUri'] ?? null;
        $order = $data['order'] ?? [];
        if (! empty($order)) {
            foreach ($order as $orderBy => $orderDir) {
                $query = $query->orderBy($orderBy, $orderDir);
            }
        } else {
            // $query = $query->latest();
        }

        // $query->dd();

        $groupBy = $data['groupBy'] ?? null;
        if (! empty($groupBy)) {
            return $query->get()->groupBy($groupBy);
        }

        if ($customizePaginationURI) {
            $query = $query->paginate($limit);

            return $query->withPath($paginationURI);
        }

        if ($page) {
            return $query->paginate($limit);
        }

        /* if ($limit) {
            return $query->take($limit)->get();
        } */

        return $query->get();
    }

    protected function cleanUpAttributes($attributes): array
    {
        return collect($attributes)->filter(fn ($value, $key) => $this->model->isFillable($key))->toArray();
    }

    /**
     * @param  null  $groupBy
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function searchBySelected(
        $groupBy = null,
        array $fields = [],
        array $filters = [],
        array $relations = [],
        bool $applyOrder = false,
        bool $page = false,
        bool $limit = false,
        string $orderBy = self::ORDER_BY,
        string $orderDir = self::ORDER_DIR
    ): array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection {
        $query = $this->query;
        $query = $this->applyRelations($query, $relations);
        if (! empty($filters)) {
            foreach ($this->model->getFilters() as $filter) {
                //if (isset($filters[$filter]) and !empty($filters[$filter])) {
                if (isset($filters[$filter])) {
                    $withFilter = 'of'.ucfirst($filter);
                    $query = $query->$withFilter($filters[$filter]);
                }
            }
        }
        if (! empty($fields)) {
            $query = $query->selectRaw(implode(',', $fields));
        }
        if (! empty($groupBy)) {
            $query = $query->groupBy(implode(',', $groupBy));
        }
        if ($applyOrder) {
            $query = $query->orderBy($orderBy, $orderDir);
        }
        if ($page) {
            return $query->paginate($limit);
        }
        if ($limit) {
            return $query->take($limit)->get();
        }

        return $query->get();
    }

    /**
     * Create a Pagination From Items Of  array Or collection.
     */
    public function paginate(array|Collection $items, int $perPage = 1, ?int $page = null, array $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function relationCreate(Model $model, string $relation, array $attributes = []): mixed
    {
        if (! empty($attributes)) {
            return $model->{$relation}()->create($attributes);
        }

        return false;
    }

    public function toggleField($model, string $field): mixed
    {
        $newVal = 1;
        if ($model[$field] == 1) {
            $newVal = 0;
        }

        return $this->update($model, [$field => $newVal]);
    }

    /**
     * insert more than 1 model to database
     *
     * @param  $data  => array of columns names and its values
     */
    public function CreateMulti(array $data)
    {
        return $this->query->insert($data);
    }
}
