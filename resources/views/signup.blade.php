<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
       <script src="https://cdn.tailwindcss.com"></script>
<script src="//unpkg.com/alpinejs" defer></script>
  
       <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <style>
        .input {
            margin-bottom: 20px;
        }
        .footer ul li{
    margin-bottom: 1rem;
}
    </style>
</head>
<body>
 <div id="loaders" class="fixed inset-0 flex items-center justify-center bg-RED-900">
    <p class="text-white">Loading...</p>
</div>

<div id="content" class="hidden">
    @include('components.navbar')
    @if(session('message') === 'Signup successful!')
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">Holy smokes!</strong>
      <span class="block sm:inline">Signup successful!</span>
      <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <title>Close</title>
          <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
        </svg>
      </span>
    </div>
    @endif

    <div class="min-h-full flex flex-col px-6 py-3 bg-gray-100">
        <img src="{{url('img/clever.png')}}" class="mx-auto h-20 w-auto" alt="Logo">
          <div class="flex justify-center mt-5">
  <button id="google-login-btn" class="flex items-center bg-white dark:bg-gray-900 border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-gray-800 dark:text-white text-black hover:text-black hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" >
                <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="-0.5 0 48 48" version="1.1">
                    <title>Google-color</title>
                    <desc>Created with Sketch.</desc>
                    <defs> </defs>
                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Color-" transform="translate(-401.000000, -860.000000)">
                            <g id="Google" transform="translate(401.000000, 860.000000)">
                                <path d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24" id="Fill-1" fill="#FBBC05"> </path>
                                <path d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333" id="Fill-2" fill="#EB4335"> </path>
                                <path d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667" id="Fill-3" fill="#34A853"> </path>
                                <path d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24" id="Fill-4" fill="#4285F4"> </path>
                            </g>
                        </g>
                    </g>
                </svg>
                <span>Continue with Google</span>
            </button>
</div>
        <h2 class="mt-5 text-center text-2xl font-bold tracking-tight text-gray-900">Signup Your Account</h2>
       

        <form action="/signups" method="post" class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            @csrf
           

            <div class="input">
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required
                    class="block w-full rounded-md bg-white px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div> <div class="input">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required
                    class="block w-full rounded-md bg-white px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
             <div class="input">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="block w-full rounded-md bg-white px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="input">
                <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required
                    class="block w-full rounded-md bg-white px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('dob')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="input">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" pattern="[0-9]{10}" required
                    class="block w-full rounded-md bg-white px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('mobile')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="input">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                    class="block w-full rounded-md bg-white px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="input">
                <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required
                    class="block w-full rounded-md bg-white px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('confirm_password')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full rounded-md bg-indigo-600 px-3 py-2 text-white font-medium hover:bg-indigo-500">
                    Signup
                </button>
            </div>
        </form>

        <p class="mt-5 text-center text-sm text-gray-500">
            Already have an account? <a href="/login" class="text-indigo-600 font-medium">Login here</a>
        </p>

      

    </div>

         @include('components.footer')
         </div>

</body>
 <script>
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('loaders').style.display = 'none';
        document.getElementById('content').classList.remove('hidden');
    });
</script>

    <script type="module" src="{{ url('js/google.js') }}"></script>

</html>
