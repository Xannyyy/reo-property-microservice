<?php

namespace App\Repositories\BaseRepository;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractBaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($request)
    {
        return $this->model->create($request);
    }

    public function update($modelId, $request)
    {
        return $this->findById($modelId)->update($request);
    }

    public function findById($modelId, $relations = null)
    {
        if($relations){
            return $this->model->with($relations)->find($modelId);
        }

        return $this->model->find($modelId);
    }

    public function findOrFail($modelId)
    {
        return $this->model->findOrFail($modelId);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getFirst()
    {
        return $this->model->first();
    }

    public function delete($id)
    {
        return $this->findById($id)->delete();
    }

    public function updateByField($field, $fieldValue, $data)
    {
        return $this->model->where($field, $fieldValue)->update($data);
    }
}

