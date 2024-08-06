<?php


namespace App\controllers;

use Http\services\Response;


class HomeController{

  public function index(){
  return Response::success(200, "Hello, sucess retrieving");
  }
}
