<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Clevar</title>
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    <!-- Primary Meta Tags -->
    <meta name="title" content="Home | Clevar">
    <meta name="description" content="Discover the latest trends in women's fashion with our 2025 collection. Shop curated pieces and explore the best styles of the season.">
    <meta name="keywords" content="fashion, women's clothing, 2025 collection, latest trends, curated styles, new arrivals">
    <meta name="author" content="Clevar">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://clevar.rf.gd/">
    <meta property="og:title" content="Home | Your Website Name">
    <meta property="og:description" content="Discover the latest trends in Men and women's fashion with our 2025 collection. Shop curated pieces and explore the best styles of the season.">
    <meta property="og:image" content="https://clevar.rf.gd/img/clever.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://clevar.rf.gd/">
    <meta property="twitter:title" content="Home | Your Website Name">
    <meta property="twitter:description" content="Discover the latest trends in Men and women's fashion with our 2025 collection. Shop curated pieces and explore the best styles of the season.">
    <meta property="twitter:image" content="https://yourwebsite.com/images/twitter-image.jpg">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Canonical Link -->
    <link rel="canonical" href="http://clevar.rf.gd/">
    <script src="https://www.gstatic.com/firebasejs/11.1.0/firebase-app.js"></script> <!-- Firebase Messaging -->
    <script src="https://www.gstatic.com/firebasejs/11.1.0/firebase-messaging.js"></script>

    <!-- External Resources -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }




        .hero {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap-reverse;
        }

        .hero-text {
            padding-top: 80px
        }

        .hero-text h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .hero-text a {
            display: inline-block;
            padding: 10px 20px;
            background: #000;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            /* Auto-fit columns */
            gap: 20px;
            padding: 20px;
            flex-wrap: wrap;
        }

        .product-card {
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
        }

        .product-card img {
            width: 100%;
            /* Adjusts to the width of the container */
            height: 300px;
            /* Maintains the aspect ratio */
            border-radius: 8px;
            object-fit: cover;
            /* Ensures the image fits without distortion */
        }

        .product-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .product-card p {
            color: #777;
            margin-bottom: 10px;
        }

        .product-card a {
            display: inline-block;
            padding: 10px 15px;
            background: #000;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
        }

        .footer ul li {
            margin-bottom: 1rem;
        }

        /* Container for the sprinkle effect */
        /* Container for the sprinkle effect inside the header */
        header {
            position: relative;
            /* Make sure the header is positioned relative to the sprinkles */
            width: 100%;
            overflow: hidden;
            /* Hide any sprinkle that goes outside the header */
            /* Disable pointer events to avoid interaction with sprinkles */
        }

        /* Sprinkle particles */
        .sprinkle {
            position: absolute;
            opacity: 0;
            /* Start with opacity 0 */
            width: 7px;
            height: 7px;
            background-color: var(--color, red);
            /* Default color */
            animation: sprinkle-fall 2.5s linear infinite, sprinkle-color 2.5s linear infinite;
            transition: all 0.5s ease;
        }

        /* Shape styles */
        .sprinkle.circle {
            border-radius: 50%;
            /* Circle shape */
        }

        .sprinkle.triangle {
            position: absolute;
            overflow: hidden;
            width: 0;
            height: 0;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-bottom: 12px solid var(--color, red);
            /* Triangle shape */
        }

        .sprinkle.star {
            width: 12px;
            height: 12px;
            background-color: transparent;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            /* Star shape */
        }

        /* Sprinkle fall animation */
        @keyframes sprinkle-fall {
            0% {
                transform: translateY(-100px) translateX(0);
                /* Start above the header */
                opacity: 0.6;
                /* Opacity 1 at the start */
            }

            50% {
                opacity: 0.8;
                /* Maintain opacity */
            }

            100% {
                transform: translateY(100px) translateX(calc(-20vw + 50%));
                /* End within the header */
                opacity: 1;
                /* Keep opacity constant while falling */
            }
        }

        /* Sprinkle color animation */
        @keyframes sprinkle-color {
            0% {
                background-color: red;
            }

            25% {
                background-color: orange;
            }

            50% {
                background-color: yellow;
            }

            75% {
                background-color: green;
            }

            100% {
                background-color: blue;
            }
        }



        .hero-text h1 {
            position: relative;
            font-size: 35px;
        }

        .hero-text h1::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            background-color: black;
            width: 100px;
            height: 2px;
            border-radius: 5px;
        }

        .desktop {
            display: none;
        }


        .searchicon {
            transition: all ease 0.5s;
        }

        .row-home-card {
            display: flex;
            gap: 30px;
        }

        .col-page-count {
            width: 150px;
            height: 150px;
            border: 1px solid #a7a7a7;
            display: flex;
            box-shadow: rgba(172, 172, 172, 0.35) 0px 5px 15px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #e3e3e361;
            border-radius: 10px;
        }




        @media (max-width: 768px) {


            .fashion-ban {
                width: 100% !important;
            }



            .desktop {
                display: block;
            }






            header {}



        }

    </style>

</head>
<body >
    {{--
    <ul>
        <li>Home: <span id="route-/">0</span></li>
        <li>About: <span id="route-product">0</span></li>
    </ul> --}}
    <div id="loaders" class="fixed inset-0 flex items-center justify-center bg-RED-900">
        <p class="text-black">Loading...</p>
    </div>

    <div id="content" class="hidden pb-16 md:pb-0 bg-gradient-to-br from-indigo-100 to-white shadow-lg">


        @include('components.navbar')
        @if (session('login'))
        <div x-data="{ show: true }" style="z-index:999999" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="fixed top-8 right-10 bg-green-600 text-white p-4 rounded-lg shadow-lg">
            <p class="font-semibold">{{ session('login') }}</p>
        </div>

        @endif
        @if (session('logout'))
        <div x-data="{ show: true }" style="z-index:999999" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="fixed top-8 right-10 bg-green-600 text-white p-4 rounded-lg shadow-lg">
            <p class="font-semibold">{{ session('logout') }}</p>
        </div>

        @endif
        <div class="relative isolate flex items-center gap-x-6 overflow-hidden  px-6 py-2.5 sm:px-3.5 sm:before:flex-1">
            <div class="absolute left-[max(-7rem,calc(50%-52rem))] top-1/2 -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
                <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)"></div>
            </div>
            <div class="absolute left-[max(45rem,calc(50%+8rem))] top-1/2 -z-10 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
                <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)"></div>
            </div>
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                <p class="text-sm/6 text-gray-900">
                    <strong class="font-semibold">Clevar 2025</strong><svg viewBox="0 0 2 2" class="mx-2 inline size-0.5 fill-current" aria-hidden="true">
                        <circle cx="1" cy="1" r="1" /></svg>Join us in Denver from June 7 – 9 to see what’s coming next.
                </p>
                <a href="/signup" class="flex-none rounded-full bg-gray-900 px-3.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">Register now <span aria-hidden="true">&rarr;</span></a>
            </div>
            <div class="flex flex-1 justify-end">
                <button type="button" class="-m-3 p-3 focus-visible:outline-offset-[-4px]">
                    <span class="sr-only">Dismiss</span>
                    <svg class="size-5 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                    </svg>
                </button>
            </div>
        </div>

        <section class="hero">
            <div class="hero-text bg-opacity-60 w-[100%] flex-col md:flex-row lg:flex-col flex p-2 mt-[-260px] lg:mt-12 lg:w-[50%] lg:text-black xl:w-[50%] bg-gray-900 text-white  lg:bg-transparent" style="z-index: 9">
            <div >
                <h1>NEW COLLECTION 2025</h1>
                <p>Explore this week's latest womenswear pieces of the season curated for you</p>
                <a href="/products">VIEW</a>
                </div>

                <div class="card mt-5">
                    <div class="flex justify-around md:justify-start md:gap-10">
                        <div class="col-page-count">

                            <span id="route-/" style="font-size:50px">{{$pagecount===null?'0':$pagecount->count}}</span>
                            <p style="text-align:center;font-size: 12px;">Real-Time View Count</p>
                        </div>
                        <div class="col-page-count">

                            <span style="font-size:50px">0</span>
                            <p style="text-align:center;font-size: 12px;">Total Order</p>
                        </div>
                    </div>
                </div>
            </div>
            <img src="img/banner.png" style="object-fit: cover; height: 500px;" alt="Fashion Model">
        </section>




        <section>
            <div class="relative overflow-hidden bg-white">
                <div class="pb-80 pt-16 sm:pb-40 sm:pt-24 lg:pb-48 lg:pt-40 ">
                    <div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
                        <div class="sm:max-w-lg">
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Summer styles are finally here</h1>
                            <p class="mt-4 text-xl text-gray-500">This year, our new summer collection will shelter you from the harsh elements of a world that doesn't care if you live or die.</p>
                        </div>
                        <div>
                            <div class="mt-10">
                                <!-- Decorative image grid -->
                                <div aria-hidden="true" class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
                                    <div class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                                        <div class="flex items-center space-x-6 lg:space-x-8">
                                            <div class="grid shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                                <div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
                                                    <img src="https://tailwindui.com/plus/img/ecommerce-images/home-page-03-hero-image-tile-01.jpg" alt="" class="size-full object-cover">
                                                </div>
                                                <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                    <img src="https://tailwindui.com/plus/img/ecommerce-images/home-page-03-hero-image-tile-02.jpg" alt="" class="size-full object-cover">
                                                </div>
                                            </div>
                                            <div class="grid shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                                <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                    <img src="https://tailwindui.com/plus/img/ecommerce-images/home-page-03-hero-image-tile-03.jpg" alt="" class="size-full object-cover">
                                                </div>
                                                <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                    <img src="https://tailwindui.com/plus/img/ecommerce-images/home-page-03-hero-image-tile-04.jpg" alt="" class="size-full object-cover">
                                                </div>
                                                <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                    <img src="https://tailwindui.com/plus/img/ecommerce-images/home-page-03-hero-image-tile-05.jpg" alt="" class="size-full object-cover">
                                                </div>
                                            </div>
                                            <div class="grid shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                                <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                    <img src="https://tailwindui.com/plus/img/ecommerce-images/home-page-03-hero-image-tile-06.jpg" alt="" class="size-full object-cover">
                                                </div>
                                                <div class="h-64 w-44 overflow-hidden rounded-lg">
                                                    <img src="https://tailwindui.com/plus/img/ecommerce-images/home-page-03-hero-image-tile-07.jpg" alt="" class="size-full object-cover">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="#" class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-center font-medium text-white hover:bg-indigo-700">Shop Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        <section class="products grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="product-card bg-white rounded-lg shadow-md border border-gray-200 p-4">
                <div class="flex flex-col items-center">
                    <!-- Product Image -->
                    <div class="h-48 w-48 mb-4  rounded-lg border flex items-center justify-center overflow-hidden">
                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="object-cover h-full w-full" />
                    </div>

                    <!-- Product Name -->
                    <h3 class="text-xl font-bold text-gray-800 truncate">{{ $product->name }}</h3>

                    <!-- Product Description -->
                    <p class="text-gray-600 text-sm mt-2 text-center truncate">
                        {{ $product->description }}
                    </p>

                    <!-- Stock and Price -->
                    <div class="flex items-center justify-between w-full mt-4 ">
                        <p class="text-sm text-gray-700">
                            <strong>Stock:</strong> {{ $product->stock ?? '-' }}
                        </p>
                        <p class="text-sm text-gray-700">
                            <strong>Price:</strong> ₹{{ $product->price ?? '-' }}
                        </p>
                    </div>

                    <!-- Category -->
                    <p class="text-sm mt-4 text-gray-500">
                        Category: {{ $product->category->name ?? 'Not Selected' }}
                    </p>

                    <!-- View Product -->
                    <a href="/products/{{$product->id}}" class="inline-block mt-6 px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded hover:bg-indigo-500">
                        View Product
                    </a>
                </div>
            </div>
            @endforeach
        </section>


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
</body>


<script type="module" src="{{ url('js/push.js') }}"></script>

<script src="{{ url('js/firebase.js') }}"></script>
</html>
