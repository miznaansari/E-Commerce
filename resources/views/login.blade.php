<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
       <link rel="stylesheet" href="{{url('css/sprinkle.css')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .input {
            width: 100%;

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

<div id="content" class="hidden pb-16 md:pb-0">

    @include('components.navbar')
   
            <div class="row flex min-h-full flex-1 flex-col px-6 py-3 sm:px-2 lg:px-6 bg-gray-100" style="display:flex;;flex-direction:column;">
                <img src="{{url('img/clever.png')}}" class="mx-auto h-20 w-auto" alt="">
                      <div class="input flex items-center justify-center mt-3">
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
            </button></div>
                <h2 class="mt-5 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
             
      
                <form action="/login" class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm" method="post">
    @csrf
    <div class="input" style="margin-bottom:20px">
        <label for="email">Email Address</label>
        <div class="mt-2">
            <input type="text" 
                   class="block w-full max-w-lg rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   name="email" 
                   id="email" 
                   value="{{ old('email') }}">

            <!-- Display error message for email -->
            @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="input">
        <div class="flex items-center justify-between">
            <label for="password">Password</label>
            <p class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</p>
        </div>
    </div>

    <div class="input mt-2" style="margin-bottom:20px">
        <input type="password" 
               class="block w-full max-w-lg rounded-md bg-white px-3 py-1.5 text-base text-gray-900 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
               name="password" 
               id="password">

        <!-- Display error message for password -->
        @error('password')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="inputbtn mt-2">
        <input type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" value="Login">
    </div>

    <a href="/signup">
        <p class="mt-10 text-center text-sm/6 text-gray-500">Not a member? Sign up for an account.</p>
    </a>
</form>

             
       </div>

    @include('components.footer')
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Pusher with your credentials
            const pusher = new Pusher('00540a3b3f4606477367', {
                cluster: 'ap2'
                , encrypted: true
            });

            // Log successful connection
            pusher.connection.bind('connected', function() {
                console.log('Connected to Pusher!');
            });

            // Log any errors
            pusher.connection.bind('error', function(err) {
                console.error('Connection error:', err);
            });

            // Subscribe to the 'route-visits' channel
            const channel = pusher.subscribe('route-visits');

            // Listen for the 'RouteVisitUpdated' event
            channel.bind('RouteVisitUpdated', function(data) {
                console.log('Route Visit Updated:', data);

                // Debugging the route and count
                console.log('Received route:', data.routeVisit.route);
                console.log('Count:', data.routeVisit.count);

                // Update the corresponding route counter
                const routeCounter = document.getElementById(`route-${data.routeVisit.route}`);
                console.log('Element:', routeCounter);

                if (routeCounter) {
                    routeCounter.innerHTML = data.routeVisit.count; // Update the value
                } else {
                    console.warn(`Element with id 'route-${data.routeVisit.route}' not found.`);
                }
            });
        });

    </script>
     <script>
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('loaders').style.display = 'none';
        document.getElementById('content').classList.remove('hidden');
    });
</script>

     <script type="module" src="{{ url('js/google.js') }}"></script>

</body>
</html>
