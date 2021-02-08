import './registerServiceWorker';
import Vue from 'vue';
import VueQrcodeReader from 'vue-qrcode-reader';
import App from './App.vue';
import axios from './utils/axios';
import router from './router';
import store from './store';
import vuetify from './utils/vuetify';
import auth from './utils/auth';
import VueApexCharts from 'vue-apexcharts';

Vue.use(VueApexCharts);

Vue.component('apexchart', VueApexCharts);
new Vue({
    axios,
    router,
    store,
    vuetify,
    VueQrcodeReader,
    auth,
    ApexCharts,
    config: {
        devtools: false,
        errorHandler(err, vm, info) {
            // TODO: Create an errorhandler
        },
        keyCodes: {},
        productionTip: false,
        silent: false,
        async: false,
    },
    render: (h) => h(App),
}).$mount('#app');
