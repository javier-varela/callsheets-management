<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectInvitationRepository;
use App\Services\ProjectService;
use App\Services\ProjectInvitationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Repositories
        $this->app->bind(ProjectRepository::class, function ($app) {
            return new ProjectRepository();
        });

        $this->app->bind(ProjectInvitationRepository::class, function ($app) {
            return new ProjectInvitationRepository();
        });

        //Services

        $this->app->bind(ProjectService::class, function ($app) {
            return new ProjectService($app->make(ProjectRepository::class));
        });

        $this->app->bind(ProjectInvitationService::class, function ($app) {
            return new ProjectInvitationService($app->make(ProjectInvitationRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
