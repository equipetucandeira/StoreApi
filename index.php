<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/http/routes/Routes.php";
use Http\routes\Router;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
Router::execute();


