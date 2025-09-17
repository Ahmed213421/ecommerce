<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Get all users
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Find user by ID
     *
     * @param int $id
     * @return User|null
     */
    public function find($id);

    /**
     * Create new user
     *
     * @param array $data
     * @return User
     */
    public function create(array $data);

    /**
     * Update user
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data);

    /**
     * Delete user
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);
}
