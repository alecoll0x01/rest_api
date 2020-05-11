<?php


namespace App\API;


class ApiError
{
    public function errorMessage($message, $code)
    {
        return [
            'msg' => $message,
            'code' => $code
        ];
    }
}
