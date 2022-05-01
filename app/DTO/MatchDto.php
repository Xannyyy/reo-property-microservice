<?php


namespace App\DTO;


class MatchDto
{
    public int $exactMatches;
    public int $looseMatches;

    public static function fromExactAndLooseMatches($exactMatches, $looseMatches): MatchDto
    {
        $matchDto = new MatchDto();
        $matchDto->exactMatches = $exactMatches;
        $matchDto->looseMatches = $looseMatches;

        return $matchDto;
    }
}
