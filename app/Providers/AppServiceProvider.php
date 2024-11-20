<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectInvitationRepository;
use App\Repositories\UserRepository;
use App\Services\ProjectService;
use App\Services\ProjectInvitationService;
use App\Services\UserService;
use App\Services\ProjectAssignmentService;
use App\Repositories\ProjectAssignmentRepository;

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
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository();
        });
        $this->app->bind(ProjectAssignmentRepository::class, function ($app) {
            return new ProjectAssignmentRepository();
        });

        //Services

        $this->app->bind(ProjectService::class, function ($app) {
            return new ProjectService($app->make(ProjectRepository::class));
        });

        $this->app->bind(ProjectInvitationService::class, function ($app) {
            return new ProjectInvitationService($app->make(ProjectInvitationRepository::class));
        });

        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });
        $this->app->bind(ProjectAssignmentService::class, function ($app) {
            return new ProjectAssignmentService($app->make(ProjectAssignmentRepository::class));
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
