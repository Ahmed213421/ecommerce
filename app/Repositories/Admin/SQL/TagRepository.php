<?php

namespace App\Repositories\Admin\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Repositories\Admin\Contracts\TagContract;

class TagRepository extends BaseRepository implements TagContract
{

    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return $this->model->latest()->get();
    }

    public function create(array $data = []): mixed
    {
        return $this->model->create($data);
    }

    public function update($id, array $data = []): mixed
    {
        $tag = $this->find($id);
        if ($tag) {
            $tag->update($data);
            return $tag;
        }
        return false;
    }

    public function delete($id)
    {
        $tag = $this->find($id);
        if ($tag) {
            return $tag->delete();
        }
        return false;
    }

    public function find(int $id, array $relations = [], array $filters = []): mixed
    {
        return $this->model->find($id);
    }
}
