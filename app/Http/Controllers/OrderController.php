<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $items = $order->items()->with('product')->get();
        return view('orders.show', compact('order', 'items'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {
            $cart = Auth::user()->cart()->with('items.product')->firstOrFail();

            if ($cart->items()->count() === 0) {
                return back()->with('error', 'Keranjang kosong');
            }

            // Calculate totals
            $subtotal = 0;
            foreach ($cart->items as $item) {
                $subtotal += $item->getSubtotal();
            }

            $shippingCost = 10000; // Fixed shipping cost
            $total = $subtotal + $shippingCost;

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . time(),
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'discount' => 0,
                'total' => $total,
                'shipping_address' => $request->shipping_address,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->getSubtotal(),
                ]);

                // Update product quantity
                $item->product->decrement('quantity', $item->quantity);
                $item->product->increment('quantity_sold', $item->quantity);
            }

            // Clear cart
            $cart->items()->delete();

            return redirect()->route('orders.payment', $order)->with('success', 'Pesanan dibuat, silakan lakukan pembayaran');
        });
    }

    public function payment(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.payment', compact('order'));
    }
}
