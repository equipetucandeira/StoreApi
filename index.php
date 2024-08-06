<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/http/routes/Routes.php";
use Http\routes\Router;

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
Router::execute();


