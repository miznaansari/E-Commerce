<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
@include('Admin.components.navbar')

<div class="flex min-h-full flex-col justify-center px-4 py-10 lg:px-10">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
        <h2 class="mt-4 text-center text-3xl font-extrabold tracking-tight text-indigo-600">Add New Product</h2>
    </div>

    <div class="mt-10 flex flex-col md:flex-row sm:mx-auto sm:w-full sm:max-w-[60rem] gap-8">
        <!-- Form Section -->
        <div class="w-full md:w-1/2">
      <form id="productForm" class="space-y-6 bg-white p-6 rounded-lg shadow-lg border border-gray-200" action="/products" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name" class="block text-sm font-medium text-gray-900">Product Name</label>
        <div class="mt-2">
            <input type="text" name="name" id="name" autocomplete="off" required 
                class="block w-full rounded-md bg-gray-50 px-3 py-2 text-base text-gray-900 border-2 border-gray-300 focus:outline-indigo-600 focus:ring-2 focus:ring-indigo-500 sm:text-sm"
                value="{{ old('name') }}" oninput="updatePreview()">
            @error('name')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-900">Product Description</label>
        <div class="mt-2">
            <textarea name="description" id="description" rows="4" required
                class="block w-full rounded-md bg-gray-50 px-3 py-2 text-base text-gray-900 border-2 border-gray-300 focus:outline-indigo-600 focus:ring-2 focus:ring-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div>
        <label for="stock" class="block text-sm font-medium text-gray-900">Stock Quantity</label>
        <div class="mt-2">
            <input type="number" name="stock" id="stock" min="0" required 
                class="block w-full rounded-md bg-gray-50 px-3 py-2 text-base text-gray-900 border-2 border-gray-300 focus:outline-indigo-600 focus:ring-2 focus:ring-indigo-500 sm:text-sm"
                value="{{ old('stock') }}" oninput="updatePreview()">
            @error('stock')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div>
        <label for="price" class="block text-sm font-medium text-gray-900">Price ($)</label>
        <div class="mt-2">
            <input type="number" name="price" id="price" min="0" step="0.01" required 
                class="block w-full rounded-md bg-gray-50 px-3 py-2 text-base text-gray-900 border-2 border-gray-300 focus:outline-indigo-600 focus:ring-2 focus:ring-indigo-500 sm:text-sm"
                value="{{ old('price') }}" oninput="updatePreview()">
            @error('price')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-900">Category</label>
        <div class="mt-2">
            <select name="category_id" id="category_id" required 
                class="block w-full rounded-md bg-gray-50 px-3 py-2 text-base text-gray-900 border-2 border-gray-300 focus:outline-indigo-600 focus:ring-2 focus:ring-indigo-500 sm:text-sm"
                onchange="updatePreview()">
                <option value="">Select Category</option>
                <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>Electronics</option>
                <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>Clothing</option>
                <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>Books</option>
                <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>Home Goods</option>
            </select>
            @error('category_id')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>
<div>
    <label class="block text-sm font-medium text-gray-900">Product Sizes</label>
    <div id="sizesContainer" class="space-y-4 mt-4">
        <!-- Dynamic Size Inputs will be added here -->
    </div>
    <button type="button" 
        class="mt-2 rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500"
        onclick="addSizeField()">Add Size</button>
</div>

    

    <div>
        <label for="thumbnail" class="block text-sm font-medium text-gray-900">Main Product Image</label>
        <div class="mt-2">
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required
                class="block w-full rounded-md bg-gray-50 px-3 py-2 text-base text-gray-900 border-2 border-gray-300 focus:outline-indigo-600 focus:ring-2 focus:ring-indigo-500 sm:text-sm"
                onchange="updatePreviewImage(event)">
            @error('thumbnail')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div>
        <label for="images" class="block text-sm font-medium text-gray-900">Additional Images</label>
        <div class="mt-2">
            <input type="file" name="images[]" id="images" accept="image/*" multiple
                class="block w-full rounded-md bg-gray-50 px-3 py-2 text-base text-gray-900 border-2 border-gray-300 focus:outline-indigo-600 focus:ring-2 focus:ring-indigo-500 sm:text-sm">
            @error('images')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div>
        <button type="submit" 
            class="w-full rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Add Product
        </button>
    </div>
</form>

    

        </div>

        <!-- Preview Section -->
        <div class="w-full md:w-1/2">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Product Preview</h3>
            <div class="p-4 bg-white rounded-lg shadow-md border border-gray-200">
                <div class="flex flex-col items-center">
                    <!-- Product Image -->
                    <div id="previewImage" class="h-48 w-48 mb-4 bg-gray-100 rounded-lg border flex items-center justify-center">
                        <span class="text-gray-500 text-sm">No Image</span>
                    </div>

                    <!-- Product Name -->
                    <h3 id="previewName" class="text-xl font-bold text-indigo-700">Product Name</h3>

                    <!-- Product Description -->
                    <p id="previewDescription" class="text-gray-600 text-sm mt-2 text-center">
                        Description will appear here.
                    </p>

                    <!-- Stock and Price -->
                    <div class="flex items-center justify-between w-full mt-4 px-4">
                        <p class="text-sm text-gray-700">
                            <strong>Stock:</strong> <span id="previewStock">-</span>
                        </p>
                        <p class="text-sm text-gray-700">
                            <strong>Price:</strong> $<span id="previewPrice">-</span>
                        </p>
                    </div>

                    <!-- Category -->
                    <p id="previewCategory" class="text-sm mt-4 text-gray-500">
                        Category: Not Selected
                    </p>

                    <!-- View Product (Placeholder for Action) -->
                    <a href="#" class="inline-block mt-6 px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded hover:bg-indigo-500">
                        View Product
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updatePreview() {
        document.getElementById('previewName').textContent = document.getElementById('name').value || '-';
        document.getElementById('previewDescription').textContent = document.getElementById('description').value || '-';
        document.getElementById('previewStock').textContent = document.getElementById('stock').value || '-';
        document.getElementById('previewPrice').textContent = document.getElementById('price').value || '-';
        const category = document.getElementById('category_id');
        document.getElementById('previewCategory').textContent = category.options[category.selectedIndex].text || '-';
    }

    function updatePreviewImage(event) {
        const preview = document.getElementById('previewImage');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Product Image" class="h-32 w-32 object-cover rounded-md">`;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '<span class="text-gray-500 text-sm">No Image</span>';
        }
    }
</script>

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
<script>
// Function to send text to the server and get rephrasing suggestion
function updateDes() {
    const description = document.getElementById('description').value;

    // Split the text into words and check if there are more than 5 words
    const wordCount = description.trim().split(/\s+/).length;

    if (wordCount > 5) {  // Only send if word count is greater than 5
        fetch('/suggest-rephrase', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ description })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('suggestions').textContent = data.suggestion || "No suggestion available.";
        })
        .catch(err => console.error('Error:', err));
    } else {
        // Clear the suggestion box if the word count is 5 or less
        document.getElementById('suggestions').textContent = "Please enter more than 5 words.";
    }
}
</script>


</body><script>
   function addSizeField() {
    const container = document.getElementById('sizesContainer');
    const sizeIndex = container.children.length; // Get the current number of size fields
    const sizeHTML = `
        <div class="flex space-x-4" id="sizeField-${sizeIndex}">
            <input type="text" name="sizes[${sizeIndex}][size]" placeholder="Size (e.g., S, M, L)" required
                class="block w-full rounded-md bg-gray-50 px-3 py-2 text-base text-gray-900 border-2 border-gray-300 focus:outline-indigo-600 focus:ring-2 focus:ring-indigo-500 sm:text-sm">
            <input type="number" name="sizes[${sizeIndex}][stock]" placeholder="Stock" min="0" required
                class="block w-full rounded-md bg-gray-50 px-3 py-2 text-base text-gray-900 border-2 border-gray-300 focus:outline-indigo-600 focus:ring-2 focus:ring-indigo-500 sm:text-sm">
            <button type="button" onclick="removeSizeField(${sizeIndex})" class=" rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500">
                Remove 
            </button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', sizeHTML);
}

function removeSizeField(sizeIndex) {
    const sizeField = document.getElementById(`sizeField-${sizeIndex}`);
    if (sizeField) {
        sizeField.remove();
    }
}

</script>
</html>
