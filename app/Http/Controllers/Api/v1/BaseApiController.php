<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseApiController extends Controller
{
    /**
     * Return a error response
     *
     * @param string  $message
     * @param integer $code
     *
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $code = 500): JsonResponse
    {
        return response()->json(['error' => $message], $code);
    }

    /**
     * Return a success response
     *
     * @param string  $message
     * @param array   $data
     * @param integer $code
     *
     * @return JsonResponse
     */
    protected function successResponse(string $message, array $data, int $code = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data'    => $data
        ], $code);
    }
}