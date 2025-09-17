<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Slider;

interface SliderRepositoryInterface
{
    /**
     * Get all sliders
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Create new slider
     *
     * @param array $data
     * @return Slider
     */
    public function create(array $data);

    /**
     * Update slider
     *
     * @param array $data
     * @param int $id
     * @return Slider|bool
     */
    public function update(array $data, $id);

    /**
     * Delete slider
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);

    /**
     * Find slider by ID
     *
     * @param int $id
     * @return Slider|null
     */
    public function find($id);
}
