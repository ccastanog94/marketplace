<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a new product.
     *
     * Guarda un producto nuevo en la base de datos.
     *
     * @bodyParam name string required Nombre del producto. Example: Mouse RGB
     * @bodyParam description string Descripción del producto. Example: Mouse con luces RGB
     * @bodyParam price float required Precio del producto. Example: 29.99
     * @bodyParam stock integer required Stock disponible. Example: 10
     *
     * @response 201 {
     *   "id": 1,
     *   "name": "Mouse RGB",
     *   "description": "Mouse con luces RGB",
     *   "price": 29.99,
     *   "stock": 10,
     *   "created_at": "2025-05-15T04:44:42.000000Z",
     *   "updated_at": "2025-05-15T04:44:42.000000Z"
     * }
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }


    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return $product;
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
