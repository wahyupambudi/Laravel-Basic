<?php

namespace App\Providers;

use App\Services\Impl\UserServicesImpl;
use App\Services\UserServices;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{

    // membuat public array singletons
    public array $singletons = [
        UserServices::class => UserServicesImpl::class
    ];

    // membuat function provides
    public function provides(): array
    {
        return [UserServices::class];
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
