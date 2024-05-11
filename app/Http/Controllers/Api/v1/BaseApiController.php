<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class BaseApiController extends Controller
{
    /**
     * Return a error response
     *
     * @param string|int  $message
     * @param int         $code
     *
     * @return Response
     */
    protected function errorResponse(string|int $message, int $code = 500): Response
    {
        return response($message, $code == 0 ? 500 : $code);
    }

    /**
     * Return a success response
     *
     * @param array|string|float $data
     * @param integer            $code
     *
     * @return Response
     */
    protected function successResponse(array|string|float $data, int $code = 200): Response
    {
        return response($data,$code);
    }
}
