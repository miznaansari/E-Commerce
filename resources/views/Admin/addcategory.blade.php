<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
@include('Admin.components.navbar')

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-4 text-center text-3xl font-extrabold tracking-tight text-indigo-600">Add New Category</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="/categories" method="POST">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <div class="mt-2">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" autocomplete="off" required class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-500 sm:text-sm">
                </div>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Category Description</label>
                <div class="mt-2">
                    <textarea name="description" id="description" rows="4" class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-indigo-600">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('a[href]');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('bg-indigo-700', 'text-white');
                link.classList.remove('text-gray-900');
            }
        });
    });
</script>
</html>
