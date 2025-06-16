<?php

namespace App\Helpers;

class ApiResponse
{
    public static function sendResponse($code = 200, $message = null, $data = null): \Illuminate\Http\JsonResponse
    {
        $response = [
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $code);
    }
}
