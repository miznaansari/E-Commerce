// Import the necessary Firebase functions
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-analytics.js";
import { GoogleAuthProvider, signInWithPopup, getAuth } from "https://www.gstatic.com/firebasejs/11.1.0/firebase-auth.js";

// Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyD9VmvA74RSoZxc0op98cG-ix-06L88K1Y",
  authDomain: "clevar-cd69d.firebaseapp.com",
  projectId: "clevar-cd69d",
  storageBucket: "clevar-cd69d.firebasestorage.app",
  messagingSenderId: "773426877262",
  appId: "1:773426877262:web:b9ff4356ca49b10ac9c41f",
  measurementId: "G-MZ5P67HP6S"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const auth = getAuth();
auth.languageCode = 'en';

// Google Auth provider
const provider = new GoogleAuthProvider();

// Add event listener for the Google login button
const googleLogin = document.getElementById('google-login-btn');
googleLogin.addEventListener('click', function () {
  // Sign in with Google popup
  signInWithPopup(auth, provider)
    .then((result) => {
      // Successfully signed in
      const user = result.user;

      // Extract user details
      const userData = {
        first_name: user.displayName.split(' ')[0],
        last_name: user.displayName.split(' ')[1] || '',
        email: user.email,
        profile_picture: user.photoURL,
      };

      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      
      // Send user data to Laravel backend for account creation or login
      fetch('/signup', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify(userData),
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert(data.message); // Show success message from backend
          window.location.href = '/'; // Redirect to home after successful login/signup
        } else {
          alert('Error: ' + data.message);
        }
      })
      .catch(error => {
        console.error('Error sending data to backend:', error);
        alert('Error signing up or logging in.');
      });
    })
    .catch((error) => {
      // Handle errors here
      console.error('Error signing in:', error);
      alert('Error signing in.');
    });
});
