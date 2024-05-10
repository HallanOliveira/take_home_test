<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\v1\BaseApiController;
use App\Core\Services\GetBalanceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BalanceController extends BaseApiController
{
    /**
     * Get the balance value
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getBalance(Request $request): JsonResponse
    {
        try {
            $service = new GetBalanceService();
            $data    = $service->execute();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
        return $this->successResponse('Balance retrieve with success!', $data);
    }
}