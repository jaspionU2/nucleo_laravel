<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\select;

class Products extends Model
{
    use HasFactory;

    private $products;
    private $productsStockFilter;


    public function __construct()
    {
        $this->products = [
            [
                "id" => 1,
                "nome" => "ryzen 5 5500",
                "preco" => 700.00,
                "categorias" => ["eletrônicos", "hardware"],
                "estoque" => 21
            ],
            [
                "id" => 2,
                "nome" => "rtx 2060",
                "preco" => 2500.99,
                "categorias" => ["eletrônicos", "hardware"],
                "estoque" => 16
            ],
            [
                "id" => 3,
                "nome" => "m800 deluxe",
                "preco" => 160.00,
                "categorias" => "perifericos",
                "estoque" => 16
            ],
            [
                "id" => 4,
                "nome" => "e-yooo mini",
                "preco" => 253.00,
                "categorias" => "perifericos",
                "estoque" => 7
            ],
            [
                "id" => 5,
                "nome" => "fita led rgb",
                "preco" => 35.00,
                "categorias" => "decoração",
                "estoque" => 30
            ],
            [
                "id" => 6,
                "nome" => "samsumg s23",
                "preco" => 3500.99,
                "categorias" => "celular",
                "estoque" => 30,
            ]
        ];

        $this->productsStockFilter = request()->get("filtroEstoque");
    }

    public function getAll()
    {
        $ListaDeProdutos = collect($this->products)->map(function ($product) {
            return collect($product)->except(['id', 'estoque']);
        });

        return $ListaDeProdutos;
    }

    public function getById($idProduct)
    {

        $idProduct = collect($this->products)->firstWhere('id', $idProduct);

        if ($idProduct == NULL) {
            return collect(['message' => 'Produto não encontrado']);
        }

        return $idProduct;
    }

    public function getWithLowStock()
    {

        return collect($this->products)->where('estoque', '<', 20);
    }

    public function getByCategories()
    {
        return collect($this->products)->pluck('categorias')->flatten()->unique()->values()->toArray();
    }

    public function getBycategory()
    {

       
        if ($this->productsStockFilter == NULL) 
        {
            $groupCategory = collect($this->products)->groupBy("categorias", preserveKeys: false);

            return $groupCategory;
        }


        $filtredCategoryGroup = collect($this->products)->filter(function ($product) {
            
            if (isset($product['categorias'])) {
            
                if (is_array($product['categorias'])) {
                    return in_array($this->productsStockFilter, $product['categorias']);
                }

                return $product['categorias'] === $this->productsStockFilter;
            }

          
            return false;
        });

        if ($filtredCategoryGroup->isEmpty()) {
            return false;
        }

        return $filtredCategoryGroup;

    }
}
