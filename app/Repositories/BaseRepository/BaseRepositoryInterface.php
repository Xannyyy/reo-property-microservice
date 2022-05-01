<?php


namespace App\Repositories\BaseRepository;

interface BaseRepositoryInterface
{
    public function create($request);

    public function update($modelId, $request);

    public function findById($modelId, $relations = null);

    public function getAll();

    public function getFirst();

    public function delete($id);

    public function updateByField($field, $fieldValue, $data);
}
