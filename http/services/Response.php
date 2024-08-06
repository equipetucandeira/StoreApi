<?php

namespace Http\services;

class Response
{
    public static function json(array $data = [], int $status = 200)
    {
        http_response_code($status);
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public static function success(int $httpCode, string $message)
    {
        self::json([
            'type' => "Success",
            'description' => $message,
        ], $httpCode);
    }

    public static function error(int $httpCode, string $errorMessage, string $file, int $line)
    {
        self::json([
      'Type' => "Error",
      'Location' => $file,
      'Line' => $line,
      'Message' => $errorMessage,
        ], $httpCode);
    }
}
