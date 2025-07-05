<div x-data=" { cart: false }" class="bg-gradient-to-br from-indigo-100 to-white shadow-lg sticky top-0 left-0 z-10  transition-all duration-300 ease-in-out">
    <header x-data="{ menu: false, searchOpen: false }" class="bg-gradient-to-br from-indigo-100 to-white shadow-lg text-black sm:py-2 shadow-lg sticky top-0 left-0 w-full  transition-all duration-300 ease-in-out" id="navbar">

        <div class="max-w-7xl mx-auto px-6 py-1 flex items-center justify-between transition-all duration-300 ease-in-out" id="navbar-content">
            <!-- Mobile Menu Button -->
            <!-- Mobile Menu Button -->
            <button x-on:click="menu = !menu" id="sidenav" class="hidden md:block lg:hidden text-2xl relative transition-transform duration-300 ease-in-out" style="font-size: 23px;">
                <i class="fa-solid" :class="menu ? 'fa-x' : 'fa-bars' + ' text-black transition-transform duration-300'"></i>
            </button>


            <!-- Logo -->
            <div class="flex items-center space-x-3 z-10">
                <img src="{{ url('img/clever.png') }}" alt="logo" height="55px" width="55px">
                <span class="font-bold text-2xl text-black transition-all duration-300 ease-in-out" id="logo-text">CLEVAR</span>
            </div>

            <!-- Search Bar (Mobile and Desktop) -->
            <form action="" class="relative hidden lg:flex w-1/3 z-10">
                <input type="search" name="search" class="w-full  py-2 px-4 rounded-lg border border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Search..." required>
                <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-xl text-black z-10">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex space-x-6 z-10">
                <a href="/" class="text-lg hover:text-black transition-all duration-300 ease-in-out">Home</a>
                <a href="/products" class="text-lg hover:text-black transition-all duration-300 ease-in-out">Product</a>
                <a href="/policy" class="text-lg hover:text-black transition-all duration-300 ease-in-out">Privacy Policy</a>

                <!-- Authentication Links -->
                @guest
                <a href="/signup" class="text-lg hover:text-black transition-all duration-300 ease-in-out">Signup</a>
                <a href="/login" class="text-lg hover:text-black transition-all duration-300 ease-in-out">Login</a>
                @else
                @endguest
            </nav>



            <!-- Profile Dropdown (Desktop) -->
            <div class="relative flex gap-5" x-data="{ open: false }">
                <!-- Search Bar Toggle Button (Mobile) -->
                <button x-on:click="searchOpen = !searchOpen" class="lg:hidden text-xl text-black z-10">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                @auth


                <button x-on:click="open = !open" class="flex items-center space-x-2 text-sm focus:outline-none z-10 hidden md:flex">
                    <img class="w-8 h-8 rounded-full border-2 border-indigo-600" src="{{ auth()->user()->profile_picture }}" alt="Profile">
                    @auth
                    <span class="hidden lg:block text-black">{{ auth()->user()->first_name }}</span>
                    @endauth


                </button>
                <button x-on:click="cart = ! cart">
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-cart-shopping text-lg"></i>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-semibold rounded-full h-5 w-5 flex items-center justify-center">
                            0
                        </span>
                    </div>
                    <button type="button" id="notificationButton" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                    </button>
                    <div x-show="open" class="fixed top-6 right-0 mt-8 w-48 bg-white rounded-md shadow-lg py-1 z-10 " x-cloak>
                        <a href="{{ route('userprofile', ['id' => auth()->user()->id]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100 hover:text-black">Your Profile</a>

                        <a href="/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100 hover:text-black">Settings</a>
                        <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-100 hover:text-black">Sign out</a>
                    </div>
                    @endauth
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <!-- Mobile Navigation Menu -->
        <!-- Mobile Navigation Menu -->
        <nav class="lg:hidden  text-black transition-all duration-500 ease-in-out transform z-20 " x-show="menu" x-transition:enter="transform transition-all ease-in-out duration-300 opacity-100 max-h-0" x-transition:enter-start="max-h-0 opacity-0" x-transition:enter-end="max-h-screen opacity-100" x-transition:leave="transform transition-all ease-in-out duration-200 opacity-100 max-h-0" x-transition:leave-start="max-h-screen opacity-100" x-transition:leave-end="max-h-0 opacity-0">

            <ul class="z-20">
                <li><a href="/" class="block px-4 py-3 text-black">Home</a></li>
                <li><a href="/products" class="block px-4 py-3 text-black">Product</a></li>
                <li><a href="/policy" class="block px-4 py-3 text-black">Privacy Policy</a></li>

                <!-- Display Signup and Login only if the user is not authenticated -->
                @guest
                <li><a href="/signup" class="block px-4 py-3 text-black">Signup</a></li>
                <li><a href="/login" class="block px-4 py-3 text-black">Login</a></li>
                @else
                <li><a href="/logout" class="block px-4 py-3 text-black">Logout</a></li>
                @endguest
            </ul>
        </nav>



        <!-- Search Bar (Mobile and Desktop) -->
        <form x-show="searchOpen" x-transition class="relative lg:hidden w-full z-10 ">
            <input type="search" name="search" class="w-full z-10 py-2 px-4 rounded-lg border border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Search..." required>
            <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-xl text-black">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </header>
    <div class="relative z-10 " x-show="cart" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <!--
    Background backdrop, show/hide based on slide-over state.

    Entering: "ease-in-out duration-500"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in-out duration-500"
      From: "opacity-100"
      To: "opacity-0"
  -->
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <!--
          Slide-over panel, show/hide based on slide-over state.

          Entering: "transform transition ease-in-out duration-500 sm:duration-700"
            From: "translate-x-full"
            To: "translate-x-0"
          Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
            From: "translate-x-0"
            To: "translate-x-full"
        -->
                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping cart</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button" x-on:click="cart = ! cart" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500">
                                            <span class="absolute -inset-0.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="flow-root">
                                        <div id="cart-container">
                                            <div class="mt-2 flex justify-end">
                                                <button id="remove-selected-btn" class="hidden bg-red-500 text-[14px] text-white px-2 py-2 rounded hover:bg-red-600" onclick="confirmRemoval()">
                                                    <i class="fa-solid fa-trash"></i> &nbsp; Remove
                                                </button>
                                            </div>

                                            <ul role="list" class="-my-6 divide-y divide-gray-200"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <p>Subtotal</p>
                                    <p id="totalprice">₹00.00</p>
                                </div>
                                <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                                <div class="mt-6">
                                    <a href="#" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                                </div>
                                <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                    <p>
                                        or
                                        <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Continue Shopping
                                            <span aria-hidden="true"> &rarr;</span>
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to shrink navbar on scroll -->
<script>
    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('navbar');
        const navbarContent = document.getElementById('navbar-content');
        const logoText = document.getElementById('logo-text');

        if (window.scrollY > 50) {
            navbar.classList.remove('sm:py-2');
            navbar.classList.remove('shadow-md');
            logoText.classList.add('text-xl');
            logoText.classList.remove('text-2xl');
            navbar.classList.add('shadow-md');
        } else {
            navbar.classList.add('sm:py-2');
            logoText.classList.remove('text-xl');
            logoText.classList.add('text-2xl');
        }
    });

</script>
<script>
    // Fetch cart count from the backend
    // Fetch cart count from the backend
    function fetchCartCount() {
        fetch('/cart/count') // Adjust the route as per your Laravel setup
            .then(response => response.json())
            .then(data => {
                const cartCountElement = document.getElementById('cart-count');
                const cartContainer = document.querySelector('#cart-container ul');
                cartCountElement.textContent = data.cartItemCount;
                console.log(data.cartItemCount);
                if (data.cartItemCount != 0) {
                    document.getElementById('remove-selected-btn').classList.remove('hidden');
                }
                if (data.cartItemCount == 0) {
                    document.getElementById('remove-selected-btn').classList.add('hidden');
                }
                console.log(data.cartItems);

                cartContainer.innerHTML = '';
                var totalPrice = 0; // Populate cart items
                data.cartItems.forEach(item => {
                    const cartItem = `
        <li class="flex py-4 items-center" id="cart-item-${item.id}">
            <div class="flex items-center">
                <input type="checkbox" class="cart-item-checkbox h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" data-id="${item.id}">
            </div>
            <div class="h-24 w-24 shrink-0 overflow-hidden rounded-md border border-gray-200 ml-4">
                <img src="${item.product_image}" style="filter:${item.color}" alt="${item.product_name}" class="h-full w-full object-cover">
            </div>
            <div class="ml-4 flex flex-1 flex-col">
                <div>
                    <div class="flex justify-between text-base font-medium text-gray-900">
                        <h3><a href="#">${item.product_name}</a></h3>
                        <p class="ml-4">₹${item.product_price}</p>
                    </div>
                </div>
                <div class="flex flex-1 items-end justify-between text-sm">
                    <p class="text-gray-500">Qty ${item.quantity}</p>
                    <div class="flex">
                        <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500 flex items-center" onclick="removeCartItem(${item.id})">
                            <div class="loader bg-opacity-75 hidden">
                                <div class="animate-spin h-4 w-4 border-2 border-t-white border-gray-500 rounded-full"></div>
                            </div>&nbsp; Remove
                        </button>
                    </div>
                </div>
            </div>
        </li>`;
                    cartContainer.insertAdjacentHTML('beforeend', cartItem);
                    totalPrice += parseFloat(item.product_price);
                });


                document.getElementById('totalprice').innerHTML = '₹' + totalPrice;
                console.log(totalPrice);
            })
            .catch(error => {
                console.error('Error fetching cart count:', error);
            });
    }

    // Call the function on page load or user login
    fetchCartCount();

</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        function removeCartItem(id) {
            const cartItem = document.querySelector(`#cart-item-${id}`);
            const loader = cartItem.querySelector('.loader');
            loader.classList.remove('hidden');

            const csrfTokenMetaTag = document.querySelector('meta[name="csrf-token"]');
            if (!csrfTokenMetaTag) {
                console.error('CSRF token meta tag not found.');
                return;
            }

            const csrfToken = csrfTokenMetaTag.getAttribute('content');

            fetch(`/cart/items/${id}`, {
                    method: 'GET'
                    , headers: {
                        'X-CSRF-TOKEN': csrfToken
                        , 'Content-Type': 'application/json'
                    , }
                , })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    cartItem.remove();
                    fetchCartCount();
                })
                .catch(error => {
                    console.error('Error removing cart item:', error);
                })
                .finally(() => {
                    loader.classList.add('hidden');
                });
        }

        function removeSelectedItems() {
            const selectedCheckboxes = document.querySelectorAll('.cart-item-checkbox:checked');
            const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.dataset.id);

            if (selectedIds.length === 0) {
                alert('No items selected!');
                return;
            }

            const csrfTokenMetaTag = document.querySelector('meta[name="csrf-token"]');
            if (!csrfTokenMetaTag) {
                console.error('CSRF token meta tag not found.');
                return;
            }

            const csrfToken = csrfTokenMetaTag.getAttribute('content');

            // Iterate over selected IDs and remove items
            selectedIds.forEach(id => {
                fetch(`/cart/items/${id}`, {
                        method: 'GET'
                        , headers: {
                            'X-CSRF-TOKEN': csrfToken
                            , 'Content-Type': 'application/json'
                        , }
                    , })
                    .then(response => response.json())
                    .then(data => {
                        //alert(data.message);
                        document.querySelector(`#cart-item-${id}`).remove();
                    })
                    .catch(error => {
                        console.error(`Error removing item with ID ${id}:`, error);
                    });
            });

            fetchCartCount(); // Refresh cart count after all items are removed
        }

        // Attach "Remove Selected Items" button event
        document.getElementById('remove-selected-btn').addEventListener('click', removeSelectedItems);

        // Attach the function to the global scope for single-item removal
        window.removeCartItem = removeCartItem;
    });

</script>

<script>
    function confirmRemoval() {
        // Show a confirmation dialog with "Yes" and "No" choices
        const isConfirmed = confirm("Are you sure you want to remove the selected items?");

        // If the user confirms (clicks Yes)
        if (isConfirmed) {
            // Your logic for removing the selected items goes here
            alert("Selected items removed.");
        } else {
            // If the user clicks No
            alert("Removal canceled.");
        }
    }

</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colors = ['red', 'orange', 'yellow', 'green', 'blue', 'purple', 'pink'];
        // shapes = ['circle', 'triangle', 'star']; // Define possible shapes
        const shapes = ['circle', 'star']; // Define possible shapes

        // Function to create a sprinkle particle
        function createSprinkle() {
            const sprinkle = document.createElement('div');
            sprinkle.classList.add('sprinkle');

            // Randomize color
            const color = colors[Math.floor(Math.random() * colors.length)];
            sprinkle.style.setProperty('--color', color);

            // Randomize shape
            const shape = shapes[Math.floor(Math.random() * shapes.length)];
            sprinkle.classList.add(shape);

            // Randomize position (both horizontally and vertically) within the header
            const leftPosition = Math.random() * 100; // Random horizontal position (0-100%)
            const topPosition = Math.random() * 100; // Random vertical position (0-100%)

            // Randomize animation delay
            const animationDelay = Math.random() * 2; // Random animation delay

            sprinkle.style.left = `${leftPosition}%`;
            sprinkle.style.top = `${topPosition}%`;
            sprinkle.style.animationDelay = `${animationDelay}s`;

            // Add sprinkle to the header container
            document.querySelector('header').appendChild(sprinkle);
        }

        // Create a random number of sprinkles (for example, 50 sprinkles)
        for (let i = 0; i < 30; i++) {
            createSprinkle();
        }
    });

</script>
<script>
    document.getElementById('notificationButton').addEventListener('click', () => {
        // Check if the browser supports notifications
        if (!('Notification' in window)) {
            alert('Notifications are not supported in your browser. Please use a supported browser.');
            return;
        }

        // Check current notification permission
        if (Notification.permission === 'granted') {
            alert('You have already granted notification permissions.');
            // Optionally, show a test notification
            new Notification('Test Notification', {
                body: 'This is a test message.'
                , icon: 'https://via.placeholder.com/100' // Optional: Add a URL to the notification icon
            });
            return;
        }

        // Request notification permission
        Notification.requestPermission().then(permission => {
            if (permission === 'granted') {
                // Show notification
                new Notification('Notification Title', {
                    body: 'This is the notification message.'
                    , icon: 'https://via.placeholder.com/100' // Optional: Add a URL to the notification icon
                });
            } else if (permission === 'denied') {
                alert('Notification permission denied.');
            } else {
                alert('Notification permission was closed without a response.');
            }
        }).catch(error => {
            console.error('Error requesting notification permission:', error);
            alert('An error occurred while requesting notification permission. Please try again.');
        });
    });

</script><!-- Bottom Navigation -->
<nav class="fixed bottom-0 left-0 right-0 bg-gradient-to-t from-white to-gray-50 shadow-xl z-40 md:hidden   ">
    <div class="flex justify-around py-2 px-3 rounded-t-xl bg-white/70 backdrop-blur-md shadow-md bg-gradient-to-br from-indigo-100 to-white shadow-lg" x-data="{ open: false, activeButton: '' }">

        <!-- Home Button -->
        <button class="{{ Request::is('/') ? 'text-indigo-600' : 'text-black' }} flex flex-col items-center transition duration-300"
                @click="activeButton = 'home'; window.location.href='/'">
            <div class="p-2 rounded-full bg-gradient-to-br from-indigo-100 to-white shadow-lg transform transition-transform duration-300 ease-out">
                <i class="fas fa-home text-xs !w-[20px] !h-[20px]"></i> <!-- Reduced icon size -->
            </div>
            <span class="text-xs mt-1">Home</span> <!-- Smaller text -->
        </button>

        <!-- Product Button -->
        <button class="{{ Request::is('products') ? 'text-indigo-600' : 'text-black' }} flex flex-col items-center transition duration-300"
                @click="activeButton = 'products'; window.location.href='/products'">
            <div class="p-2 rounded-full bg-gradient-to-br from-indigo-100 to-white shadow-lg transform transition-transform duration-300 ease-out">
                <i class="fa-solid fa-shop text-xs !w-[20px] !h-[20px]"></i> <!-- Reduced icon size -->
            </div>
            <span class="text-xs mt-1">Products</span> <!-- Smaller text -->
        </button>

        <!-- Cart Button -->
        <button class="{{ Request::is('cart') ? 'text-indigo-600' : 'text-black' }} flex flex-col items-center transition duration-300"
                @click="activeButton = 'cart'; window.location.href='/cart'">
            <div class="p-2 rounded-full bg-gradient-to-br from-indigo-100 to-white shadow-lg transform transition-transform duration-300 ease-out">
                <i class="fas fa-shopping-cart text-xs !w-[20px] !h-[20px]"></i> <!-- Reduced icon size -->
            </div>
            <span class="text-xs mt-1">Cart</span> <!-- Smaller text -->
        </button>

        <!-- Profile Button (Authenticated Users) -->
        @if(auth()->check())
        <button class="{{ Request::is('userprofile') ? 'text-indigo-600' : 'text-black' }} flex flex-col items-center transition duration-300"
                @click="activeButton = 'account'; open = ! open">
            <div class="p-2 rounded-full bg-gradient-to-br from-indigo-100 to-white shadow-lg transform transition-transform duration-300 ease-out">
                <i class="fa-solid fa-user text-xs !w-[20px] !h-[20px]"></i> <!-- Reduced icon size -->
            </div>
            <span class="text-xs mt-1">Account</span> <!-- Smaller text -->
        </button>
        <!-- Dropdown for profile menu -->
        <div x-show="open" class="fixed bottom-[70px] right-0 mt-8 w-48 bg-white rounded-lg shadow-lg py-2 z-10 text-gray-700" x-cloak>
            <a href="{{ route('userprofile', ['id' => auth()->user()->id]) }}" class="block px-4 py-2 text-xs hover:bg-gray-100 hover:text-indigo-600">Your Profile</a>
            <a href="/settings" class="block px-4 py-2 text-xs hover:bg-gray-100 hover:text-indigo-600">Settings</a>
            <a href="/logout" class="block px-4 py-2 text-xs hover:bg-gray-100 hover:text-indigo-600">Sign out</a>
        </div>
        @else
        <!-- Login Button (Non-authenticated Users) -->
        <button class="{{ Request::is('login') ? 'text-indigo-600' : 'text-black' }} flex flex-col items-center transition duration-300"
                onclick="window.location.href='/login'">
            <div class="p-2 rounded-full bg-gradient-to-br from-indigo-100 to-white shadow-lg transform transition-transform duration-300 ease-out">
                <i class="fa-solid fa-right-to-bracket text-xs !w-[20px] !h-[20px]"></i> <!-- Reduced icon size -->
            </div>
            <span class="text-xs mt-1">Login</span> <!-- Smaller text -->
        </button>
        @endif

    </div>
</nav>
