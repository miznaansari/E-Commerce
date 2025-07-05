<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customerdetail;
use App\Models\RouteVisit;
use Illuminate\Http\Request;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Factory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Customercontroller extends Controller
{
public function signups(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customerdetails,email',
            'phone_number' => 'required|regex:/^[0-9]{10}$/|unique:customerdetails,phone_number',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048',
            'company_name' => 'nullable|string',
        ]);

        // Create a new customer record
        $customer = new Customerdetail();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->dob = $request->dob;
        $customer->phone_number = $request->phone_number;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;
        $customer->city = $request->city;
        $customer->state = $request->state;
        $customer->country = $request->country;
        $customer->zip_code = $request->zip_code;
        $customer->profile_picture = $request->profile_picture;
        $customer->company_name = $request->company_name;
        $customer->role = 'customer';
        $customer->email_verified = false;
        $customer->phone_verified = false;
        $customer->save();

        // Redirect with success message
        return redirect()->back()->with('message', 'Signup successful!');
    }


  
  public function signup(Request $request)
{

    // Validate the incoming request data
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
    
    ]);


    // Check if the user already exists
    $customer = Customerdetail::where('email', $request->email)->first();
    
    if ($customer) {
        // If user exists, authenticate the user
        Auth::login($customer);

        // Prevent redirection by sending a JSON response instead
        return response()->json([
            'success' => true,
            'message' => 'User logged in successfully!',
            'redirect' => null,  // Ensure no redirection happens
        ]);
    }

    // Create a new customer record
    $customer = new Customerdetail();
    $customer->first_name = $request->first_name;
    $customer->last_name = $request->last_name;
    $customer->email = $request->email;
    $customer->dob = $request->dob;
    $customer->phone_number = $request->phone_number;
    $customer->password = bcrypt($request->password);
    $customer->address = $request->address;
    $customer->city = $request->city;
    $customer->state = $request->state;
    $customer->country = $request->country;
    $customer->zip_code = $request->zip_code;
    $customer->profile_picture = $request->profile_picture;
    $customer->company_name = $request->company_name;
    $customer->role = 'customer';
    $customer->email_verified = false;
    $customer->phone_verified = false;
    $customer->save();

    // Create a cart for the customer
    $cart = new Cart();
    $cart->customer_id = $customer->id;
    $cart->save();

    // Authenticate the user
    Auth::login($customer);

    // Return a JSON response indicating success without any redirects
    return response()->json([
        'success' => true,
        'message' => 'User created and logged in successfully!',
        'redirect' => null,  // No redirection
    ]);
}

   public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Find the customer by email
        $customer = Customerdetail::where('email', $request->email)->first();
    
        // Check if customer exists and the password matches
        if ($customer && Hash::check($request->password, $customer->password)) {

            // Authenticate the customer using the web guard
            Auth::guard('web')->login($customer);
            $pagecount = RouteVisit::where('route','/')->first();

          $products = Product::with('category')->get();
        
            $data = compact('pagecount','products');
            session()->flash('login', 'Login successfully.');
            
            // Redirect to the dashboard or any other page
            return view('index')->with($data)->with('message', 'Login successful!');
        }
    
        // Redirect back with error message
        return redirect()->back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token for security
        session()->flash('logout', 'Logout successfully.');

        return redirect('/'); // Redirect to the home page or any page you prefer
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'address' => 'nullable|string|max:500',
            'zip_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ]);

        $customer = Customerdetail::findOrFail($id);

        // Update customer details
                $customer->dob = $request->dob;
        $customer->address = $request->input('address', $customer->address);
        $customer->zip_code = $request->input('zip_code', $customer->zip_code);
        $customer->country = $request->input('country', $customer->country);
        $customer->state = $request->input('state', $customer->state);
        $customer->city = $request->input('city', $customer->city);

       

        // Save updated customer details
        $customer->save();
        $customer = Customerdetail::where('id',$id)->first();
        $data = compact('customer');
        session()->flash('success', 'Profile updated successfully.');
        // Redirect back with a success message
        return view('userprofile')->with($data);
    }

    public function show(Request $request)
{
    $userId = $request->query('id');
    $customer = Customerdetail::findOrFail($userId);

    // Pass the user to a view or return some data
    return view('userprofile', compact('customer'));
}

}
