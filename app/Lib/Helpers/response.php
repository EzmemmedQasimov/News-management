<?php

use Illuminate\Http\Resources\Json\JsonResource;

if (!function_exists('error')) {
    function error(int $code = 500, string $message = 'Server xətası.', string|array $errors = null)
    {
        return response()->json([
            'code' =>  $code,
            'success' => false,
            'message' => $message,
            'errors'  => $errors
        ], $code);
    }
}

if (!function_exists('success')) {
    function success(int $code = 200, string $message = '', array|JsonResource $data = [])
    {
        return response()->json([
            'code' =>  $code,
            'success' => true,
            'message' => $message,
            'data'    => $data
        ], $code);
    }
}