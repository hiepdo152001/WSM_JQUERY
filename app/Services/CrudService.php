<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class CrudService
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $payload)
    {
        return $this->model->create($payload);
    }

    public function edit($id, array $payload)
    {
        $record = $this->getById($id);
        return $record->update($payload);
    }


    public function deleteId($id)
    {
        $record = $this->getById($id);
        return $record->delete();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function find($where = [])
    {
        return $this->model->where($where)->get();
    }
}
