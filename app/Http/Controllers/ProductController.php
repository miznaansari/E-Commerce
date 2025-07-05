<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        // Get products with their category details
        $products = Product::with('category')->get();
    
        // Return view with the products data
        return view('product', compact('products'));
    }
    

    // Show a single product
    public function show($id)
    {
        $product = Product::with('category')->find($id);
        $productimg = ProductImage::where('product_id',$id)->get();
        // echo $productimg;
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $data = compact('product','productimg');
        return view('viewproductdetail')->with($data);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'string|max:150',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Additional images
        ]);

        // Define the directory for images
        $imageDirectory = realpath(dirname(__FILE__) . '/../../../public/productimg');
        if (!file_exists($imageDirectory)) {
            mkdir($imageDirectory, 0777, true);
        }

        // Handle the main thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Generate a unique file name for the thumbnail
            $thumbnailName = time() . '_thumbnail.' . $request->thumbnail->extension();
            
            // Move the thumbnail to the productimg directory
            if ($request->thumbnail->move($imageDirectory, $thumbnailName)) {
                // Store the relative path in the validated array
                $validated['thumbnail'] = 'productimg/' . $thumbnailName; // Set thumbnail path
                Log::info('Thumbnail uploaded to: ' . $validated['thumbnail']);
            } else {
                Log::error('Failed to upload thumbnail.');
                return back()->withErrors(['thumbnail' => 'Failed to upload thumbnail.']);
            }
        }

        // Create the product with validated data
        $product = Product::create($validated);

        // Handle additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                // Generate a unique name for each additional image
                $imageName = time() . '_' . $index . '.' . $image->extension();
                
                // Save the image to the productimg directory
                if ($image->move($imageDirectory, $imageName)) {
                    // Create an image record in the database
                    $product->images()->create([
                        'image_url' => 'productimg/' . $imageName, // Public URL for the image
                        'image_path' => $imageName, // Store only the filename
                        'is_main' => $index === 0, // Mark the first image as the main image
                    ]);
                    Log::info('Image uploaded to: ' . 'productimg/' . $imageName);
                } else {
                    Log::error('Failed to upload image: ' . $imageName);
                    return back()->withErrors(['images' => 'Failed to upload one or more images.']);
                }
            }
        }
        // Handle product sizes
        foreach ($request->sizes as $size) {
            $product->sizes()->create([
                'size' => $size['size'], // Size name (e.g., S, M, L)
                'stock' => $size['stock'], // Stock for the size
            ]);
        }

        // Redirect to the products index page with success message
        return view('Admin.addproduct')->with('success', 'Product created successfully');
    }
    

    // Update an existing product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:150',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
            'thumbnail' => 'sometimes|required|string|max:255',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}
