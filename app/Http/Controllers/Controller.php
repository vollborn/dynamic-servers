<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function json(string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], $code);
    }

    /**
     * @param Exception $exception
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function exception(
        Exception $exception,
        ?string $message = null,
        int $code = Response::HTTP_INTERNAL_SERVER_ERROR
    ): JsonResponse
    {
        Log::error($exception);

        return response()->json([
            'message' => $message ?? __('controllers.base.exception')
        ], $code);
    }
}
