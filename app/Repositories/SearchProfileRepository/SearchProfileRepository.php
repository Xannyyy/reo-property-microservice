<?php


namespace App\Repositories\SearchProfileRepository;


use App\Models\SearchProfile;
use App\Repositories\BaseRepository\AbstractBaseRepository;

class SearchProfileRepository extends AbstractBaseRepository implements SearchProfileRepositoryInterface
{
    public function __construct(SearchProfile $model)
    {
        parent::__construct($model);
    }

    public function getSearchProfilesByPropertyTypeId($propertyTypeId){
        return $this->model->with(['fields', 'propertyType'])->where('property_type_id', $propertyTypeId)->get();
    }
}
