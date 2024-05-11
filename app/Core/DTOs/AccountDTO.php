<?php

namespace App\Core\DTOs;

use App\Core\Traits\DTOTrait;

/**
 * Class AccountDTO
 *
 * Data Transfer Object for Account
 *
 * @package App\Core\DTOs
 * @property int   $account_id
 * @property float $balance
 * @property string $type
 * @property string|array $destination
 * @property float $amount
 * @property string $origin
 *
 */
class AccountDTO
{
    use DTOTrait;

    public readonly int          $account_id;
    public readonly float        $balance;
    public readonly string       $type;
    public readonly string|array $destination;
    public readonly float        $amount;
    public readonly string|array $origin;
}
