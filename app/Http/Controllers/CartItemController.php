<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    //
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($cartItems);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1'
        ]);

        $item = CartItem::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->product_id],
            ['quantity' => \DB::raw("quantity + {$request->input('quantity', 1)}")]
        );

        return response()->json(['message' => 'Producto agregado al carrito']);
    }

    public function destroy($id)
    {
        $item = CartItem::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $item->delete();

        return response()->json(['message' => 'Producto eliminado del carrito']);
    }
}
