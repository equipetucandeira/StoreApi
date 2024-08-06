<?php

namespace App\models;

use PDO;
use PDOException;

class UserModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function insertUser(string $name, string $email, string $password): string|bool
    {
        $stmt = $this->db->prepare("INSERT INTO user(name, email, password) VALUES (:name,:email,:password)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        return $this->db->lastInsertId() ?: null;

    }

    public function deleteUser(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM user WHERE (id = :id)");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function updateName(int $id, string $name)
    {
        $stmt = $this->db->prepare("UPDATE user SET name = :name WHERE(id = :id)");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->execute();

    }
    public function updateEmail(int $id, string $email)
    {
        $stmt = $this->db->prepare("UPDATE user SET email = :email WHERE(id = :id)");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    }

    public function updatePassword(int $id, string $password)
    {
        $stmt = $this->db->prepare("UPDATE user SET password = :password WHERE(id = :id)");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':password', $password);
        $stmt->execute();


    }
    public function getUserByEmail(string $email)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllUsers()
    {
        $stmt = $this->db->prepare("SELECT id,name,email FROM user");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
