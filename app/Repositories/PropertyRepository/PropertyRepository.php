<?php


namespace App\Repositories\PropertyRepository;


use App\Models\Property;
use App\Repositories\BaseRepository\AbstractBaseRepository;

class PropertyRepository extends AbstractBaseRepository implements PropertyRepositoryInterface
{
    public function __construct(Property $model)
    {
        parent::__construct($model);
    }
}
