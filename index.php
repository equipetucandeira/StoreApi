<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/http/routes/Routes.php";
use Http\routes\Router;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization, USER-ID");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Expose-Headers: HTTP_USER_ID");


if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Responder com status 200 OK e sair
    http_response_code(200);
    exit();
}

Router::execute();


