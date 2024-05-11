<?php

namespace App\Core\Services;

use App\Core\Contracts\Repositories\AccountRepositoryInterface;
use App\Core\DTOs\AccountDTO;
use \Exception;

class GetBalanceService
{
    public function __construct(
        private readonly AccountRepositoryInterface $accountRepository
    )
    {
    }

    public function execute(AccountDTO $accountDTO): float
    {
        $data = $accountDTO->toArray();
        if (empty($data['account_id'])) {
            throw new Exception('Account ID is required');
        }

        $account = $this->accountRepository->find($data['account_id']);

        if (empty($account)) {
            throw new Exception(0, 404);
        }

        return $account['balance'];
    }
}
