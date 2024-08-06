<?php

namespace App\services;

use App\models\UserModel;
use App\utils\Validator;
use Exception;

class UserService
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function userExists(string $userEmail): bool | array
    {
        return $this->userModel->getUserByEmail($userEmail);
    }

    public function createUser(array $data)
    {
        try {
            if(!isset($data)) {
                throw new Exception("No data found");
            }
            $data["name"] = trim($data["name"]);
            $data["email"] = filter_var(trim($data["email"]), FILTER_SANITIZE_EMAIL);
            $data["password"] = trim($data["password"]);

            Validator::validateEmail($data["email"]);

            if($this->userExists($data['email']) !== false) {
                throw new \Exception("User Already Exists");
            }

            Validator::validateStringSize($data["name"], 3, 30);
            Validator::validateStringSize($data["password"], 6, 60);

            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

            return $this->userModel->insertUser($data['name'], $data['email'], $data['password']);

        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function login(array $data)
    {
        try {
            $email = filter_var(trim($data["email"]), FILTER_SANITIZE_EMAIL);
            $password = trim($data["password"]);

            if($this->userExists($email) == false) {
                throw new \Exception("User not found");
            }
            $user = $this->userModel->getUserByEmail($email);

            if (!password_verify($password, $user['password'])) {
                throw new \Exception("Invalid credentials");
            }
            return $user["id"];


        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function fetchUsers()
    {
    try {
        
            return $this->userModel->getAllUsers();
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateUserName(array $data)
    {
        try {
            $user = $this->userModel->getUserByEmail($data["userEmail"]);
            Validator::validateStringSize($data['userNewName'], 3, 60);
            $this->userModel->updateName($user['id'], $data['userNewName']);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateUserPassword(array $data)
    {
        try {
            $user = $this->userModel->getUserByEmail($data["userEmail"]);
            if(!$user) {
                throw new Exception("User not found");

            }
            $userPassword = password_verify($data['actualPassword'], $user['password']);

            if(!$userPassword) {
                throw new Exception("Actual Password didn't match");
            }

            Validator::validateStringSize($data['newPassword'], 3, 60);
            $data['newPassword'] = password_hash($data['newPassword'], PASSWORD_BCRYPT);
            $this->userModel->updatePassword($user['id'], $data['newPassword']);


        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateUserEmail(array $data)
    {
        try {
            $user = $this->userModel->getUserByEmail($data["userEmail"]);

            Validator::validateEmail($data['newEmail']);

            $this->userModel->updateEmail($user['id'], $data['newEmail']);


        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteUser(int $id)
    {
        try {
            $this->userModel->deleteUser($id);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
