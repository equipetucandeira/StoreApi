<?php

namespace App\controllers;

use App\services\ProductService;
use App\models\ProductModel;
use Exception;
use Http\services\Request;
use Http\services\Response;
use App\factory\DatabaseFactory;
use PDO;

class ProductController
{
    private ProductModel $productModel;
    private ProductService $productService;
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseFactory::createPDO();
        $this->productModel = new ProductModel($this->pdo);
        $this->productService = new ProductService($this->productModel);
    }

    public function create(): void
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
            $this->productService->createProduct($body);
            Response::success(201, "Product Created Successfully");

        } catch(Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }

  }


 public function show(): void
    {
        try {
            $queryString = Request::getQueryString();
            parse_str($queryString, $params);
            $productId = $params['id'] ?? null;
            if (is_null($productId)) {
                Response::error(400, "Product ID is required", "QUERY", 1);
                return;
            }

            $product = $this->productService->getProductById($productId);

            if (!$product) {
                Response::error(404, "Product not found", "PRODUCT", 1);
                return;
            }

            Response::json($product);

        } catch (\Exception $e) {
            Response::error(500, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    public function updateName(): void
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
            $this->productService->updateProductName($body);
            Response::success(200, "Name updated Successfully");
        } catch (\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
    public function updateSku(): void
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
            $this->productService->updateProductSku($body);
            Response::success(200, "Sku updated Successfully");
        } catch (\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }
    public function updateDescription(): void
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
            $this->productService->updateProductDescription($body);
            Response::success(200, "Description updated Successfully");
        } catch (\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    public function updatePrice(): void
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
            $this->productService->updateProductPrice($body);
            Response::success(200, "Price updated Successfully");
        } catch (\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    public function updateImage(): void
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
            $this->productService->updateProductImage($body);
            Response::success(200, "Image updated Successfully");
        } catch (\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    public function fetch(): void
    {
        try {
            $products = $this->productService->fetchProducts();
            Response::json($products, 200);
        } catch (\Exception $e) {
            Response::error(500, $e->getMessage(), $e->getFile(), $e->getLine());
        }
  }

  public function update():void{
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
            $this->productService->updateProduct($body);
            Response::success(201, "Product Updated Successfully");

        } catch(Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
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
            $this->productService->deleteProduct($body['id']);
            Response::success(200, "Product deleted Successfully");
        } catch (\Exception $e) {
            Response::error(400, $e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

}
