// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
  apiKey: "AIzaSyCOKMn99-jdXdP-IQAUpPQbi8BaB8FpBXk",
  authDomain: "fcmapp-10178.firebaseapp.com",
  databaseURL: "https://fcmapp-10178.firebaseio.com",
  projectId: "fcmapp-10178",
  storageBucket: "fcmapp-10178.appspot.com",
  messagingSenderId: "367678100481",
  appId: "1:367678100481:web:a7c050754fec0e68419c00",
  measurementId: "G-HMVPQDF13K"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();


messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
    notificationOptions);
});