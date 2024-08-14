<?php

namespace App\models;

use PDO;

class OrderModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function insertOrder(int $userID, float $cartTotalValue, string $date): string|bool
    {
        $stmt = $this->db->prepare("INSERT INTO orders(userID, totalprice, date) VALUES (:userid, :totalprice, :date)");
        $stmt->bindValue(':userid', $userID);
        $stmt->bindValue(':totalprice', $cartTotalValue);
        $stmt->bindValue(':date', $date);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function insertProductOrder(int $orderID, array $productList)
    {
        foreach($productList as $item) {
            $stmt = $this->db->prepare("INSERT INTO orderitens(order_ID,product_ID, price, item_Quantity)
        VALUES (:orderid, :productid,:price, :quantity)");

            $stmt->bindValue(':orderid', $orderID);
            $stmt->bindValue(':productid', $item['productID']);
            $stmt->bindValue(':price', $item['price']);
            $stmt->bindValue(':quantity', $item['quantity']);

            $stmt->execute();
        }
        return $this->db->lastInsertId();
    }

    public function getOrderID(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE orderID = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function getAllOrders()
    {
        $stmt = $this->db->prepare("
      SELECT orderID,user.name AS username,totalPrice,date FROM orders
      INNER JOIN user
      ON orders.userID = user.id");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrders(int $id)
    {
        $stmt = $this->db->prepare("
      SELECT orderID,user.name AS username,totalPrice,date FROM orders
      INNER JOIN user
      ON orders.userID = user.id
      WHERE userid = :id");
   $stmt->bindValue(':id', $id);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderItens($id)
    {
        $stmt = $this->db->prepare(
            "SELECT product_ID,name,item_Quantity,orderitens.price 
      FROM orderitens
      INNER JOIN product
      ON orderitens.product_ID = product.id
      WHERE orderitens.order_ID = :id
      "
        );
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




}
