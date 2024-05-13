<?php

namespace App\Adapters\Interceptors;

use App\Core\DTOs\AccountDTO;
use App\Core\Contracts\Services\EventServiceInterface;

class EventInterceptor
{

    public function execute(AccountDTO $accountDTO): EventServiceInterface
    {
        $data    = $accountDTO->toArray();
        $service = app(EventServiceInterface::class, [
            'type' => $data['type'],
        ]);

        return $service;
    }
}
