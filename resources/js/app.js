import './bootstrap';

import Echo from 'laravel-echo'

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '5f2f3983f21ba9319c23',
    cluster: 'ap2',
    forceTLS: true
});

var channel = Echo.private(`App.Models.User.$[userID]`);
channel.notification('.my-event', function (data) {
    console.log(data);
    alert(data.body);
    alert(JSON.stringify(data));
});

import {getMessaging, getToken, onMessage} from "firebase/messaging";

// Get registration token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
const messaging = getMessaging();
getToken(messaging, {vapidKey: 'BFp3QX3gq8I7jkFYeEc6onMmZzAAQPodPD3PLyRmL6sGUVW2t9kgzCn-MIzjolao0KO4tHaoG-gtI5l9DZXk_pM'}).then((currentToken) => {
    if (currentToken) {
        // Send the token to your server and update the UI if necessary
        // ...
    } else {
        // Show permission request UI
        console.log('No registration token available. Request permission to generate one.');
        // ...
    }
}).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    // ...
});
onMessage(messaging, (payload) => {
    console.log('Message received. ', payload);
    // ...
});
