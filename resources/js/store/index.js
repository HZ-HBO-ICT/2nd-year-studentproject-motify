import Vue from 'vue';
import Vuex from 'vuex';
// Import modules
import projectRooms from './modules/projectRooms.js';
import colors from './modules/colors.js';
import lights from './modules/lights';
import feedback from './modules/feedback';
import auth from './modules/auth';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state() {
        return {
            items: [],
            type: '',
            loading: false,
        };
    },
    modules: {
        projectRooms,
        colors,
        lights,
        feedback,
        auth,
    },
});

export default store;
