importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
  apiKey: "AIzaSyBCYriRTFw0SO5NZVUwUGBq8tw2A2NrThA",
  authDomain: "holylands-14c01.firebaseapp.com",
  databaseURL: "https://holylands-14c01-default-rtdb.firebaseio.com",
  projectId: "holylands-14c01",
  storageBucket: "holylands-14c01.appspot.com",
  messagingSenderId: "198180480828",
  appId: "1:198180480828:web:0e3e9a2145ee291aada039",
  measurementId: "G-CS8TJFGQDS"});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});