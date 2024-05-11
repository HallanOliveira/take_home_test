<?php

namespace App\Core\Services;

use App\Core\Contracts\Formatters\AccountDataFormatterInterface;
use App\Core\Contracts\Repositories\AccountRepositoryInterface;
use App\Core\DTOs\AccountDTO;
use App\Core\Enums\EventTypeEnum;

class DepositEventService
{
    public function __construct(
        private readonly AccountRepositoryInterface    $accountRepository,
        private readonly AccountDataFormatterInterface $accountDataFormatter
    )
    {
    }

    /**
     * Deposit value in the account or create a new account if not exists
     *
     * @param AccountDTO $accountDTO
     *
     * @return AccountDTO
     */
    public function execute(AccountDTO $accountDTO): AccountDTO
    {
        $data = $accountDTO->toArray();
        if (empty($data['destination'])) {
            throw new \Exception('Destination is required', 400);
        }

        $id      = $data['destination'];
        $account = $this->accountRepository->find($data['destination']);
        if (empty($account)) {
            $data['id']      = $id;
            $data['balance'] = $data['amount'];
            unset($data['destination'], $data['type'], $data['amount']);
            return $this->createAccount($data);
        }

        $account['balance'] += $data['amount'];
        unset($account['amount']);
        $accountUpdated['destination'] = $this->accountRepository->update($id, $account);
        return $this->accountDataFormatter->execute($accountUpdated);
    }

    /**
     * Create a new account
     *
     * @param array $data
     *
     * @return AccountDTO
     */
    private function createAccount(array $data): AccountDTO
    {
        $accountCreated["destination"] = $this->accountRepository->create($data);
        return $this->accountDataFormatter->execute($accountCreated);
    }
}
