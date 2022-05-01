<?php


namespace App\Repositories\SearchProfileRepository;


use App\Repositories\BaseRepository\BaseRepositoryInterface;

interface SearchProfileRepositoryInterface extends BaseRepositoryInterface
{
    public function getSearchProfilesByPropertyTypeId($propertyTypeId);
}
