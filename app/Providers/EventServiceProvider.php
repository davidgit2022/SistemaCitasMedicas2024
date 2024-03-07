<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Appointment;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Event;
use App\Events\CancelAppointmentEvent;
use App\Observers\AppointmentObserver;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailCancellationListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        CancelAppointmentEvent::class => [
            SendEmailCancellationListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Appointment::observe(AppointmentObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
