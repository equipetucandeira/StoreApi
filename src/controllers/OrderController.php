<?php

namespace App\controllers;

use App\models\OrderModel;
use App\models\ProductModel;
use App\models\UserModel;
use App\services\OrderService;
use App\factory\DatabaseFactory;
use App\services\ProductService;
use App\services\UserService;
use PDO;
use Http\services\Request;
use Http\services\Response;

class OrderController
{
    private OrderModel $orderModel;
    private OrderService $orderService;
    private UserService $userService;
    private ProductService $productService;
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseFactory::createPDO();
        $this->orderService = new OrderService(new OrderModel($this->pdo));
        $this->productService = new ProductService(new ProductModel($this->pdo));
        $this->userService = new UserService(new UserModel($this->pdo));
    }


    public function createOrder()
    {
        try {
            if(Request::getAuth() == null) {
                Response::error(401, "No Authorization Header Provided", "HEADER", 1);
                return;
            }
            $body = Request::getBody();
            $cartTotalValue = 0;

            foreach($body['cartItens'] as $item) {
                $this->productService->productExists($item['productID']);
                $cartTotalValue += $item['price'] * $item['quantity'];
            }
            $body['cartTotalValue'] = $cartTotalValue;
            $this->orderService->createOrder($body);
        } catch(\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }


    public function fetch()
    {
        try {
            $auth = Request::getAuth();
            if(!isset($auth)) {
                Response::error(401, "No Authorization Header Provided", "HEADER", 1);
            }
            if($auth = ! 1) {
                Response::error(403, "Invalid Authorization Header for this route", "HEADER", 1);
                return;
            }

            $orders = $this->orderService->fetchOrdersWithItens();
            return Response::json($orders, 200);
        } catch(\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
  }

public function fetchByUser()
    {
        try {
            $auth = Request::getAuth();
            if(!isset($auth)) {
                Response::error(401, "No Authorization Header Provided", "HEADER", 1);
      }
            
            $orders = $this->orderService->fetchOrdersWithItensByUser($auth);
            return Response::json($orders, 200);
        } catch(\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
  }




}
