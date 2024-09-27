<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/produtos/categorias/{filtroEstoque}', [ProductsController::class, 'getByCategory']);
Route::get('/produtos/estoque-baixo', [ProductsController::class, 'getWithLowStock']);
Route::get('/produtos', [ProductsController::class, 'getAll']);
Route::get('/produtos/{idProduto}', [ProductsController::class, 'getById']);
