<?php

namespace App\Http\Controllers\Api\v1;

use App\Core\Contracts\Formatters\AccountDataFormatterInterface;
use App\Http\Controllers\Api\v1\BaseApiController;
use App\Adapters\Interceptors\EventInterceptor;
use App\Core\Services\GetBalanceService;
use App\Core\Services\ResetAppDb;
use App\Http\Requests\EventHandleRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends BaseApiController
{
    public function __construct(
        private readonly AccountDataFormatterInterface $AccountDataFormatter
    )
    {
    }

    /**
     * Reset Application database
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function reset(ResetAppDb $resetAppDb): Response
    {
        try {
            $resetAppDb->execute();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), $th->getCode());
        }
        return $this->successResponse('OK');
    }

    /**
     * Get the balance value
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getBalance(Request $request, GetBalanceService $getBalanceService): Response
    {
        try {
            $inputDTO     = $this->AccountDataFormatter->execute($request->all());
            $balanceValue = $getBalanceService->execute($inputDTO);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), $th->getCode());
        }
        return $this->successResponse($balanceValue);
    }

    /**
     * Handle the event
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function eventHandle(EventHandleRequest $request, EventInterceptor $eventInterceptor): Response
    {
        try {
            $payload   = $request->validated();
            $inputDTO  = $this->AccountDataFormatter->execute($payload);
            $service   = $eventInterceptor->execute($inputDTO);
            $outputDTO = $service->execute($inputDTO);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), $th->getCode());
        }
        return $this->successResponse($outputDTO->toArray(), 201);
    }
}
