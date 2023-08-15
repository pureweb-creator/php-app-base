<?php

namespace App\Core;

abstract class Helper
{
    public static function response($message=false, $success=true): void
    {
        $response = [
            'success' => $success,
            'message' => $message
        ];

        $_SESSION['response'] = $response;
    }
}