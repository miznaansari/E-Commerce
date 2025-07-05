<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems', 'customer')->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        // Base validation
        $request->validate([
            'order_number' => 'required|unique:orders',
            'customer_id' => 'required|exists:customerdetails,id',
            'total_price' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'status' => 'required|in:pending,processing,completed,cancelled,shipped',
            'payment_mode' => 'required|in:COD,POD,Credit Card,Debit Card,Online Payment',
            'shipping_address' => 'required|string',
            'shipping_method' => 'nullable|string',
            'tracking_number' => 'nullable|string',
            'estimated_delivery_date' => 'nullable|date',
            'order_items' => 'required|array|min:1', // Ensure order_items exist
            'order_items.*.product_id' => 'required|exists:products,id',
            'order_items.*.quantity' => 'required|integer|min:1',
            'order_items.*.price' => 'required|numeric|min:0',
        ]);
    
        $orderData = $request->only([
            'order_number',
            'customer_id',
            'total_price',
            'tax',
            'discount',
            'status',
            'payment_mode',
            'shipping_address',
            'shipping_method',
            'tracking_number',
            'estimated_delivery_date',
        ]);
    
        // Create the order
        $order = Order::create($orderData);
    
        // Add order items with dynamic features
        foreach ($request->order_items as $item) {
            $validatedItem = Validator::make($item, [
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'size' => 'required_if:product_id,' . $this->getProductIdForCategory('T-Shirt'), // Example size requirement
                'color' => 'nullable|string',
                'pattern' => 'nullable|string',
                'other_features' => 'nullable|array',
            ])->validate();
    
            $order->orderItems()->create([
                'product_id' => $validatedItem['product_id'],
                'quantity' => $validatedItem['quantity'],
                'price' => $validatedItem['price'],
                'meta_data' => json_encode([
                    'size' => $validatedItem['size'] ?? null,
                    'color' => $validatedItem['color'] ?? null,
                    'pattern' => $validatedItem['pattern'] ?? null,
                    'other_features' => $validatedItem['other_features'] ?? [],
                ]),
            ]);
        }
    
        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }
    
    // Helper to get product ID for a specific category
    private function getProductIdForCategory($categoryName)
    {
        return Product::where('category', $categoryName)->pluck('id')->first();
    }
    

    public function show($id)
    {
        $order = Order::with('orderItems', 'customer')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Update the order with new values from the request
        $order->update($request->only(['order_number', 'customer_id', 'total_price', 'tax', 'discount', 'status', 'payment_mode', 'shipping_address', 'shipping_method', 'tracking_number', 'estimated_delivery_date']));

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    public function destroy($id)
    {
        Order::destroy($id);
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}
