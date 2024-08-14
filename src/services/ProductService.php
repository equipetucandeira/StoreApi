<?php

namespace App\services;

use App\models\ProductModel;
use App\utils\Validator;
use Exception;

class ProductService
{
    private ProductModel $productModel;

    public function __construct(ProductModel $productModel)
    {
        $this->productModel = $productModel;
    }

    public function skuExists(string $productSku): bool | array
    {
        return $this->productModel->getProductBySku($productSku) ?? false;
    }

    private function handleImageUpload($images)
    {
        $uploadDir = realpath(__DIR__.'/../../public/images').'/';
        $uploadedImages = [];
        foreach ($images as $key => $image) {
            if(is_uploaded_file($image['tmp_name'])) {
                $destinationPath = $uploadDir . basename($image['name']);
                if (move_uploaded_file($image['tmp_name'], $destinationPath)) {
                    $uploadedImages[$key] = str_replace("/var/www/html/", "", $destinationPath, );
                } else {
                    throw new \Exception("Failed to upload image: $key");
                }
            }
        }
        return $uploadedImages;
    }
    public function createProduct(array $data)
    {
        try {
            if($data == []) {
                throw new \Exception("No data found");
            }
            $data["name"] = trim($data["name"]);
            $data["description"] = trim($data["description"]);
            $data["price"] = floatval(trim($data["price"]));
            $data["sku"] = trim($data["sku"]);
            $uploadedImages = $data["files"];
            if($this->skuExists($data['sku']) !== false) {
                throw new \Exception("Product SKU Already Exists");
            }

            Validator::validateStringSize($data["name"], 3, 50);
            Validator::validateStringSize($data["description"], 10, 200);
            Validator::validateStringSize($data["sku"], 1, 5);

            if($data["price"] <= 0) {
                throw new \Exception("Product Price invalid");
            }


            $images = $this->handleImageUpload($uploadedImages);
            $id = $this->productModel->insertProduct(
                $data['name'],
                $data['sku'],
                $data['description'],
                $images["image1"],
                $data['price']
            );

            if(isset($images["image2"])) {
                Validator::validateStringSize($images["image2"], 1, 40);
                $this->productModel->InsertImage("image2", $images["image2"], $id);
            }
            if(isset($images["image3"])) {
                Validator::validateStringSize($images["image3"], 1, 40);
                 $this->productModel->InsertImage("image3", $images["image3"], $id);
                return $id;
            }

        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
  }

    public function getProductById(int $id){
    try {
            return $this->productModel->getProduct($id);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

    public function updateProduct(array $data)
    {
        try {
            if($data == []) {
                throw new \Exception("No data found");
      }
            $data["name"] = trim($data["name"]);
            $data["description"] = trim($data["description"]);
            $data["price"] = floatval(trim($data["price"]));
            $data["sku"] = trim($data["sku"]);
            $uploadedImages = $data["files"];

            Validator::validateStringSize($data["name"], 3, 50);
            Validator::validateStringSize($data["description"], 10, 200);
            Validator::validateStringSize($data["sku"], 1, 5);

            if($data["price"] <= 0) {
                throw new \Exception("Product Price invalid");
            }


            $images = $this->handleImageUpload($uploadedImages);
      $id = $this->productModel->updateProduct(
                $data['id'],
                $data['name'],
                $data['sku'],
                $data['description'],
                $data['price']
      );
            
            if(isset($images["image1"])) {
                Validator::validateStringSize($images["image1"], 1, 40);
                $this->productModel->InsertImage("image", $images["image1"], $id);
            }

            if(isset($images["image2"])) {
                Validator::validateStringSize($images["image2"], 1, 40);
                $this->productModel->InsertImage("image2", $images["image2"], $id);
            }
            if(isset($images["image3"])) {
                Validator::validateStringSize($images["image3"], 1, 40);
                $this->productModel->InsertImage("image3", $images["image3"], $id);
                return $id;
            }

        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }


    public function fetchProducts()
    {
        try {
            return $this->productModel->getAllProducts();
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateProductName(array $data)
    {
        try {
            if($data == []) {
                throw new \Exception("No data found");
            }
            $this->productExists($data["productId"]);
            Validator::validateStringSize($data['productNewName'], 3, 60);
            $this->productModel->updateName($data['productId'], $data['productNewName']);

        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateProductSku(array $data)
    {
        try {
            if($data == []) {
                throw new \Exception("No data found");
            }

            $this->productExists($data["productId"]);

            Validator::validateStringSize($data['productNewSku'], 1, 5);
            if($this->skuExists($data["productNewSku"])) {
                throw new Exception("Product sku already exists");
            }
            $this->productModel->updateSku($data['productId'], $data['productNewSku']);

        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateProductDescription(array $data)
    {
        try {
            if($data == []) {
                throw new \Exception("No data found");
            }

            $this->productExists($data["productId"]);

            Validator::validateStringSize($data['productNewDescription'], 30, 200);
            $this->productModel->updateDescription($data['productId'], $data['productNewDescription']);

        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function updateProductImage(array $data)
    {
        try {
            if($data == []) {
                throw new \Exception("No data found");
            }

            $this->productExists($data["productId"]);

            if(isset($data["images"]["image1"])) {
                Validator::validateStringSize($data["images"]["image1"], 1, 40);
                $this->productModel->InsertImage("image", $data["images"]["image1"], $data["productId"]);
            }

            if(isset($data["images"]["image2"])) {
                Validator::validateStringSize($data["images"]["image2"], 1, 40);
                $this->productModel->InsertImage("image2", $data["images"]["image2"], $data["productId"]);
            }
            if(isset($data["images"]["image3"])) {
                Validator::validateStringSize($data["images"]["image3"], 1, 40);
                $this->productModel->InsertImage("image3", $data["images"]["image3"], $data["productId"]);
            }

        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function updateProductPrice(array $data)
    {
        try {
            if($data == []) {
                throw new \Exception("No data found");
            }

            $this->productExists($data["productId"]);
            if($data["productNewPrice"] <= 0) {
                throw new \Exception("Product Price invalid");
            }
            $this->productModel->updatePrice($data['productId'], $data['productNewPrice']);

        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function productExists(int $id)
    {
        $product = $this->productModel->getProductById($id);
        if(!$product) {
            throw new Exception("Product not found");
        }

    }

    public function deleteProduct(int $id)
    {
        try {
            if(!$this->productModel->getProductById($id)) {
                throw new Exception("Product not found");
            }
            $this->productModel->deleteProduct($id);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
