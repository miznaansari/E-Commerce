<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-commerce</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Chart.js for the Line Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    @include('Admin.components.navbar')

    <div class="px-6 py-8 sm:px-12 sm:py-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-semibold text-indigo-900 mb-6">Admin Dashboard</h1>

            <!-- Dashboard Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Orders -->
                <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-indigo-600">
                    <h2 class="text-lg font-medium text-indigo-700">Total Orders</h2>
                    <p class="mt-2 text-3xl text-gray-800">{{ $totalOrders }}</p>
                </div>

                <!-- Total Revenue -->
                <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-indigo-600">
                    <h2 class="text-lg font-medium text-indigo-700">Total Revenue</h2>
                    <p class="mt-2 text-3xl text-gray-800">${{ number_format($totalRevenue, 2) }}</p>
                </div>
                <!-- Total Customer -->
                <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-indigo-600">
                    <h2 class="text-lg font-medium text-indigo-700">Total Customer</h2>
                    <p class="mt-2 text-3xl text-gray-800">{{ $totalcustomers }}</p>
                    <p class="text-sm text-gray-600 flex items-center">
                        <i class="fas fa-arrow-up text-green-500 mr-1"></i>
                        {{$todayCustomersCount}} New Customers Today
                    </p>
                </div>

                <!-- Total Products Added -->
                <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-indigo-600">
                    <h2 class="text-lg font-medium text-indigo-700">Total Products Added</h2>
                    <p class="mt-2 text-3xl text-gray-800">{{ $totalProducts }}</p>
                </div>

                <!-- Out of Stock -->
                <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-indigo-600">
                    <h2 class="text-lg font-medium text-indigo-700">Out of Stock</h2>
                    <p class="mt-2 text-3xl text-gray-800">{{ $outOfStock }} Products</p>
                </div>
            </div>

            <!-- Best Seller & Categories -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Best Seller Item -->
                <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-indigo-600">
                    <h2 class="text-lg font-medium text-indigo-700">Best Selling Item</h2>
                    <p class="mt-2 text-xl text-gray-800">{{ $bestSellingItem ? $bestSellingItem->name : 'No Products Sold' }}</p>
                </div>

                <!-- Best Selling Category -->
                <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-indigo-600">
                    <h2 class="text-lg font-medium text-indigo-700">Best Selling Category</h2>
                    <p class="mt-2 text-xl text-gray-800">{{ $bestSellingCategory ? $bestSellingCategory->name : 'No Categories' }}</p>
                </div>

                <!-- Monthly Sales Chart -->
                <div class="bg-white shadow-lg rounded-lg p-6 border-l-4 border-indigo-600">
                    <h2 class="text-lg font-medium text-indigo-700">Monthly Sales</h2>
                    <canvas id="salesChart" class="mt-4"></canvas>
                </div>
            </div>

            <!-- Line Chart Script -->
            <script>
                const ctx = document.getElementById('salesChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line'
                    , data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                        , datasets: [{
                            label: 'Sales ($)'
                            , data: [1200, 1300, 1450, 1600, 1700, 1800, 2100, 2200, 2500, 2300, 2600, 2700]
                            , borderColor: 'rgb(56, 189, 248)',
                            /* Tailwind indigo */
                            backgroundColor: 'rgba(56, 189, 248, 0.2)'
                            , tension: 0.4
                            , fill: true
                        , }]
                    , }
                    , options: {
                        responsive: true
                        , plugins: {
                            legend: {
                                position: 'top'
                            , }
                            , tooltip: {
                                enabled: true
                            , }
                        , }
                        , scales: {
                            x: {
                                title: {
                                    display: true
                                    , text: 'Month'
                                , }
                            , }
                            , y: {
                                title: {
                                    display: true
                                    , text: 'Revenue ($)'
                                , }
                            , }
                        , }
                    , }
                , });

            </script>

        </div>
    </div>
</body>

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

</html>
