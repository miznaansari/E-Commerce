    <nav class="bg-gray-200" x-data="{ menu: false }">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button -->
                    <button x-on:click="menu = !menu" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed -->
                        <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Icon when menu is open -->
                        <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex shrink-0 items-center">
                        <img class="h-14 w-auto" src="{{ url('img/clever.png') }}" alt="Admin Panel">
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        <div class="flex space-x-4">
                            <!-- Admin Panel Buttons -->
                            <a href="/dashboard" class="rounded-md px-3 py-2 text-sm font-medium text-black300 hover:bg-gray-700 hover:text-white">Dashboard</a>
                            <a href="/addproduct" class="rounded-md px-3 py-2 text-sm font-medium text-black300 hover:bg-gray-700 hover:text-white">Add Product</a>
                            <a href="/addcategory" class="rounded-md px-3 py-2 text-sm font-medium text-black300 hover:bg-gray-700 hover:text-white">Add Category</a>
                            <a href="/sendnotification" class="rounded-md px-3 py-2 text-sm font-medium text-black300 hover:bg-gray-700 hover:text-white">Send Notification</a>
                            <a href="/addcart" class="rounded-md px-3 py-2 text-sm font-medium text-black300 hover:bg-gray-700 hover:text-white">Customer Cart</a>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <div class="relative ml-3" x-data="{ open: false }">
                        <div>
                            <button type="button" x-on:click="open = !open" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </button>
                        </div>

                        <div x-show="open" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Your Profile</a>
                            <a href="/settings" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Settings</a>
                            <a href="/logout" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="menu" class="sm:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <a href="/dashboard" class="rounded-md px-3 py-2 text-sm font-medium text-black300 hover:bg-gray-700 hover:text-white block">Dashboard</a>
                <a href="/addproduct" class="rounded-md px-3 py-2 text-sm font-medium text-black300 hover:bg-gray-700 hover:text-white block">Add Product</a>
                <a href="/addcategory" class="rounded-md px-3 py-2 text-sm font-medium text-black300 hover:bg-gray-700 hover:text-white block">Add Category</a>
                <a href="/sendnotification" class="rounded-md px-3 py-2 text-sm font-medium text-black300 hover:bg-gray-700 hover:text-white block">Send Notification</a>
                <a href="/addcart" class="rounded-md px-3 py-2 text-sm font-medium text-black300 hover:bg-gray-700 hover:text-white block">Add Cart</a>
            </div>
        </div>
    </nav>
