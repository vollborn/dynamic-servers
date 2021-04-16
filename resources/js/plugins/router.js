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
    path: '/login',
    name: 'login',
    component: () => import('./../views/login/Login.vue'),
    meta: {auth: false}
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('./../views/register/Register.vue'),
    meta: {auth: false}
  },

  // With Authentication
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('./../views/dashboard/Dashboard.vue'),
    meta: {auth: true}
  }
];

const router =  new VueRouter({
  routes
});

router.beforeEach((to, from, next) => {
  const auth = store.getters['auth/isAuth'];
  if (to.meta.auth && !auth) {
    return next({name: 'login'});
  } else {
    return next();
  }
});

router.afterEach(() => {
  window.scrollTo(0, 0);
})

Vue.use(VueRouter);

export default router;
