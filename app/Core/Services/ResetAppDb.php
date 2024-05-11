<?php

namespace App\Core\Services;

use App\Core\Contracts\Repositories\AccountRepositoryInterface;
use Exception;

class ResetAppDb
{
    public function __construct(
        protected readonly AccountRepositoryInterface $accountRepository
    )
    {
    }

    public function execute()
    {
        $deleted = $this->accountRepository->deleteAll();
        if (!$deleted) {
            throw new Exception('Error on reset database', 500);
        }
        return true;
    }
}
