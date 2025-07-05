<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - User Data</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('Admin.components.navbar')

    <div class="container mx-auto p-6 bg-white rounded-md shadow-md">
        <h1 class="text-2xl font-bold mb-4">User Data</h1>
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left">Profile Picture</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Items in Cart</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result as $user)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">
                        <!-- Assuming profile picture is stored in the user data array -->
                        <img src="{{ $user['customer']['profile_picture'] ?? 'default-profile.jpg' }}" alt="Profile Picture" class="w-12 h-12 rounded-full">
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user['customer']['first_name'] }} {{ $user['customer']['last_name'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user['customer']['email'] }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <!-- Initial product details -->
                        <div x-data="{ openview: false }">
                            @foreach($user['items'] as $index => $item)
                            @if($index < 1) <div class="mb-4">
                                <!-- Display product name and price -->
                                <p>
                                    <strong>Product Name:</strong> {{ $item['product_name'] ?? 'Unknown Product' }}<br>
                                    <strong>Price:</strong> ₹{{ $item['price'] }}<br>
                                </p>
                        </div>
                        @endif
                        @endforeach

                        <!-- View All Button to trigger modal -->
                        <button x-on:click="openview = ! openview" class="text-blue-600 hover:underline">
                            View All Items
                        </button>

                        <!-- Modal displaying all items -->
                        <div x-show="openview" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
                                <h3 class="text-xl font-bold mb-4">All Product Details</h3>

                                <!-- Scrollable container for product details -->
                                <div class="space-y-4 max-h-96 overflow-y-auto">
                                    @foreach($user['items'] as $item)
                                    <div class="flex items-center space-x-4">
                                        <img src="{{url($item['product_img'])}}" width="100px" style="filter:{{$item['color']}}" alt="">
                                        <div>
                                            <p><strong>Product Name:</strong> {{ $item['product_name'] ?? 'Unknown Product' }}</p>
                                            <p><strong>Color:</strong> <span style="filter: {{ $item['color'] }}">{{ $item['color'] }}</span></p>
                                            <p><strong>Size:</strong> {{ $item['size'] ?? 'N/A' }}</p>
                                            <p><strong>Quantity:</strong> {{ $item['quantity'] }}</p>
                                            <p><strong>Price:</strong> ₹{{ $item['price'] }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Close Button -->
                                <button x-on:click="openview = ! openview" class="mt-4 text-white bg-red-500 hover:bg-red-700 px-4 py-2 rounded">
                                    Close
                                </button>
                            </div>
                        </div>
    </div>
    </td>


    <td class="border border-gray-300 px-4 py-2">
        <!-- If there are items in the cart, show the contact link -->
        @if(count($user['items']) > 0)
        <a href="mailto:{{ $user['customer']['email'] }}" class="text-blue-600 hover:underline">Contact</a>
        @else
        <span class="text-gray-500">No Items in Cart</span>
        @endif
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('a[href]');

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('bg-indigo-600', 'text-white');
                    link.classList.remove('text-black300');
                }
            });
        });

    </script>
</body>
</html>
