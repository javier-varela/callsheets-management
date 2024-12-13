<?php

namespace App\Providers;

use App\Repositories\CallsheetCastRepository;
use App\Repositories\CallsheetEventRepository;
use App\Repositories\CallsheetRepository;
use App\Repositories\EventCastRepository;
use App\Repositories\ProjectAdminRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectInvitationRepository;
use App\Repositories\UserRepository;
use App\Services\ProjectService;
use App\Services\ProjectInvitationService;
use App\Services\UserService;
use App\Services\ProjectAssignmentService;
use App\Repositories\ProjectAssignmentRepository;
use App\Repositories\ProjectRoleAssignmentRepository;
use App\Repositories\ProjectRoleRepository;
use App\Repositories\ReportRepository;
use App\Repositories\StatsRepository;
use App\Services\CallsheetEventService;
use App\Services\CallsheetService;
use App\Services\EventCastService;
use App\Services\ProjectAdminService;
use App\Services\ProjectRoleService;
use App\Services\StatsService;
use App\Services\ProjectRoleAssignmentService;
use App\Services\ReportService;

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
        $this->app->bind(ProjectRoleRepository::class, function ($app) {
            return new ProjectRoleRepository();
        });
        $this->app->bind(ProjectAdminRepository::class, function ($app) {
            return new ProjectAdminRepository();
        });
        $this->app->bind(ProjectRoleAssignmentRepository::class, function ($app) {
            return new ProjectRoleAssignmentRepository();
        });
        $this->app->bind(CallsheetRepository::class, function ($app) {
            return new CallsheetRepository();
        });
        $this->app->bind(CallsheetEventRepository::class, function ($app) {
            return new CallsheetEventRepository();
        });
        $this->app->bind(EventCastRepository::class, function ($app) {
            return new EventCastRepository();
        });
        $this->app->bind(CallsheetCastRepository::class, function ($app) {
            return new CallsheetCastRepository();
        });

        //core
        $this->app->bind(StatsRepository::class, function ($app) {
            return new StatsRepository();
        });
        $this->app->bind(ReportRepository::class, function ($app) {
            return new ReportRepository();
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
        $this->app->bind(ProjectRoleService::class, function ($app) {
            return new ProjectRoleService($app->make(ProjectRoleRepository::class));
        });
        $this->app->bind(ProjectAdminService::class, function ($app) {
            return new ProjectAdminService($app->make(ProjectAdminRepository::class));
        });
        $this->app->bind(StatsService::class, function ($app) {
            return new StatsService($app->make(StatsRepository::class));
        });
        $this->app->bind(ProjectRoleAssignmentService::class, function ($app) {
            return new ProjectRoleAssignmentService($app->make(ProjectRoleAssignmentRepository::class));
        });
        $this->app->bind(CallsheetService::class, function ($app) {
            return new CallsheetService($app->make(CallsheetRepository::class));
        });
        $this->app->bind(CallsheetEventService::class, function ($app) {
            return new CallsheetEventService($app->make(CallsheetEventRepository::class));
        });
        $this->app->bind(EventCastService::class, function ($app) {
            return new EventCastService($app->make(EventCastRepository::class));
        });

        $this->app->bind(ReportService::class, function ($app) {
            return new ReportService($app->make(ReportRepository::class));
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
