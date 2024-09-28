<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function getAll()
    {
        $Listproducts = new Products();

        return $Listproducts->getAll();
    }

    public function getById($idProduct)
    {

        $IdproductsResearch = new Products();

        return $IdproductsResearch->getById($idProduct);

        // if($idProduct == NULL){
        //     return response()->json(['message' => 'Produto não encontrado'], 404);
        // }

        
    }

    public function getWithLowStock(){

        $stockProducts = new Products();

        return $stockProducts->getWithLowStock();
    }

    public function getByCategories(){

        $categoriesProduct = new Products();

        return $categoriesProduct->getByCategories();
    }

    public function getBycategory()
    {
        $categoryProduct = new Products();

        return $categoryProduct->getBycategory();
    }
}
