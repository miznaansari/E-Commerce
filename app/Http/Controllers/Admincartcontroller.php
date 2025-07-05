<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admincartcontroller extends Controller
{
    public function index(){
       // $cartsWithDetails = CartItem::with(['cart.customer'])->get();

       // Fetch all cart items with their cart and customer details
       $cartsWithDetails = CartItem::with(['product'])->get();

       // Group cart items by `cart_id` and transform the result
       $result = $cartsWithDetails->groupBy('cart_id')->map(function ($items) {
           $firstCart = $items->first(); // Get the first item for cart/customer info
           return [
               'cart_id' => $firstCart->cart_id,
               'customer' => [
               'profile_picture' => $firstCart->cart->customer->profile_picture,

                   'first_name' => $firstCart->cart->customer->first_name,
                   'last_name' => $firstCart->cart->customer->last_name,
                   'email' => $firstCart->cart->customer->email,
               ],
               'items' => $items->map(function ($item) {
// echo"<pre>";
// print_r($item->toArray());
                   return [
                       'product_name' => $item->product->name,
                       'product_img' => $item->product->thumbnail,
                       'color' => $item->color,
                       'size' => $item->size,
                       'quantity' => $item->quantity,
                       'price' => $item->price,
                   ];
               })->toArray(), // Ensure items are an array
           ];
       })->values()->toArray();
       
       // Output the simplified result
       
   
            //   dd($result);


        //echo"<pre>";
      //  print_r($result);
        $data = compact('result');
        return view('Admin.Customeraddcart')->with($data);
    }
}
