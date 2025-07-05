<?php

use App\Http\Controllers\Admincartcontroller;
use App\Http\Controllers\CartCustomerController;
use App\Http\Controllers\Customercontroller;
use App\Http\Controllers\Homecontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RephraseController;
use App\Http\Controllers\FirebaseNotificationController;

//models
use App\Models\Order;  // Assuming you have an Order model
use App\Models\Product; // Assuming you have a Product model
use App\Models\Category; // Assuming you have a Category model
use App\Models\RouteVisit;
use App\Models\Customerdetail;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/suggest-rephrase', [RephraseController::class, 'suggest']);

use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);



Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);




//Admin Routes 

Route::get('/addcart', [Admincartcontroller::class, 'index'])->middleware('owner');

Route::get('/dashboard', function () {
    // Fetch the necessary data from the database
    $totalOrders = "100"; //Order::count(); // Total number of orders
    $totalRevenue = "100"; //Order::sum('total_price'); // Assuming you have a 'total_price' column in your orders table
    $totalProducts = Product::count();
    $totalcustomer = Customerdetail::where('role', 'customer')->get();
    $totalcustomers = count($totalcustomer);
    $todayCustomers = Customerdetail::where('role', 'customer')->whereDate('created_at', today())->get();
    $todayCustomersCount = count($todayCustomers);
    $outOfStock = Product::where('stock', 0)->count(); // Count of out-of-stock products
    $bestSellingItem = '0'; //Product::withCount('orders')
    //  ->orderBy('orders_count', 'desc')
    // ->first(); // Get the best-selling product
    $bestSellingCategory = Category::withCount('products')
        ->orderBy('products_count', 'desc')
        ->first(); // Get the best-selling category

    // Pass data to the view
    return view('Admin.dashboard', compact(
        'totalOrders',
        'totalRevenue',
        'totalProducts',
        'outOfStock',
        'bestSellingItem',
        'bestSellingCategory',
        'totalcustomers',
        'todayCustomersCount'
    ));
})->middleware('owner');



Route::get('/addproduct', function () {
    return view('Admin.addproduct'); // Renders the Admin.addproduct view
})->name('product')->middleware('owner'); // Protects the route with the 'owner' middleware

Route::get('/addcategory
', function () {
    return view('Admin.addcategory
');
})->name('product')->middleware('owner');
Route::get('/sendnotification', function () {
    $fcmTokens = User::with('customer')->get(); // Fetch Users with related Customerdetail

    return view('Admin.sendnotification', compact('fcmTokens'));
})->middleware('owner');

Route::post('/send-notification', [FirebaseNotificationController::class, 'sendNotification']);
Route::post('/save-fcm-token', [FirebaseNotificationController::class, 'storeFcmToken']);
Route::get('/unauthorized', function () {
    return view('unauthorized'); // Create a view for unauthorized access
});

//Customer routes



Route::middleware('guest')->get('/login', function () {
    return view('login');
});
Route::middleware('guest')->get('/signup', function () {
    return view('signup');
});
Route::get('/policy', function () {
    return view('Policy');
});
Route::get('/', [HomeController::class, 'index']);

Route::get('/userprofile', function () {
    $customer = Customerdetail::where('id', '1')->first();
    $data = compact('customer');
    return view('userprofile')->with($data);
});
Route::get('/userprofile', [Customercontroller::class, 'show'])->name('userprofile');




Route::get('/route-visits', function () {
    return RouteVisit::all();
});


//Customer ka account sign up ke liye 
//Route::post('/signups', [Customercontroller::class, 'signups']);
Route::post('/signup', [Customercontroller::class, 'signup']);
Route::post('/signups', [Customercontroller::class, 'signups']);
Route::post('/login', [Customercontroller::class, 'login']);
// In routes/web.php
Route::get('/logout', [Customercontroller::class, 'logout'])->name('logout');


Route::post('/login', [Customercontroller::class, 'login']);
Route::put('/customer/{id}', [Customercontroller::class, 'update']);
//cart
Route::get('/cart', function () {
    return view('cart');
});
Route::post('/cart/add', [CartCustomerController::class, 'addToCart'])->name('cart.add');

Route::get('/cart/count', [CartCustomerController::class, 'getCartCount']);
Route::get('/cart/items/{id}', [CartCustomerController::class, 'removeCartItem']);
