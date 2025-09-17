<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Role;

interface RoleRepositoryInterface
{
    /**
     * Get all roles
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Find role by ID
     *
     * @param int $id
     * @return Role|null
     */
    public function find($id);

    /**
     * Create new role
     *
     * @param array $data
     * @return Role
     */
    public function create(array $data);

    /**
     * Update role
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data);

    /**
     * Delete role
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);

    /**
     * Get role permissions
     *
     * @param int $roleId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRolePermissions($roleId);

    /**
     * Sync permissions for role
     *
     * @param int $roleId
     * @param array $permissions
     * @return mixed
     */
    public function syncPermissions($roleId, array $permissions);
}
