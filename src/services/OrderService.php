<?php

namespace App\services;

use App\models\OrderModel;
use App\utils\Validator;
use Http\services\Response;
use Exception;

class OrderService
{
    private OrderModel $orderModel;
    public function __construct(OrderModel $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    public function createOrder(array $data)
    {
        $userID = $data['userID'];
        $productList = $data['cartItens'];
        $date = $data['datetime'];
        $cartTotalValue = $data['cartTotalValue'];
        $orderID = $this->orderModel->insertOrder($userID, $cartTotalValue, $date);
        $this->orderModel->insertProductOrder($orderID, $productList);

    }

    public function fetchOrdersWithItens()
    {
        try {
            $orders = $this->orderModel->getAllOrders();
           foreach ($orders as &$order) {
                $order["itens"] = $this->orderModel->getOrderItens($order["orderID"]);
         }
            return $orders;
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
  }

 public function fetchOrdersWithItensByUser(int $auth)
    {
    try {
            $orders = $this->orderModel->getOrders($auth);
           foreach ($orders as &$order) {
                $order["itens"] = $this->orderModel->getOrderItens($order["orderID"]);
            }
            return $orders;
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
