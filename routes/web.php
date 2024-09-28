<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductsController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('welcome');
});


Route::get('/categorias', [ProductsController::class, 'getByCategories']);
Route::get('/produtos/categorias', [ProductsController::class, 'getBycategory']);
Route::get('/produtos/estoque-baixo', [ProductsController::class, 'getWithLowStock']);
Route::get('/produtos', [ProductsController::class, 'getAll']);
Route::get('/produtos/{idProduto}', [ProductsController::class, 'getById']);
