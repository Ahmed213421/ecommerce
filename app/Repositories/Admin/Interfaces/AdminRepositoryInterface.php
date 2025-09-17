<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Admin;

interface AdminRepositoryInterface
{
    /**
     * Get all admins
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Find admin by ID
     *
     * @param int $id
     * @return Admin|null
     */
    public function find($id);

    /**
     * Create new admin
     *
     * @param array $data
     * @return Admin
     */
    public function create(array $data);

    /**
     * Update admin
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data);

    /**
     * Delete admin
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);

    /**
     * Sync roles for admin
     *
     * @param Admin $user
     * @param array $roles
     * @return mixed
     */
    public function syncRoles($user, array $roles);
}
