<?php

namespace App\Core\Enums;

/**
 * Class EventTypeEnum
 *
 * Types allowed for the event type
 *
 * @package App\Core\Enums
 */
enum EventTypeEnum: string
{
    case deposit  = 'deposit';
    case withdraw = 'withdraw';
    case transfer = 'transfer';

    public static function values(): array
    {
       return array_column(self::cases(), 'value');
    }
}
