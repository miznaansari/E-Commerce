<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notification</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
@include('Admin.components.navbar')

<div class="flex flex-col justify-center px-6 py-6 lg:px-8">
    <h2 class="text-center text-3xl font-extrabold tracking-tight text-indigo-600 mb-6">Send Notification</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Form Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form class="space-y-6" action="/send-notification" method="POST">
                @csrf
                <div>
                    <label for="fcm_token" class="block text-sm font-medium text-gray-700">User FCM Token</label>
                    <div class="mt-2">
                        <input type="text" name="fcm_token" id="fcm_token" value="{{ old('fcm_token') }}" autocomplete="off" required
                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-500 sm:text-sm">
                    </div>
                    @error('fcm_token')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Notification Title</label>
                    <div class="mt-2">
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required
                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-500 sm:text-sm">
                    </div>
                    @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700">Notification Body</label>
                    <div class="mt-2">
                        <textarea name="body" id="body" rows="4" required
                            class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-500 sm:text-sm">{{ old('body') }}</textarea>
                    </div>
                    @error('body')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-indigo-600">
                        Send Notification
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Section -->
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg lg:text-xl font-semibold text-gray-800">Users List</h3>
        <input 
            type="text" 
            id="searchInput" 
            class="px-1 lg:px-4 py-2 border border-gray-300 rounded" 
            placeholder="Search by Name or Email" 
             oninput="filterTable()"
        />
    </div>
    <div class="overflow-x-auto">
        <table id="userTable" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">FCM Token</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($fcmTokens as $token)
                <tr class="user-row">
                    <td class="px-6 py-2 text-sm text-gray-700">{{ $token->id }}</td>
                    <td class="px-6 py-2 text-sm text-gray-700">{{ $token->customer->first_name ?? 'N/A' }}</td>
                    <td class="px-6 py-2 text-sm text-gray-700">
                        <span class="truncate w-64 inline-block overflow-hidden text-ellipsis">
                            {{ $token->fcm_token }}
                        </span>
                        <button class="text-blue-500 hover:underline" onclick="viewToken('{{ $token->fcm_token }}')">
                            View
                        </button>
                    </td>
                    <td class="px-6 py-2 text-sm text-gray-700">{{ $token->customer->email ?? 'N/A' }}</td>
                    <td class="px-6 py-2 text-sm text-gray-700">
                        <button class="px-4 py-2 text-sm text-white bg-blue-500 rounded hover:bg-blue-600" onclick="copyToClipboard('{{ $token->fcm_token }}')">
                            Copy
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
       <!-- Next Page Button -->
<div class="flex justify-end mt-4">
    <!-- Back Button -->
    <button id="prevPageButton" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mr-2" onclick="prevPage()" style="display:none;">
        Back
    </button>

    <!-- Next Button -->
    <button id="nextPageButton" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="nextPage()" style="display:none;">
        Next
    </button>
</div>

    </div>

    <!-- Modal -->
    <div id="tokenModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-md w-96">
            <h2 class="text-lg font-semibold mb-4">FCM Token</h2>
            <p id="fullToken" class="break-all text-sm text-gray-700"></p>
            <button class="mt-4 px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600" onclick="closeModal()">
                Close
            </button>
        </div>
    </div>
</div>
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
<script>
    let currentPage = 0;
    const rowsPerPage = 10;

    // Function to filter rows based on name or email
    function filterTable() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.user-row');
        let visibleCount = 0;

        // Loop through each row and hide/show based on the input value
        rows.forEach((row, index) => {
            const name = row.cells[1].textContent.toLowerCase();
            const email = row.cells[3].textContent.toLowerCase();
            const isMatch = name.includes(input) || email.includes(input);

            // Show or hide row based on the search filter
            row.style.display = isMatch ? '' : 'none';
            if (isMatch) visibleCount++;
        });

        // Update pagination based on visible rows
        updatePagination(visibleCount);
    }

    // Function to update pagination display (show/hide rows)
    function updatePagination(visibleCount) {
        const rows = document.querySelectorAll('.user-row');
        const prevButton = document.getElementById('prevPageButton');
        const nextButton = document.getElementById('nextPageButton');
        const totalVisiblePages = Math.ceil(visibleCount / rowsPerPage);

        // Update the rows visibility based on the current page
        rows.forEach((row, index) => {
            const isVisible = index >= currentPage * rowsPerPage && index < (currentPage + 1) * rowsPerPage;
            row.style.display = row.style.display !== 'none' && isVisible ? '' : 'none';
        });

        // Show or hide the "Next" and "Back" buttons depending on the total pages and current page
        prevButton.style.display = currentPage > 0 ? '' : 'none';  // Show Back button if on page > 0
        nextButton.style.display = totalVisiblePages > currentPage + 1 ? '' : 'none';  // Show Next button if more pages exist
    }

    // Function to handle next page button
    function nextPage() {
        currentPage++;
        filterTable();
    }

    // Function to handle previous page button
    function prevPage() {
        currentPage--;
        filterTable();
    }

    // Initialize pagination when the page loads
    document.addEventListener('DOMContentLoaded', () => {
        updatePagination(document.querySelectorAll('.user-row').length);
    });

    // Functions for modal and clipboard actions
    function viewToken(token) {
        const modal = document.getElementById('tokenModal');
        const fullToken = document.getElementById('fullToken');
        fullToken.textContent = token;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('tokenModal');
        modal.classList.add('hidden');
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('FCM Token copied to clipboard!');
        }).catch(err => {
            alert('Failed to copy FCM Token: ' + err);
        });
    }
</script>

</html>