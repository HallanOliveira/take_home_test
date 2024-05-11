<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Adapters\Repositories\AccountRepository;
use App\Core\Contracts\Repositories\AccountRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
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
