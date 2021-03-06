import Vue from 'vue';
import Chartkick from 'vue-chartkick';
import Chart from 'chart.js';
import '@fortawesome/fontawesome-free/css/all.css';
import VueTheMask from 'vue-the-mask'
import PushRoute from "./mixins/PushRoute";
import Dates from './mixins/Dates';
import Preview from './mixins/Preview';
import axios from './plugins/axios';
import vuetify from "./plugins/vuetify";
import store from './plugins/store';
import router from './plugins/router';
import i18n from './plugins/i18n';
import App from './App.vue';
import NotificationChannels from "./mixins/NotificationChannels";
import 'vue-animations';

let app = null;

Vue.mixin(Dates);
Vue.mixin(Preview);
Vue.mixin(PushRoute);
Vue.mixin(NotificationChannels);

Chartkick.options = {
  colors: [
    '#fc045c'
  ]
};
Vue.use(Chartkick.use(Chart));
Vue.use(VueTheMask);

if (store.getters['auth/isAuth'] && !store.getters['auth/user']) {
  Promise.all([
    store.dispatch('auth/getAuth'),
  ]).finally(() => mountApp());
} else {
  mountApp();
}

function mountApp() {
  app = new Vue({
    router,
    axios,
    vuetify,
    store,
    i18n,
    render: h => h(App),
  }).$mount('#app');
}

export default app;
