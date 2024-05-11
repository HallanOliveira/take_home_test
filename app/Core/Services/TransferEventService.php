<?php

namespace App\Core\Services;

use App\Core\Contracts\Repositories\AccountRepositoryInterface;
use App\Core\Contracts\Formatters\AccountDataFormatterInterface;
use App\Core\Services\DepositEventService;
use App\Core\Services\WithdrawEventService;
use App\Core\Services\GetBalanceService;
use App\Core\DTOs\AccountDTO;

class TransferEventService
{
    public function __construct(
        private readonly AccountRepositoryInterface    $accountRepository,
        private readonly AccountDataFormatterInterface $accountDataFormatter,
        private readonly DepositEventService           $depositEventService,
        private readonly WithdrawEventService          $withdrawEventService,
        private readonly GetBalanceService             $getBalanceService
    )
    {
    }

    /**
     * Transfer value between accounts
     *
     * @param AccountDTO $accountDTO
     *
     * @return AccountDTO
     */
    public function execute(AccountDTO $accountDTO): AccountDTO
    {
        $data          = $accountDTO->toArray();
        $DTOBalance    = $this->accountDataFormatter->execute(['account_id' => $data['origin']]);
        $balanceOrigin = $this->getBalanceService->execute($DTOBalance);
        if ($balanceOrigin < $data['amount']) {
            throw new \Exception(0, 400);
        }

        $dataToWithdraw    = $data;
        $dataToDeposit     = $data;
        unset($dataToWithdraw['destination'], $dataToDeposit['origin']);
        $DTOWithdraw = $this->accountDataFormatter->execute($dataToWithdraw);
        $DTODeposit  = $this->accountDataFormatter->execute($dataToDeposit);

        $response = $this->depositEventService->execute($DTODeposit)->toArray();
        $response += $this->withdrawEventService->execute($DTOWithdraw)->toArray();
        return $this->accountDataFormatter->execute($response);
    }
}
