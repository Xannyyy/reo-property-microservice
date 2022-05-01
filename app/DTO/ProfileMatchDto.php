<?php


namespace App\DTO;


use App\Models\SearchProfile;

class ProfileMatchDto
{
    public int $exactMatches;
    public int $looseMatches;
    public int $score;
    public int $searchProfileId;

    public static function fromSearchProfileMatchesAndScore(
        SearchProfile $profile,
        int $exactMatches,
        int $looseMatches,
        int $score
    ): ProfileMatchDto
    {
        $profileMatchDto = new ProfileMatchDto();
        $profileMatchDto->searchProfileId = $profile->id;
        $profileMatchDto->score = $score;
        $profileMatchDto->exactMatches = $exactMatches;
        $profileMatchDto->looseMatches = $looseMatches;

        return $profileMatchDto;
    }
}
