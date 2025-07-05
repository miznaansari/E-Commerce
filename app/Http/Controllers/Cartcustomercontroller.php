<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartCustomerController extends Controller
{
    /**
     * Add a product to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
  public function addToCart(Request $request)
{
    $validatedData = $request->validate([
        'product_id' => 'required|exists:products,id',
        'color' => 'required|string', // Validate color
        'size' => 'required|string',  // Validate size
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($validatedData['product_id']);
    $customerId = Auth::id(); // Get the logged-in user's ID

    if (!$customerId) {
        return response()->json(['message' => 'You need to login first'], 400);
    }

    // Ensure a cart exists for the user, create one if not
    $cart = Cart::firstOrCreate(
        ['customer_id' => $customerId], // Check for cart by customer_id
        ['created_at' => now(), 'updated_at' => now()] // Provide default values
    );
 
    // Check if the product with the same color and size already exists in the cart
    $existingCartItem = CartItem::where('cart_id', $cart->id)
        ->where('product_id', $validatedData['product_id'])
        ->where('color', $validatedData['color'])
        ->where('size', $validatedData['size'])
        ->first();

    if ($existingCartItem) {
        return response()->json(['message' => 'This product is already in the cart with the selected color and size.'], 400);
    }

    // Add the new item to the cart
    CartItem::create([
        'cart_id' => $cart->id,
        'product_id' => $validatedData['product_id'],
        'color' => $validatedData['color'], // Store color
        'size' => $validatedData['size'],  // Store size
        'quantity' => $validatedData['quantity'],
        'price' => $product->price,
    ]);

    return response()->json(['message' => 'Product added to cart!'], 201);
}


    /**
     * Get all items in a cart.
     *
     * @param  int  $cartId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCartItems($cartId)
    {
        $cartItems = CartItem::where('cart_id', $cartId)->with('product')->get();

        return response()->json(['cart_items' => $cartItems], 200);
    }

    /**
     * Update the quantity or color of an item in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCartItem(Request $request, $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'sometimes|integer|min:1',
            'color' => 'sometimes|string',
        ]);

        $cartItem = CartItem::findOrFail($id);

        // Update only the fields provided
        $cartItem->update($validatedData);

        return response()->json(['message' => 'Cart item updated!'], 200);
    }

    /**
     * Remove an item from the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeCartItem($id)
    {
        $cartItem = CartItem::find($id);
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Item removed successfully']);
        }
        return response()->json(['message' => 'Item not found'], 404);
    }


    /**
     * Clear all items from the cart.
     *
     * @param  int  $cartId
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearCart($cartId)
    {
        CartItem::where('cart_id', $cartId)->delete();

        return response()->json(['message' => 'Cart cleared!'], 200);
    }

    public function getCartCount()
    {
        $customerId = Auth::id(); // Get the logged-in user's ID
          if ($customerId==null) {
            // If the same product with the same color and size exists, return a message
            return response()->json(['message' => 'You need to login first'], 400);
        }
        $cart = Cart::where('customer_id', $customerId)->first();

        if (!$cart) {
            return response()->json(['cartItems' => [], 'cartItemCount' => 0]);
        }

        $cartItems = CartItem::where('cart_id', $cart->id)->with('product')->get();
        $cartItemCount = $cartItems->sum('quantity');

        $cartItemsData = $cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'product_name' => $item->product->name,
                'product_price' => $item->price,
                'product_image' => asset( $item->product->thumbnail), // Generate full image URL
                'quantity' => $item->quantity,
                'color' => $item->color,
            ];
        });


        return response()->json(['cartItems' => $cartItemsData, 'cartItemCount' => $cartItemCount]);
    }
}
