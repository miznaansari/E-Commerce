// Check if the browser supports service workers
if ('serviceWorker' in navigator) {
    console.log('Registering Service Worker...');
    // Register the service worker
    navigator.serviceWorker.register('/firebase-messaging-sw.js')
      .then((registration) => {
        console.log('Service Worker registered with scope:', registration.scope);
      })
      .catch((error) => {
        console.error('Service Worker registration failed:', error);
      });
  } else {
    console.log('Service Worker is not supported in this browser.');
  }
  