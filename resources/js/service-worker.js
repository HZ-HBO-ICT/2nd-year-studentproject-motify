/**
 * ## Push Notification
 * @description this service worker has a function to send the user a
 * push notification when it has access
 * @author Levi Deurloo <ldeurloo1@hz.nl>
 */
export default () =>
    self.addEventListener('push', (e) => {
        let data;
        if (e.data) data = e.data.json();

        console.log('data for notification', data);

        const options = {
            body: data.body,
            icon: '/img/icons/android-chrome-192x192.png',
            image: '/img/icons/apple-icon.png',
            vibrate: [300, 200, 300],
            badge: '/img/icons/android-icon-96x96.png',
        };

        console.log('options passed to Notification', options);

        e.waitUntil(self.registration.showNotification(data.title, options));
    })
