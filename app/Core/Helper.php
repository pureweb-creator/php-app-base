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

    public static function getLanguage($lang="ua")
    {
        return include $_SERVER['DOCUMENT_ROOT']."/static/lang/$lang.php";
    }
}