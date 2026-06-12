<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Contracts\TagContract;

class AdminTagService
{
    protected $tagRepository;

    public function __construct(TagContract $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTags()
    {
        return $this->tagRepository->getAll();
    }

    public function createTag(array $data)
    {
        return $this->tagRepository->create($data);
    }

    public function updateTag($id, array $data)
    {
        return $this->tagRepository->update($id, $data);
    }

    public function deleteTag($id)
    {
        return $this->tagRepository->delete($id);
    }
}
