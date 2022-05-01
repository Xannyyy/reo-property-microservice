<?php

namespace App\Http\Controllers;

use App\Services\MatchService\MatchServiceInterface;

class MatchController extends Controller
{
    private MatchServiceInterface $matchService;

    public function __construct(
        MatchServiceInterface $matchService,
    )
    {
        $this->matchService = $matchService;
    }

    public function match($propertyId): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            $this->matchService->matchPropertyToSearchProfiles($propertyId)
        );
    }
}
