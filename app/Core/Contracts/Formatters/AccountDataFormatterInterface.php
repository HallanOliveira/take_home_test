<?php

namespace App\Core\Contracts\Formatters;

use App\Core\DTOs\AccountDTO;

interface AccountDataFormatterInterface
{
    /**
     * Execute the formatter returning a Data Transfer Object
     *
     * @param array $data
     * @return AccountDTO
     */
    public function execute(array $data): AccountDTO;
}
