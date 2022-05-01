<?php


namespace App\Domains\ProfileMatcher;


use App\DTO\ProfileMatchDto;
use App\Models\Property;
use App\Models\SearchProfile;

interface ProfileMatcherInterface
{
    public function matchSearchProfilesToProperty(Property $property, SearchProfile $searchProfile): ?ProfileMatchDto;
}
