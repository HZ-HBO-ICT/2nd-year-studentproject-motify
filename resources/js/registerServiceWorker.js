import { register } from 'register-service-worker';

/**
 * ## Service Worker
 * @description this service registers the service-worker.js file
 * @method register(swUrl: string, hooks: void)
 * @author Levi Deurloo <ldeurloo1@hz.nl>
 */
if (process.env.NODE_ENV === 'production') {
    register(`/service-worker.js`, {
        ready() {
            console.log(
                process.env.VUE_APP_NAME + ' is being served from cache by a service worker.',
            );
        },
        registered() {
            console.log('Service worker has been registered.');
        },
        cached() {
            console.log('Content has been cached for offline use.');
        },
        updatefound() {
            console.log('New content is downloading.');
        },
        updated() {
            console.log('New content is available; please refresh.');
        },
        offline() {
            console.log(
                'No internet connection found. App is running in offline mode.',
            );
        },
        error(error) {
            console.error('Error during service worker registration:', error);
        },
    });
}
