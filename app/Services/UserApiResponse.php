<?php

namespace App\Services;

class UserApiResponse
{
    public static function success($data = null, $message = 'Success', $token = null)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];
        if ($token !== null) {
            $response['token'] = $token;
        }
        return $response;
    }
    public static function error($message, $data = null)
    {
        return [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];
    }
}
