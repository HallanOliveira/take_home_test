<?php

namespace App\Adapters\Formatters;

use App\Core\Contracts\Formatters\AccountDataFormatterInterface;
use App\Core\DTOs\AccountDTO;

class AccountDataFormatter implements AccountDataFormatterInterface
{
    public function execute(array $data): AccountDTO
    {
        return AccountDTO::create($data);
    }
}
