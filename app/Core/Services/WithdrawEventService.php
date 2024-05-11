<?php

namespace App\Core\Services;

use App\Core\Contracts\Repositories\AccountRepositoryInterface;
use App\Core\Contracts\Formatters\AccountDataFormatterInterface;
use App\Core\DTOs\AccountDTO;

class WithdrawEventService
{
    public function __construct(
        private readonly AccountRepositoryInterface    $accountRepository,
        private readonly AccountDataFormatterInterface $accountDataFormatter
    )
    {
    }

    public function execute(AccountDTO $accountDTO): AccountDTO
    {
        $data = $accountDTO->toArray();
        if (empty($data['origin'])) {
            throw new \Exception('origin is required', 400);
        }

        $id      = $data['origin'];
        $account = $this->accountRepository->find($data['origin']);
        if (empty($account)) {
            throw new \Exception(0, 404);
        }

        $account['balance'] -= $data['amount'];
        unset($account['amount']);
        $accountUpdated['origin'] = $this->accountRepository->update($id, $account);
        return $this->accountDataFormatter->execute($accountUpdated);
    }
}
