<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
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
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);
        
        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }


    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Producto eliminado']);
    }
}
