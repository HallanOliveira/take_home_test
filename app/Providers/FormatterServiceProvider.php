<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Contracts\Formatters\AccountDataFormatterInterface;
use App\Adapters\Formatters\AccountDataFormatter;

class FormatterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AccountDataFormatterInterface::class, AccountDataFormatter::class);
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
