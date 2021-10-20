<?php

namespace App\Providers;

use App\Events\BooksCreated;
use App\Events\OrderCanceled;
use App\Listeners\BookUpdate;
use App\Events\SaleBillCreated;
use App\Listeners\CreateImportBills;
use Illuminate\Support\Facades\Event;
use App\Listeners\RestoreBookQuantity;
use Illuminate\Auth\Events\Registered;
use SocialiteProviders\Manager\SocialiteWasCalled;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // ... other providers
            'SocialiteProviders\\Google\\GoogleExtendSocialite@handle',
            'SocialiteProviders\\Facebook\\FacebookExtendSocialite@handle',
        ],
        BooksCreated::class=>[
            CreateImportBills::class,
        ],
        OrderCanceled::class=>[
            RestoreBookQuantity::class,
        ],
        SaleBillCreated::class=>[
            BookUpdate::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
