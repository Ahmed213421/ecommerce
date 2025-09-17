<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Permission;

interface PermissionRepositoryInterface
{
    /**
     * Get all permissions
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Find permission by ID
     *
     * @param int $id
     * @return Permission|null
     */
    public function find($id);

    /**
     * Create new permission
     *
     * @param array $data
     * @return Permission
     */
    public function create(array $data);

    /**
     * Update permission
     *
     * @param int $id
     * @param array $data
     * @return Permission
     */
    public function update($id, array $data);

    /**
     * Delete permission
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);
}
