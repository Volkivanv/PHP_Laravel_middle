<?php

namespace App\Providers;

use App\Events\NewsCreated;
use App\Events\NewsHidden;
use App\Listeners\NewsHiddenListener;
use App\Listeners\SendNewsCreatedNotification;
use App\Listeners\SendNewsToRemoteServer;
use App\Models\News;
use App\Observers\NewsObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewsCreated::class => [
            SendNewsCreatedNotification::class,
            SendNewsToRemoteServer::class
        ],
        NewsHidden::class => [
            NewsHiddenListener::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
        News::observe(NewsObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
