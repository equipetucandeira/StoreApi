<?php

namespace App\controllers;

use App\services\UserService;
use App\models\UserModel;
use Exception;
use Http\services\Request;
use Http\services\Response;
use App\factory\DatabaseFactory;
use PDO;

class UserController
{
    private UserModel $userModel;
    private UserService $userService;
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseFactory::createPDO();
        $this->userModel = new UserModel($this->pdo);
        $this->userService = new UserService($this->userModel);
    }

    public function create(): void
    {
        try {
            $body = Request::getBody();
            $this->userService->createUser($body);
            Response::success(201, "User Created Successfully");

        } catch(Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }

    }
    public function login(): void
    {
        try {
            $body = Request::getBody();
            $userId = $this->userService->login($body);
            header('HTTP_USER_ID:' . $userId);
            Response::success(200, "User Logged successfully");

        } catch (\Exception $e) {
            Response::error(401, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
    public function updateName(): void
    {
        try {
            if(Request::getAuth() == null) {
                Response::error(401, "No Authorization Header Provided", "HEADER", 1);
                return;
            }
            $body = Request::getBody();
            $this->userService->updateUserName($body);
            Response::success(200, "Name updated Successfully");
        } catch (\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
    public function updateEmail(): void
    {
        try {
            if(Request::getAuth() == null) {
                Response::error(401, "No Authorization Header Provided", "HEADER", 1);
                return;
            }
            $body = Request::getBody();
            $this->userService->updateUserEmail($body);
            Response::success(200, "Email updated Successfully");
        } catch (\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
    public function updatePassword(): void
    {
        try {
            if(Request::getAuth() == null) {
                Response::error(401, "No Authorization Header Provided", "HEADER", 1);
                return;
            }
            $body = Request::getBody();
            $this->userService->updateUserPassword($body);
            Response::success(200, "Password updated Successfully");
        } catch (\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    public function fetch(): void
    {
        try {
            $auth = Request::getAuth();
            if(!isset($auth)) {
                Response::error(401, "No Authorization Header Provided", "HEADER", 1);
                return;
            }
            if($auth != 1) {
                Response::error(403, "Invalid Authorization Header for this route", "HEADER", 1);
                return;
            }
            $users = $this->userService->fetchUsers();
            Response::json($users, 200);
        } catch (\Exception $e) {
            Response::error(500, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    public function delete(): void
    {
        try {
            $auth = Request::getAuth();
            if(!isset($auth)) {
                Response::error(401, "No Authorization Header Provided", "HEADER", 1);
                return;
            }
            if($auth != 1) {
                Response::error(403, "Invalid Authorization Header for this route", "HEADER", 1);
                return;
            }
            $body = Request::getBody();
            $this->userService->deleteUser($body['id']);
            Response::success(200, "User");
        } catch (\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

}
