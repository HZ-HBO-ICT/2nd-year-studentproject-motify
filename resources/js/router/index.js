import Vue from 'vue';
import VueRouter from 'vue-router';
import VueMeta from 'vue-meta';
import VueGtm from 'vue-gtm';

import routes from './routes';

//Vue meta
Vue.use(VueMeta, {
    keyName: 'page',
});

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: '/',
    routes: routes,
});

Vue.router = router

//Vue GTM
if (process.env.NODE_ENV === 'production' && process.env.MIX_GTM_ID) {
    Vue.use(VueGtm, {
        id: process.env.MIX_GTM_ID,
        enabled: true,
        vueRouter: router,
        ignoredViews: [],
    });
}

export default router
