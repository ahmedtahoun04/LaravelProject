<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show checkout page.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                             ->with('error', 'Your cart is empty!');
        }

        $total = array_sum(
            array_map(fn($item) => $item['price'] * $item['quantity'], $cart)
        );

        return view('checkout', compact('cart', 'total'));
    }

    /**
     * Place the order.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string',
            'city'           => 'required|string',
            'payment_method' => 'required|in:cash,card',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                             ->with('error', 'Your cart is empty!');
        }

        // Calculate total
        $total = array_sum(
            array_map(fn($item) => $item['price'] * $item['quantity'], $cart)
        );

        // Create order
        $order = Order::create([
            'user_id'        => Auth::id(),
            'status'         => 'pending',
            'total'          => $total,
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'city'           => $request->city,
            'payment_method' => $request->payment_method,
            'notes'          => $request->notes,
        ]);

        // Create order items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'title'      => $item['title'],
                'price'      => $item['price'],
                'quantity'   => $item['quantity'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Order placed successfully!');
    }

    /**
     * Show all orders for the logged in user.
     */
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->latest()
                       ->get();

        return view('my-orders', compact('orders'));
    }

    /**
     * Show a single order.
     */
    public function show($id)
    {
        $order = Order::with('items')
                      ->where('user_id', Auth::id())
                      ->findOrFail($id);

        return view('order-details', compact('order'));
    }
}