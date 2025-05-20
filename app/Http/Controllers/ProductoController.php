<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
        return Product::all();
    }
}
