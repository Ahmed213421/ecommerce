<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Tag;

interface TagRepositoryInterface
{
    /**
     * Get all tags
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Find tag by ID
     *
     * @param int $id
     * @return Tag|null
     */
    public function find($id);

    /**
     * Create new tag
     *
     * @param array $data
     * @return Tag
     */
    public function create(array $data);

    /**
     * Update tag
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, $id);

    /**
     * Delete tag
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);
}
