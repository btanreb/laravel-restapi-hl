<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentInterface
{
    /**
     * Get all models.
     * 
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Store a model
     * 
     * @param array $payload
     * @return Model
     */
    public function store(array $payload): Model;

    /**
     * Find model by id
     * 
     * @param int $id
     * @return Model
     */
    public function getById(int $id): ?Model;

    /**
     * Update existing model.
     * 
     * @param int $id
     * @param array $payload
     * @return Model
     */
    public function update(int $id, array $payload): Model;

    /**
     * Delete model by id.
     * 
     * @param int $id
     * @return Model
     */
    public function delete(int $id): Model;
}