<?php

namespace Http\services;

class Request
{
    public static function getPath(): string
    {
        return rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
    }

    public static function getQueryString(): ?string
    {
        return parse_url($_SERVER['REQUEST_URI'])['query'] ?? null;
    }

    public static function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public static function getAuth()
    {
        return $_SERVER['HTTP_USER_ID'] ?? null;
    }

    public static function getBody()
    {
        $json = json_decode(file_get_contents('php://input'), true) ?? [];

        return match (self::getMethod()) {
            'get' => $_GET,
            'post', 'put', 'delete' => $json,
            default => [],
        };
    }
}
