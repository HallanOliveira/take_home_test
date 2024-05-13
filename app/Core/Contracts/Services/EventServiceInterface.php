<?php

namespace App\Core\Contracts\Services;

use App\Core\DTOs\AccountDTO;

interface EventServiceInterface
{
    public function execute(AccountDTO $accountDTO): AccountDTO;
}