<?php


namespace App\Services\MatchService;


use App\Domains\ProfileMatcher\ProfileMatcherInterface;
use App\Repositories\PropertyRepository\PropertyRepositoryInterface;
use App\Repositories\SearchProfileRepository\SearchProfileRepositoryInterface;

class MatchService implements MatchServiceInterface
{
    private PropertyRepositoryInterface $propertyRepository;
    private SearchProfileRepositoryInterface $searchProfileRepository;
    private ProfileMatcherInterface $profileMatcher;

    public function __construct(
        PropertyRepositoryInterface $propertyRepository,
        SearchProfileRepositoryInterface $searchProfileRepository,
        ProfileMatcherInterface $profileMatcher,
    )
    {
        $this->propertyRepository = $propertyRepository;
        $this->searchProfileRepository = $searchProfileRepository;
        $this->profileMatcher = $profileMatcher;
    }

    public function matchPropertyToSearchProfiles(int $propertyId): \Illuminate\Support\Collection
    {
        $property = $this->propertyRepository->findById($propertyId, ['propertyType', 'fields']);
        $searchProfiles = $this->searchProfileRepository->getSearchProfilesByPropertyTypeId($property->property_type_id);

        $matches = [];
        foreach ($searchProfiles as $searchProfile) {
            $matches[] = $this->profileMatcher->matchSearchProfilesToProperty($property, $searchProfile);
        }

        return collect($matches)->sortByDesc('score')->filter();
    }
}
