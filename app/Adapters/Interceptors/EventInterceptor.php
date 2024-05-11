<?php

namespace App\Adapters\Interceptors;

use App\Core\DTOs\AccountDTO;
use App\Core\Services\DepositEventService;
use App\Core\Services\WithdrawEventService;
use App\Core\Services\TransferEventService;
use App\Core\Enums\EventTypeEnum;
use Exception;

class EventInterceptor
{
    public function execute(AccountDTO $accountDTO)
    {
        $data = $accountDTO->toArray();
        if (empty($data['type'])) {
            throw new Exception('Event type is required', 400);
        }

        switch ($data['type']) {
            case EventTypeEnum::deposit->value:
                return app(DepositEventService::class);
            case EventTypeEnum::withdraw->value:
                return app(WithdrawEventService::class);
            case EventTypeEnum::transfer->value:
                return app(TransferEventService::class);
            default:
                throw new Exception('Invalid event type', 400);
        }
    }
}
