import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js';
import { getMessaging, getToken, onMessage } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging.js';

// Initialize Firebase
const firebaseConfig = {
  apiKey: "AIzaSyD9VmvA74RSoZxc0op98cG-ix-06L88K1Y",
  authDomain: "clevar-cd69d.firebaseapp.com",
  projectId: "clevar-cd69d",
  storageBucket: "clevar-cd69d.firebasestorage.app",
  messagingSenderId: "773426877262",
  appId: "1:773426877262:web:b9ff4356ca49b10ac9c41f",
  measurementId: "G-MZ5P67HP6S"
};

const app = initializeApp(firebaseConfig);

const messaging = getMessaging(app);

// Request permission to show notifications
function requestNotificationPermission() {
  Notification.requestPermission().then(function(permission) {
    if (permission === 'granted') {
      console.log('Notification permission granted.');
      getTokenForUser();
    } else {
      console.log('Notification permission denied.');
    }
  });
}

// Get the FCM token when permission is granted
function getTokenForUser() {
  getToken(messaging, { vapidKey: 'BOeZn4IYZU_Nunxe9ckdWmUrnmKEXkVUBhBAUTdKWk9GD02tFDRsEOPBK7sGPSA7gMvtqGaui_KURYToaakSjo8' })
    .then(function(currentToken) {
      if (currentToken) {
        console.log('FCM Token:', currentToken);
        // Send the token to your server for later use
        saveTokenToServer(currentToken);
      } else {
        console.log('No FCM token available. Request permission.');
      }
    })
    .catch(function(err) {
      console.error('Error retrieving FCM token:', err);
    });
}

// Save the FCM token to the server (send to backend for push subscription)
function saveTokenToServer(token) {
  fetch('/save-fcm-token', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ token: token })
  })
  .then(response => response.json())
  .then(data => {
    console.log('FCM Token saved on the server:', data);
  })
  .catch(error => {
    console.error('Error saving FCM token:', error);
  });
}

onMessage(messaging, function(payload) {
  console.log('Notification received in foreground:', payload);
  // Show notification
  const notificationOptions = {
    body: payload.notification.body,
    icon: payload.notification.icon,
    //badge: '/firebase-logo.png',
    data: payload.data,
    actions: [
      { action: 'open', title: 'Open' },
      { action: 'close', title: 'Close' }
    ]
  };
  
  if (Notification.permission === 'granted') {
    navigator.serviceWorker.getRegistration().then(registration => {
      registration.showNotification(payload.notification.title, notificationOptions);
    });
  } else if (Notification.permission === 'default') {
    requestNotificationPermission();
  } else {
    console.log('Notification permission denied.');
  }
});

// Handle incoming push event
self.addEventListener('push', function(event) {
  if (event.data) {
    console.log('Received push data:', event.data.json());
    const payload = event.data.json();
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
      body: payload.notification.body,
      icon: payload.notification.icon || '/default-icon.png',  // Default icon if not provided
      data: payload.data || {},  // Include the data field in the notification options (this can contain URL or other useful data)
    };

    // Show notification using the service worker's registration
    self.registration.showNotification(notificationTitle, notificationOptions);
  } else {
    console.log('No data received in push event');
  }
});

// Handle notification click event to redirect the user to the specified URL
self.addEventListener('notificationclick', function(event) {
  event.preventDefault(); // Prevent the default notification click action

  const notificationData = event.notification.data;  // Get the data from the notification
  const redirectUrl = notificationData.url || '/';  // Default to home page if no URL is provided

  // Open the specified URL in the browser
  clients.openWindow(redirectUrl);

  // Close the notification after the click
  event.notification.close();
});


// Call this function to request permission when the user logs in
requestNotificationPermission();

// Check everything is correct
console.log('Firebase App:', app);
console.log('Firebase Messaging:', messaging);
console.log('Notification Permission:', Notification.permission);