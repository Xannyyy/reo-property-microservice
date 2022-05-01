<?php

namespace App\Providers;

use App\Domains\ProfileMatcher\ProfileMatcher;
use App\Domains\ProfileMatcher\ProfileMatcherInterface;
use App\Repositories\PropertyRepository\PropertyRepository;
use App\Repositories\PropertyRepository\PropertyRepositoryInterface;
use App\Repositories\SearchProfileRepository\SearchProfileRepository;
use App\Repositories\SearchProfileRepository\SearchProfileRepositoryInterface;
use App\Services\MatchService\MatchService;
use App\Services\MatchService\MatchServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Repositories
        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        $this->app->bind(SearchProfileRepositoryInterface::class, SearchProfileRepository::class);

        // Domains
        $this->app->bind(ProfileMatcherInterface::class, ProfileMatcher::class);

        // Services
        $this->app->bind(MatchServiceInterface::class, MatchService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
