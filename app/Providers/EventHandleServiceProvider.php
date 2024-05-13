<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Contracts\Services\EventServiceInterface;
use App\Core\Services\DepositEventService;
use App\Core\Services\WithdrawEventService;
use App\Core\Services\TransferEventService;
use App\Core\Enums\EventTypeEnum;

class EventHandleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EventServiceInterface::class, function ($app, $parameters) {
            $type = $parameters['type'];

            /**
             * return Service based on type
             *
             * @return EventServiceInterface
             */
            return match ($type) {
                EventTypeEnum::deposit->value  => app(DepositEventService::class),
                EventTypeEnum::withdraw->value => app(WithdrawEventService::class),
                EventTypeEnum::transfer->value => app(TransferEventService::class),
                default                        => throw new \Exception('Event type not found', 400),
            };
        });
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
