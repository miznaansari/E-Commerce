<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLEVAR</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="allcss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        .footer ul li {
            margin-bottom: 1rem;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }


        .hero {
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-wrap: wrap-reverse;
            background: #f9f9f9;
        }

        .hero-text {
            max-width: 50%;
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



        .hero-text {
            padding: 100px 10px;
            padding-right: 50px;
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


        /*customize*/

        .col-size {
            border: 1PX solid gray;
            border-radius: 100%;
            height: 30px;
            width: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            margin: 3px;
            color: rgb(54, 54, 54);
        }

        .col-size:hover {
            color: white;
            background: gray;
        }

        .sideimg {
            border: 1px solid #c2c2c2;
            width: 52px;
            height: 66px;
            margin: 0 auto;
            cursor: pointer;
        }

        .product-img-row {
            display: flex;
        }

        .product-img {
            width: 403px;
            height: 523px
        }

        @media (max-width: 768px) {
            .product-img {
                width: 100%;
                height: 423px
            }

            .product-small-img-col {
                flex-direction: row !important;
                margin-right: 0px !important;
            }

            .product-img-row {
                justify-content: center;
                flex-wrap: wrap-reverse;
            }

            .row {
                flex-wrap: wrap;
            }

            .nav-mobile {
                display: block;
                overflow: hidden;
                width: 0%;
            }

            .desktop {
                display: block;
            }

            .mobile {
                display: none;
            }

            .hero-text {
                padding: 10px;
                max-width: 100%;
                position: absolute;
                background: #ffffffb0;
                bottom: 0;
                padding-top: 300px;
                padding-bottom: 30px;
            }

            header {}



        }

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div>
        <div id="visitor-count">{{ cache('visitor_count') }}</div>
    </div>

    <h1></h1>
    <div id="loaders" class="fixed inset-0 flex items-center justify-center bg-RED-900">
    <p class="text-white">Loading...</p>
</div>

<div id="content" class="hidden">

    @include('components.navbar')
 

    <div style="color: #6d6d6d; font-size: 11px;">Home / Men / Western Wear / Tshirt</div>

    <div class="row" style="display: flex; justify-content: space-around;">
        <div cla  ss="col">
            <div class="product-img-row" style="display: flex;">
                <div class="product-small-img-col" style="display: flex; gap: 10px; flex-direction: column; align-items: center; justify-content: center; margin-right: 100px;">
                    @foreach ($productimg as $image)
                    <img class="sideimg" src="{{ asset('productimg/'.$image->image_path) }}" alt="" onclick="updateBigImage(this)">
                    @endforeach
                </div>
                <div class="col">
                  <img 
    src="{{ asset($product->thumbnail) }}" 
    width="403px" 
    height="523px" 
    class="product-img" 
    id="big-image" 
    alt="Product Image">



                </div>
            </div>
        </div>
        <!-- Product Section -->



        <!-- Product Info -->
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl text-center">{{ $product->name }}</h1>
            <p class="text-3xl tracking-tight text-gray-900 mt-4 text-center">₹{{ $product->price }}</p>

            @php
            $discount = floor(($product->price * 10) / 100)
            @endphp
            <p class="text-gray-500 line-through text-center">₹{{ $product->price + $discount }} <span class="text-green-600 ml-2">(10% off)</span></p>

            <!-- Product Description -->
            <div class="mt-6 text-center">
                <h3 class="sr-only">Description</h3>
                <p class="text-gray-700">{{ $product->description }}</p>
            </div>

            <!-- Customization Options -->
            <div class="mt-6 text-center">
                <h3 class="text-sm font-medium text-gray-900">Select Size</h3>
                <div class="flex justify-center space-x-2 mt-2">
                    <button class="px-4 py-2 border rounded-lg text-sm hover:bg-gray-100" onclick="selectSize(this)">S</button>
                    <button class="px-4 py-2 border rounded-lg text-sm hover:bg-gray-100" onclick="selectSize(this)">M</button>
                    <button class="px-4 py-2 border rounded-lg text-sm hover:bg-gray-100" onclick="selectSize(this)">L</button>
                    <button class="px-4 py-2 border rounded-lg text-sm hover:bg-gray-100" onclick="selectSize(this)">XL</button>
                    <button class="px-4 py-2 border rounded-lg text-sm hover:bg-gray-100" onclick="selectSize(this)">XXL</button>
                </div>
            </div>

            <div class="mt-6 text-center">
                <h3 class="text-sm font-medium text-gray-900">Select Color</h3>
                <p id="colorname"></p>
                <div class="flex justify-center space-x-2 mt-2">
                    <div class="w-6 h-6 rounded-full bg-red-500 border cursor-pointer" onclick="selectColor(this)"></div>
                    <div class="w-6 h-6 rounded-full bg-blue-500 border cursor-pointer" onclick="selectColor(this)"></div>
                    <div class="w-6 h-6 rounded-full bg-green-500 border cursor-pointer" onclick="selectColor(this)"></div>
                    <div class="w-6 h-6 rounded-full bg-yellow-500 border cursor-pointer" onclick="selectColor(this)"></div>
                    <input type="color" class="w-10 h-10 p-0 border rounded-lg" onchange="manualColorChange(this)">
                </div>
            </div>

            <!-- Actions -->
            
            <div class="mt-10 grid grid-cols-2 gap-4">
                <button class="flex items-center bg-green-600 text-white px-6 py-3 rounded-lg text-sm hover:bg-green-700" onclick="addToCart()">
<div id="loader" class=" bg-opacity-75 hidden">
    <div class="animate-spin h-4 w-4 border-2 border-t-white border-gray-500 rounded-full"></div>
</div>&nbsp;

        <i class="fas fa-shopping-cart"></i>&nbsp;  Add to Cart
                </button>
                <button class="border border-green-600 text-green-600 px-6 py-3 rounded-lg text-sm hover:bg-green-50" onclick="buyNow()">
                    <i class="fas fa-credit-card"></i> Buy Now
                </button>
            </div>
        </div>
    </div>

  
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div class="group relative">
                    <img src="https://tailwindui.com/plus/img/ecommerce-images/product-page-01-related-product-01.jpg" alt="Front of men&#039;s Basic Tee in black." class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80">
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a href="#">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    Basic Tee
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">Black</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900">$35</p>
                    </div>
                </div>

                <!-- More products... -->
            </div>
        </div>
    </div>
    <canvas id="canvas"></canvas>
    <h1>sdfd</h1>
    <button onclick="logFilteredColor()" class="btn">asdfadf</button>
    <script>
    document.getElementById('get-color-btn').onclick = () => {
        const img = document.getElementById('big-image');
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d', { willReadFrequently: true });
        const colorPreview = document.getElementById('color-preview');
        
        // Function to convert RGB to the closest color name
        function rgbToColorName(r, g, b) {
            const  colorMap = {
    "white": [255, 255, 255],
    "black": [0, 0, 0],
    "red": [255, 0, 0],
    "green": [0, 128, 0],
    "blue": [0, 0, 255],
    "yellow": [255, 255, 0],
    "cyan": [0, 255, 255],
    "magenta": [255, 0, 255],
    "brown": [148, 75, 0],
    "gray": [128, 128, 128],
    "lightgray": [211, 211, 211],
    "darkgray": [169, 169, 169],
    "lightblue": [173, 216, 230],
    "darkblue": [0, 0, 139],
    "lightgreen": [144, 238, 144],
    "darkgreen": [0, 100, 0],
    "lightyellow": [255, 255, 224],
    "darkyellow": [204, 204, 0],
    "lightpink": [255, 182, 193],
    "darkpink": [255, 105, 180],
    "lightcyan": [224, 255, 255],
    "darkcyan": [0, 139, 139],
    "lightred": [255, 99, 71],
    "darkred": [139, 0, 0],
    "lightorange": [255, 165, 0],
    "darkorange": [255, 140, 0],
    "lightpurple": [221, 160, 221],
    "darkpurple": [128, 0, 128],
    "gold": [255, 215, 0],
    "silver": [192, 192, 192],
    "indigo": [75, 0, 130],
    "violet": [238, 130, 238],
    "peach": [255, 218, 185],
    "ivory": [255, 255, 240],
    "teal": [0, 128, 128],
    "olive": [128, 128, 0],
    "chartreuse": [127, 255, 0],
    "azure": [240, 255, 255],
    "beige": [245, 245, 220],
    "mint": [189, 252, 201],
    "plum": [221, 160, 221],
    "periwinkle": [204, 204, 255],
    "tan": [210, 180, 140],
    "salmon": [250, 128, 114],
    "lavender": [230, 230, 250],
    "coral": [255, 127, 80]
};


            function getDistance(color1, color2) {
                return Math.sqrt(
                    Math.pow(color1[0] - color2[0], 2) +
                    Math.pow(color1[1] - color2[1], 2) +
                    Math.pow(color1[2] - color2[2], 2)
                );
            }

            let closestColor = null;
            let smallestDistance = Infinity;

            for (const [name, rgb] of Object.entries(colorMap)) {
                const distance = getDistance([r, g, b], rgb);
                if (distance < smallestDistance) {
                    smallestDistance = distance;
                    closestColor = name;
                }
            }

            return closestColor || "Unknown color";
        }

        // Ensure the image is loaded
        if (!img.complete) {
            console.error('Image is not loaded yet.');
            return;
        }

        // Apply filters
        const computedStyle = getComputedStyle(img);
        const filterValue = computedStyle.filter;
        console.log(`Applied filter: ${filterValue}`);

        // Set canvas dimensions to match the image
        canvas.width = img.naturalWidth;
        canvas.height = img.naturalHeight;

        // Apply filter and draw the image to canvas
        ctx.filter = filterValue;
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        // Get pixel data from the center of the image
        const x = Math.floor(canvas.width / 2);
        const y = Math.floor(canvas.height / 2);
        const pixelData = ctx.getImageData(x, y, 1, 1).data;

        // Extract RGB values
        const [r, g, b] = pixelData;

        if (r === undefined || g === undefined || b === undefined) {
            console.error('Unable to retrieve pixel data.');
            return;
        }

        // Display RGB color
        const color = `rgb(${r}, ${g}, ${b})`;
        console.log(`Filtered color: ${color}`);
        colorPreview.style.backgroundColor = color;

        // Get and display the closest color name
        const colorName = rgbToColorName(r, g, b);
        console.log(`Closest color name: ${colorName}`);
        alert(`Filtered color: ${color}\nClosest color name: ${colorName}`);
        document.getElementById('colorname').innerHTML=colorName;
    };
</script>



    @include('components.footer')
      </div>
    </div>
    </body>
   <script>
    let selectedSize = null;
    let selectedColor = null;
    const productId = {{ $product->id }};  // Get the product ID dynamically from the server

    // Update the big image when a small image is clicked
    function updateBigImage(imgElement) {
        const bigImage = document.getElementById('big-image');
        bigImage.src = imgElement.src;
    }

    // Handle size selection
    function selectSize(sizeElement) {
        const sizes = document.querySelectorAll('.col-size');
        sizes.forEach(size => size.style.backgroundColor = '');
        sizeElement.style.backgroundColor = 'gray';
        selectedSize = sizeElement.textContent;
    }

    // Handle color selection (predefined colors)
    function selectColor(colorElement) {
        const colors = document.querySelectorAll('.col-size');
        colors.forEach(color => color.style.outline = '');
        colorElement.style.outline = '3px solid black';
        selectedColor = window.getComputedStyle(colorElement).backgroundColor;

        // Change the T-shirt color using hue-rotate filter
        const bigImage = document.getElementById('big-image');
        const hueValue = getHueFromColor(selectedColor);
        bigImage.style.filter = `hue-rotate(${hueValue}deg)`;
        bigImage.style.backgroundColor = selectedColor;
    }

    // Function to calculate hue-rotate based on RGB color
    function getHueFromColor(color) {
        const rgb = parseColor(color);
        if (!rgb) return 0;

        const { r, g, b } = rgb;

        // Calculate hue based on RGB using a simplified method
        const hue = (Math.atan2(Math.sqrt(3) * (g - b), 2 * r - g - b) * (180 / Math.PI)) % 360;
        return hue;
    }

    // Function to handle manual color picker change
    function manualColorChange(colorPicker) {
        const customColor = colorPicker.value;

        // Change the T-shirt color
        const bigImage = document.getElementById('big-image');
        bigImage.style.backgroundColor = customColor;

        // Apply hue rotation filter to change color based on the manual color
        const hueValue = getHueFromColor(customColor);
        bigImage.style.filter = `hue-rotate(${hueValue}deg)`; // Add hue-rotate filter

        // Set the selected color to the custom color
        selectedColor = customColor;
    }

    // Helper function to parse color and return RGB object
    function parseColor(color) {
        if (color.startsWith('rgb')) {
            const [r, g, b] = color.match(/\d+/g).map(Number);
            return { r, g, b };
        }

        if (color.startsWith('#')) {
            return hexToRgb(color);
        }

        return null;
    }

    // Helper function to convert hex color to RGB object
    function hexToRgb(hex) {
        hex = hex.replace(/^#/, '');
        if (hex.length === 6) {
            const bigint = parseInt(hex, 16);
            return { r: (bigint >> 16) & 255, g: (bigint >> 8) & 255, b: bigint & 255 };
        }
        return null;
    }

    // Add item to cart
 function addToCart() {

        

    if (!selectedSize || !selectedColor) {
        alert('Please select a size and color.');
        return;
    }
    const img = document.getElementById('big-image');
           const computedStyle = getComputedStyle(img);
        const filterValue = computedStyle.filter;
        console.log(`Applied filter: ${filterValue}`);

    // Show the loader
    const loader = document.getElementById('loader');
    loader.classList.remove('hidden');

    // Get CSRF token from meta tag (if you have this in your HTML)
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send AJAX request to backend to add the product to the cart
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken, // Laravel CSRF token
        },
        body: JSON.stringify({
            product_id: productId,
            size: selectedSize,
            color: filterValue,
            price: {{ $product->price }},
            quantity: 1, // Default quantity, can be extended for quantity selection
        }),
    })
    .then(response => response.json())
    .then(data => {
        // Hide the loader
        loader.classList.add('hidden');

        if (data.message) {
            alert(data.message);
            fetchCartCount(); // Refresh cart count if successful
        } else {
            alert('Failed to add product to cart. Please try again.');
        }
    })
    .catch(error => {
        // Hide the loader
        loader.classList.add('hidden');

        console.error('Error:', error);
        alert('An error occurred while adding the product to the cart.');
    });
}



    // Buy item immediately
    function buyNow() {
        if (!selectedSize || !selectedColor) {
            alert('Please select a size and color.');
            return;
        }
        alert(`Proceeding to buy:\nSize: ${selectedSize}\nColor: ${selectedColor}`);
        // Add AJAX or API request here for backend integration.
    }

</script>





 <script>
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('loaders').style.display = 'none';
        document.getElementById('content').classList.remove('hidden');
    });
</script>
</html>
