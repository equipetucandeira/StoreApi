<?php

namespace App\factory;

use PDO;
use PDOException;

class DatabaseFactory
{
    public static function createPDO()
  {
    try{
        $host = $_ENV['HOST'];
        $db =  $_ENV['DB'];
        $user = $_ENV['USER'];
        $pass = $_ENV['PASSWORD'];
        $port = $_ENV['PORT'];
        $dsn = "mysql:host=$host;port=$port;dbname=$db";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
      return new PDO($dsn, $user, $pass, $options);
    }catch(PDOException $e){
      throw new PDOException("Database connection error: " . $e->getMessage(), (int)$e->getCode());
    }
  }
}
