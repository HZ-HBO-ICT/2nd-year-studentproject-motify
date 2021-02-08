import Axios from 'axios';

/**
 * # Library Axios
 * @description this service worker has a function to send the user a
 * push notification when it has access
 */
window.axios = Axios.create();
window.axios.interceptors.request.use(config => {
    config.headers['X-Requested-With'] = 'XMLHttpRequest';
    config.headers['Access-Control-Allow-Origin'] = '*';
    config.headers['Authorization'] = 'Bearer ' + localStorage.getItem('default_auth_token');

    config.headers.Accept = 'application/json';
    config.baseURL = '/api/';
    return config;
});

export default Axios
