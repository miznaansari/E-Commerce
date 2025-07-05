<?php

namespace App\Http\Controllers;

use App\Models\RouteVisit;
use App\Models\Product;

use Illuminate\Http\Request;

class Homecontroller extends Controller
{
   public function index()
{
    // Debugging Step 1
    // logger()->info('Step 1: Start');

    // Fetch all records from RouteVisit
    $pagecount = RouteVisit::where('route','/')->first();

    // Debugging: Log the fetched data
    // logger()->info('Fetched Data:', $pagecount->toArray()); 

    // Debugging Step 2
    // logger()->info('Step 2: After fetching route');

    // Pass data to the view
     $products = Product::with('category')->get();
    $data = compact('pagecount','products');
    return view('index')->with($data);
}

}
