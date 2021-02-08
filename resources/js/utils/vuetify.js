import Vue from 'vue';
import Vuetify from 'vuetify';

import { en, nl } from 'vuetify/lib/locale';

Vue.use(Vuetify);

const opts = {
    icons: {
        iconfont: 'mdi',
    },

    theme: {
        dark: false,
    },
    themes: {
        light: {
            primary: '#1976D2',
            secondary: '#424242',
            accent: '#82B1FF',
            error: '#FF5252',
            info: '#2196F3',
            success: '#4CAF50',
            warning: '#FB8C00',
        },
        dark: {
            primary: '#2196F3',
            secondary: '#424242',
            accent: '#FF4081',
            error: '#FF5252',
            info: '#2196F3',
            success: '#4CAF50',
            warning: '#FB8C00',
        },
    },
    lang: {
        locales: { nl, en },
        current: 'nl',
    },
};

export default new Vuetify(opts);
