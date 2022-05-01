<?php


namespace App\Domains\ProfileMatcher;


use App\DTO\MatchDto;
use App\DTO\ProfileMatchDto;
use App\Models\Property;
use App\Models\SearchProfile;

class ProfileMatcher implements ProfileMatcherInterface
{

    public function matchSearchProfilesToProperty(Property $property, SearchProfile $searchProfile): ?ProfileMatchDto
    {
        $exactMatches = 0;
        $looseMatches = 0;
        $currentPropertyField = null;
        $propertyFields = $property->fields;

        foreach ($searchProfile->fields as $searchProfileField) {
            $currentPropertyField = $propertyFields->where('name', $searchProfileField->name)->first();
            if (!$currentPropertyField) {
                return null;
            }

            $matches = $this->checkExactAndLooseMatches($searchProfileField, $currentPropertyField);
            $exactMatches += $matches->exactMatches;
            $looseMatches += $matches->looseMatches;
        }

        return ProfileMatchDto::fromSearchProfileMatchesAndScore(
            $searchProfile,
            $exactMatches,
            $looseMatches,
            $this->calculateMatchScore($exactMatches, $looseMatches)
        );
    }

    private function checkExactAndLooseMatches($searchProfileField, $currentPropertyField): MatchDto{
        $exactMatches = 0;
        $looseMatches = 0;

        if (is_array($searchProfileField->value)) {
            $minValue = $searchProfileField->value[0];
            $maxValue = $searchProfileField->value[1];

            if ($this->checkIfValueIsBetweenRangeWithNullRule($currentPropertyField->value, $minValue, $maxValue)) {
                $exactMatches += 1;
            }else{
                $minValue -= $this->findNumberPercentage($minValue, 25);
                $maxValue += $this->findNumberPercentage($maxValue, 25);

                if($this->checkIfValueIsBetweenRangeWithNullRule($currentPropertyField->value, $minValue, $maxValue)){
                    $looseMatches += 1;
                }
            }
        } else {
            if ($searchProfileField->value == $currentPropertyField->value) {
                $exactMatches += 1;
            }
        }

        return MatchDto::fromExactAndLooseMatches($exactMatches, $looseMatches);
    }

    private function checkIfValueIsBetweenRangeWithNullRule(?int $valueToCompare, ?int $minValue, ?int $maxValue): bool{
        $isBiggerOrEqualToMinValue = !$minValue || $valueToCompare >= $minValue;
        $isSmallerOrEqualToMaxValue = !$maxValue || $valueToCompare <= $maxValue;

        return $isBiggerOrEqualToMinValue && $isSmallerOrEqualToMaxValue;
    }

    private function findNumberPercentage(?int $number, int $percentage): ?float {
        if(!$number || $number == 0){
            return null;
        }

        return ($percentage / 100) * $number;
    }

    public function calculateMatchScore(int $exactMatches, int $looseMatches): int{
        // Note: The sole reason of this method for being public is for ease of testing. Also this could be some
        // complex calculation which needs to be centralized and so we create it as a single point of truth.
        return ($exactMatches * 2) + $looseMatches;
    }
}
