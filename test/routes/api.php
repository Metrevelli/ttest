<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var \Illuminate\Routing\Router $router */


$router->post('register',[AuthController::class,'register']);
$router->post('login',[AuthController::class,'login']);


$router->group(['middleware' => 'auth:sanctum'], static function (Router $router) {
    $router->post('logout',[AuthController::class,'logout']);

    $router->get('/getUserCart', [\App\Http\Controllers\CartProductsController::class, 'index']);
    $router->post('/addProductInCart/{product_id}',[\App\Http\Controllers\CartProductsController::class, 'store']);
    $router->delete('/removeProductFromCart/{product_id}',[\App\Http\Controllers\CartProductsController::class, 'delete']);
    $router->put('/setCartProductQuantity/{product_id}/{quantity}',[\App\Http\Controllers\CartProductsController::class, 'setCartProductQuantity']);
});

