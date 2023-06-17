<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        // luam toate produsele din baza noastra de date
        $products = Product::all();

        // returnam un view numit index
        //products.index inseamna ca acest view se afla in directorul products pe calea resources/views/products
        // ['products' => $products] inseamna ca ii asignam variabilei products toate produsele pe care le-am obtinutt mai sus
        // daca voiam ca variabila sa se numeasca vasile scriam asa ['vasile' => $products]
        // apoi in view-ul index poti face foreach pe products @foreach ($products as $product) bla bla
        return view('products.index', ['products' => $products]);
    }
}
