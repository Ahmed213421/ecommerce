<?php

namespace App\Repositories\Admin;

use App\Models\Tag;
use App\Repositories\Admin\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    protected $model;

    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->latest()->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
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

    public function find($id)
    {
        return $this->model->find($id);
    }
}
