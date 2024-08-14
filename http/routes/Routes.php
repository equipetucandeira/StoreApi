<?php
namespace Http\routes;

use Http\routes\Router;

Router::get('/', 'HomeController', 'index');
Router::get('/user/fetch', 'UserController', 'fetch');
Router::get('/product/fetch', 'ProductController', 'fetch');
Router::get('/order/fetchByUser', 'OrderController', 'fetchByUser');
Router::get('/order/fetch', 'OrderController', 'fetch');
Router::post('/user/create', 'UserController', 'create');
Router::post('/user/login', 'UserController', 'login');
Router::post('/product/create', 'ProductController', 'create');
Router::post('/order/create', 'OrderController', 'createOrder');

Router::put('/user/update/name', 'UserController', 'updateName');
Router::put('/user/update/email', 'UserController', 'updateEmail');
Router::put('/product/update/name', 'ProductController', 'updateName');
Router::put('/product/update/sku', 'ProductController', 'updateSku');
Router::put('/product/update/description', 'ProductController', 'updateDescription');
Router::put('/product/update/price', 'ProductController', 'updatePrice');
Router::put('/product/update/image', 'ProductController', 'updateImage');


Router::delete('/user/delete', 'UserController', 'delete');
Router::delete('/product/delete', 'ProductController', 'delete');
Router::delete('/order/delete', 'OrderController', 'delete');
