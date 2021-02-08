import Vue from 'vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import VueAuth from '@websanova/vue-auth';
import authConfig from '@/config/auth';

Vue.use(VueAxios, axios)
Vue.use(VueAuth, authConfig)

export default VueAuth
