<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.product')->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $user = $request->user();
    
        $cartItems = $user->cartItems()->with('product')->get();
    
        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Tu carrito está vacío.'], 400);
        }
    
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
        ]);
    
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }
    
        // Opcional: vaciar carrito después de crear orden
        $user->cartItems()->delete();
    
        return response()->json([
            'message' => 'Orden creada exitosamente',
            'order_id' => $order->id,
            'total' => $total
        ]);
    }
    
}
