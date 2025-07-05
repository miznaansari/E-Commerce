<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ url('css/navfoottercss.css') }}">
</head>

<body class="bg-indigo-50 text-gray-800">
 <div id="loaders" class="fixed inset-0 flex items-center justify-center bg-RED-900">
        <p class="text-white">Loading...</p>
    </div>

    <div id="content" class="hidden pb-16 md:pb-0">

    @include('components.navbar')

 @if (session('success'))
        <div x-data="{ show: true }" 
     style="z-index:999999" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 4000)" 
     class="fixed bottom-8 right-10 bg-green-600 text-white p-4 rounded-lg shadow-lg">
    <p class="font-semibold">{{ session('success') }}</p>
</div>

    @endif
    <!-- Success Alert -->
    @if (session('success'))
        {{-- <div style="z-index:99999" class="fixed top-4 right-4 bg-indigo-600 text-white p-4 rounded-lg shadow-lg">
            <p class="font-semibold">{{ session('success') }}</p>
        </div> --}}

         <div  style="z-index:999999" x-show="show" x-init="setTimeout(() => show = false, 400000)"
            class="fixed top-8 right-10 bg-green-600 text-white p-4 rounded-lg shadow-lg">
            <p class="font-semibold">{{ session('success') }}</p>
        </div>
    @endif

 <div class="py-10 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <!-- Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Card (1/3) -->
            <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8 col-span-1">
                <div class="text-center">
                    <img src="{{ asset( $customer->profile_picture) }}" alt="Profile Picture"
                        class="mx-auto h-32 w-32 rounded-full border-4 border-indigo-300 object-cover">
                    <h1 class="mt-6 text-4xl font-bold tracking-tight text-gray-800">
                        {{ $customer->first_name }} {{ $customer->last_name }}
                    </h1>
                    <p class="mt-2 text-lg font-medium text-gray-600">
                        {{ $customer->email }}
                    </p>
                    <p class="mt-1 text-lg font-medium text-gray-600">
                        {{ $customer->phone_number }}
                    </p>

                    <!-- Email & Phone Verification -->
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">
                            Email Verified: <span
                                class="font-bold {{ $customer->email_verified ? 'text-indigo-600' : 'text-red-600' }}">
                                {{ $customer->email_verified ? 'Verified' : 'Not Verified' }}</span>
                        </p>
                        <p class="text-sm text-gray-600">
                            Phone Verified: <span
                                class="font-bold {{ $customer->phone_verified ? 'text-indigo-600' : 'text-red-600' }}">
                                {{ $customer->phone_verified ? 'Verified' : 'Not Verified' }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Profile Details and Orders (2/3) -->
            <div class="col-span-2">
                <!-- Profile Details -->
                <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-8">
                    <h2 class="text-2xl font-semibold border-b border-gray-300 pb-3 mb-6">Profile Details</h2>
                    <form action="/customer/{{$customer->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div>
                                <label class="text-sm font-medium text-gray-500">Date of Birth</label>
                                <input type="date" name="dob" value="{{ $customer->dob ?? '' }}"
                                    class="mt-1 w-full border-indigo-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Role</label>
                                <input type="text" name="role" value="{{ $customer->role ?? '' }}"
                                    placeholder="Enter your role"
                                    class="mt-1 w-full border-indigo-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">City</label>
                                <input type="text" name="city" value="{{ $customer->city ?? '' }}"
                                    placeholder="Enter your city"
                                    class="mt-1 w-full border-indigo-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Address</label>
                                <textarea name="address" placeholder="Enter your address"
                                    class="mt-1 w-full border-indigo-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ $customer->address ?? '' }}</textarea>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Postal Code</label>
                                <input type="text" name="zip_code" value="{{ $customer->zip_code ?? '' }}"
                                    placeholder="Enter postal code"
                                    class="mt-1 w-full border-indigo-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">Country</label>
                                <input type="text" name="country" value="{{ $customer->country ?? '' }}"
                                    placeholder="Enter your country"
                                    class="mt-1 w-full border-indigo-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="text-sm font-medium text-gray-500">State</label>
                                <input type="text" name="state" value="{{ $customer->state ?? '' }}"
                                    placeholder="Enter your state"
                                    class="mt-1 w-full border-indigo-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                        <button type="submit"
                            class="mt-6 w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                            Update Profile
                        </button>
                    </form>
                </div>

                <!-- Orders Section -->
                <div class="mt-8 bg-white rounded-lg shadow-lg border border-gray-200 p-8">
                    <h2 class="text-2xl font-semibold border-b border-gray-300 pb-3 mb-6">Orders</h2>
                    <div class="flex items-center justify-between">
                        <p class="text-lg font-medium text-gray-600">Number of Orders:</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $customer->orders_count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>



</body>
  <script>
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('loaders').style.display = 'none';
        document.getElementById('content').classList.remove('hidden');
    });
</script>
</html>
