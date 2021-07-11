import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('./../views/home/Home.vue'),
    meta: {auth: false}
  },
  {
    path: '/status/:server/:token',
    name: 'status',
    component: () => import('./../views/status/Status.vue'),
    meta: {auth: false}
  },

  // Without Authentication
  {
    path: '/login',
    name: 'login',
    component: () => import('./../views/login/Login.vue'),
    meta: {auth: false, noAuth: true}
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('./../views/register/Register.vue'),
    meta: {auth: false, noAuth: true}
  },

  // With Authentication
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('./../views/dashboard/Dashboard.vue'),
    meta: {auth: true}
  },
  {
    path: '/support',
    name: 'support',
    component: () => import('./../views/support/Support.vue'),
    meta: {auth: true}
  },
  {
    path: '/server/:server',
    name: 'server',
    component: () => import('./../views/server/Server.vue'),
    meta: {auth: true}
  },
  {
    path: '/settings',
    name: 'settings',
    component: () => import('./../views/settings/Settings.vue'),
    meta: {auth: true}
  },

  // Static
  {
    path: '/legal-notice',
    name: 'legal-notice',
    component: () => import('./../views/legal-notice/LegalNotice.vue')
  },
  {
    path: '/privacy-notice',
    name: 'privacy-notice',
    component: () => import('./../views/privacy-notice/PrivacyNotice.vue')
  },

  // Errors
  {
    path: '/too-many-requests',
    name: 'too-many-requests',
    component: () => import('./../views/too-many-requests/TooManyRequests.vue'),
    meta: {auth: false}
  },
  {
    path: '*',
    name: 'not-found',
    component: () => import('./../views/not-found/NotFound.vue'),
    meta: {auth: false}
  }
];

const router = new VueRouter({
  routes
});

router.beforeEach((to, from, next) => {
  const auth = store.getters['auth/isAuth'];
  if (to.meta.auth && !auth) {
    return next({name: 'login'});
  } else if (to.meta.noAuth && auth) {
    return next({name: 'dashboard'});
  } else {
    return next();
  }
});

router.afterEach(() => {
  window.scrollTo(0, 0);
})

Vue.use(VueRouter);

export default router;
