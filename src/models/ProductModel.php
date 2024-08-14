<?php

namespace App\models;

use PDO;

class ProductModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function insertProduct(string $name, STRING $sku, string $description, string $image, float $price)
    {

        $stmt = $this->db->prepare("INSERT INTO product(name, sku, description,image, price) VALUES (:name,:sku,:description,:image,:price)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':sku', $sku);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':image', $image);
        $stmt->execute();
        return $this->db->lastInsertId() ?: null;


    }

    public function updateProduct(int $id, string $name, STRING $sku, string $description, string $image, float $price)
    {
        $stmt = $this->db->prepare("UPDATE product SET
      name = :name, 
      sku = :sku, 
      description = :description, 
      image = :image,
      price = :price 
      WHERE id = :id");

        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':sku', $sku);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue('id', $id);
        $stmt->execute();


    }

    public function getProduct(int $id)
    {
        $stmt =  $this->db->prepare("SELECT * from product WHERE id=:id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function deleteProduct(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM product WHERE (id = :id)");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function updateName(int $id, string $name)
    {
        $stmt = $this->db->prepare("UPDATE product SET name = :name WHERE(id = :productId)");
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":productId", $id);
        $stmt->execute();
    }
    public function updatePrice(int $id, float $price)
    {
        $stmt = $this->db->prepare("UPDATE product SET price = :price WHERE(id = :productId)");
        $stmt->bindValue(":price", $price);
        $stmt->bindValue(":productId", $id);
        $stmt->execute();
    }
    public function updateSku(int $id, string $sku)
    {
        $stmt = $this->db->prepare("UPDATE product SET sku = :sku WHERE(id = :productId)");
        $stmt->bindValue(":sku", $sku);
        $stmt->bindValue(":productId", $id);
        $stmt->execute();
    }
    public function updateDescription(int $id, string $description)
    {
        $stmt = $this->db->prepare("UPDATE product SET description = :description WHERE(id = :productId)");
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":productId", $id);
        $stmt->execute();
    }
    public function InsertImage(string $imageId, string $imagePath, int $productId)
    {
        $stmt = $this->db->prepare("UPDATE product SET {$imageId} = :imagePath WHERE(id = :productId)");
        $stmt->bindValue(":imagePath", $imagePath);
        $stmt->bindValue(":productId", $productId);
        $stmt->execute();

    }
    public function getProductById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * from product WHERE(id = :id)");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }

    public function getProductBySku(string $sku)
    {
        $stmt = $this->db->prepare("SELECT * from product WHERE(sku = :sku)");
        $stmt->bindValue(":sku", $sku);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllProducts()
    {
        $stmt =  $this->db->prepare("SELECT * from product");
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
