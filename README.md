# ProjetoFinal-Framework

Essa API REST foi criada com o objetivo acadêmico para desenvolviemnto de uma loja.

## GET /user/fetch
* Descrição: Recupera informações de usuários.
* Controller: UserController
* Método: fetch
* Parâmetros Corpo: Nenhum
* Parâmetros Header (para fins de autenticação do admin):
  ```bash
   USER-ID: 1
* Sucesso:
  * Status 200: Sucesso ao recuperar os dados dos usuários.
  * Exemplo:
    ```json
    {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    }
    ```

## GET /product/fetch
* Descrição: Recupera informações dos produtos.
* Controller: ProductController
* Método: fetch
* Parâmetros Corpo: Nenhum
* Parâmetros Header (para fins de autenticação do admin):
  ```bash
   USER-ID: 1
* Sucesso:
  * Status 200: Sucesso ao recuperar os dados dos produtos.
  * Exemplo:
    ```json
    {
      "id": 1,
      "sku": "ss013",
      "name": "Shampoo",
      "description": "Shampoo ultra eficaz...",
      "images":[
        "image1": "/public/images/*",
        "image2": "/public/images/*",
        "image3": "/public/images/*",
      ]
      "price": 25,
    }
    ```

## GET /order/fetch
* Descrição: Recupera informações dos pedidos.
* Controller: OrderController
* Método: fetch
* Parâmetros Corpo: Nenhum
* Sucesso:
  * Status 200: Sucesso ao recuperar os dados dos pedidos.
  * Exemplo:
    ```json
    {
      "id": 1,
      "clientId": 2,
      "clientName": "John Doe",
      "totalprice": 125.0
      "items": [
        {
          "id": 1,
          "itemName": "shampo",
          "quantity":3,
          "price": 25.0,
        },
       {
          "id": 4,
          "itemName": "water",
          "quantity": 10,
          "price": 5.0,
        },
      ],
    }
    ```
## POST /user/create
* Descrição: Cria um usuário no banco de dados
* Controller: UserController
* Método: create
* Parâmetros Corpo:
  ```json
  {
    "name": "John Doe",
    "email": "john@ezxample.com",
    "password": "trustnoone",
  }
  ```
* Sucesso:
  * Status 201: Sucesso ao criar o usuário

## POST /product/create
* Descrição: Cria um produto no banco de dados
* Controller: ProductController
* Método: create
* Parâmetros Corpo(utilize um multipart/FormData):
     ```json
    {
      "sku": "ss013",
      "name": "Shampoo",
      "description": "Shampoo ultra eficaz...",
      "price": 25
    }
    {
    files: {
     "image1": file...,
     "image2": file...,
     "image3": file...,
     }
    }
    ```
* Parâmetros Header (para fins de autenticação do admin):
  ```bash
   USER-ID: 1
* Sucesso:
  * Status 201: Sucesso ao criar o produto

## POST /order/create
* Descrição: Cria um pedido no banco de dados, interage com 2 tabelas
* Controller: OrderController
* Método: create
* Parâmetros Corpo:
  ```json
   {
    "userID":13,
    "datetime": "2024-07-24 13:23:44",
    "cartItens": [
        {
        "productID": 3,
        "quantity":2,
        "price": 123.12
        },
        {
        "productID": 2,
        "quantity":1,
        "price": 13.00
        }
    ]
  }
  ```
* Sucesso:
  * Status 201: Sucesso ao criar o pedido

## POST /user/login
* Descrição: Verifica as credenciais do usuário no banco de dados e retorna seu id
* Controller: UserController
* Método: login
* Parâmetros Corpo:
  ```json
  {
    "email": "john@example.com",
    "password": "trustnoone",
  }
  ```
* Sucesso:
  * Status 200: Sucesso ao logar com as credenciais
   ```bash
    "HTTP_USER_ID": 13

## PUT /user/update/name
* Descrição: Atualiza o nome do usuário
* Controller: UserController
* Método: updateName
* Parâmetros Corpo:
  ```json
  {
    "userID" : 13,
    "email": "john@example.com",
    "password": "trustnoone",
    "newName": "John Don"
  }
  ```
* Sucesso:
  * Status 200: Sucesso ao atualizar o nome

## PUT /user/update/email
* Descrição: Atualiza o email do usuário
* Controller: UserController
* Método: updateEmail
* Parâmetros Corpo:
  ```json
  {
    "userID" : 13,
    "email": "john@example.com",
    "password": "trustnoone",
    "newEmail": "John Don"
  }
  ```
* Sucesso:
  * Status 200: Sucesso ao atualizar o email

## PUT /user/update/password
* Descrição: Atualiza a senha do usuário
* Controller: UserController
* Método: updateEmail
* Parâmetros Corpo:
  ```json
  {
    "userID" : 13,
    "email": "john@example.com",
    "password": "trustnoone",
    "newPassword": "TrustReallyNoOne"
  }
  ```
* Sucesso:
  * Status 200: Sucesso ao atualizar o email

## PUT /product/update/name
* Descrição: Atualiza o nome do produto
* Controller: ProductController
* Método: updateName
* Parâmetros Corpo:
  ```json
  {
    "userId" : 13,
    "productId": 2,
    "NewName": "Xampu"
  }
  ```
* Sucesso:
  * Status 200: Sucesso ao atualizar o nome do produto

## PUT /product/update/sku
* Descrição: Atualiza o sku do produto
* Controller: ProductController
* Método: updateSku
* Parâmetros Corpo:
  ```json
  {
    "userId" : 13,
    "productId": 2,
    "NewSku": "ss102"
  }
  ```
* Sucesso:
  * Status 200: Sucesso ao atualizar o sku do produto

## PUT /product/update/price
* Descrição: Atualiza o preço do produto
* Controller: ProductController
* Método: updateSku
* Parâmetros Corpo:
  ```json
  {
    "userId" : 13,
    "productId": 2,
    "NewPrice": 30
  }
  ```
* Sucesso:
  * Status 200: Sucesso ao atualizar o preço do produto

## PUT /product/update/description
* Descrição: Atualiza a descrição do produto
* Controller: ProductController
* Método: updateDescription
* Parâmetros Corpo:
  ```json
  {
    "userId" : 13,
    "productId": 2,
    "NewDescription": "Shampoo sensacional..."
  }
  ```
* Sucesso:
  * Status 200: Sucesso ao atualizar o preço do produto

## PUT /product/update/images
* Descrição: Atualiza as imagens do produto
* Controller: ProductController
* Método: updateImages
* Parâmetros Corpo:
  * Arquivo de imagem em formato .png .jpeg ou .jpg (no máximo 3 imagens)
  ```json
  {
    "userId" : 13,
    "productId": 2,
  }
  ```
* Sucesso:
  * Status 200: Sucesso ao atualizar as imagens do produto

