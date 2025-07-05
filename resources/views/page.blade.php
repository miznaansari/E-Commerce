<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page View Counter</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
     <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>
<body>
    <h2>Views: <span id="view-count">{{ $views }}</span></h2>

    <script>
        // Initialize Pusher
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        // Subscribe to the channel and event
        const channel = pusher.subscribe('page-views');
        channel.bind('App\\Events\\PageViewUpdated', function(data) {
            if (data.page_url === "{{ $page_url }}") {
                document.getElementById('view-count').textContent = data.views;
            }
        });
    </script>
</body>
</html>
