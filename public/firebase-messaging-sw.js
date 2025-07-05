// Import Firebase SDK inside the service worker
importScripts('https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.0.0/firebase-messaging.js');

// Initialize Firebase in the service worker
firebase.initializeApp({
  apiKey: "AIzaSyD9VmvA74RSoZxc0op98cG-ix-06L88K1Y",
  authDomain: "clevar-cd69d.firebaseapp.com",
  projectId: "clevar-cd69d",
  storageBucket: "clevar-cd69d.firebasestorage.app",
  messagingSenderId: "773426877262",
  appId: "1:773426877262:web:b9ff4356ca49b10ac9c41f",
  measurementId: "G-MZ5P67HP6S"
});

// Initialize Firebase Messaging
const messaging = firebase.messaging();

// Handle background notifications
messaging.onBackgroundMessage(function(payload) {
  console.log('Received background message', payload);
  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: payload.notification.icon || '/firebase-logo.png'
  };

  // Show notification
  self.registration.showNotification(notificationTitle, notificationOptions);
});
