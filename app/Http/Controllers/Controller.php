<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Ok ($message, $data): JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => 200,
            'data' => $data,
            'message' => $message
        ]);
    }

    public function Error ($message, $data, $code): JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => $code,
            'data' => $data,
            'message' => $message
        ], $code);
    }
}
