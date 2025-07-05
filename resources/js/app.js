import Pusher from 'pusher-js';

// Enable logging for debugging
Pusher.logToConsole = true;

// Initialize Pusher with your credentials
const pusher = new Pusher('00540a3b3f4606477367', {
  cluster: 'ap2',
  forceTLS: true,
});

// Get the current route
const currentRoute = window.location.pathname;

// Subscribe to the specific channel for the current route
const channel = pusher.subscribe('visitor-count.' + currentRoute);

// Bind to the 'updated' event to update the visitor count
channel.bind('updated', function(data) {
  document.getElementById('visitor-count').innerText = data.visitorCount;
});
