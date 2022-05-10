<?php

namespace App\Repositories;

use App\Interfaces\EloquentInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all models.
     * 
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Store a model.
     *
     * @param array $payload
     * @return Model
     */
    public function store(array $payload): Model
    {
        $model = $this->model->create($payload);

        return $model;
    }

    /**
     * Find model by id.
     * 
     * @param int $id
     * @return Model
     */
    public function getById(int $id): ?Model
    {
        return $this->model->find($id);
    }    

    /**
     * Update existing model.
     *
     * @param int $id
     * @param array $payload
     * @return bool
     */
    public function update(int $id, array $payload): Model
    {
        $model = $this->getById($id);
        $model->update($payload);

        return $model;
    }

    /**
     * Delete model by id.
     *
     * @param int $id
     * @return Model
     */
    public function delete(int $id): Model
    {
        $this->model->destroy($id);
        
        return $this->model;
    }
}