import router from "../../router";
import store from "../../store";

const state = {
  isAuth: !!localStorage.getItem('isAuth'),
  apiToken: localStorage.getItem('apiToken'),
  user: null
};

const getters = {
  isAuth: (state) => state.isAuth,
  apiToken: (state) => state.apiToken,
  user: (state) => state.user
};

const mutations = {
  SET_IS_AUTH(state, isAuth) {
    state.isAuth = isAuth;
    localStorage.setItem('isAuth', isAuth);
  },
  SET_API_TOKEN(state, apiToken) {
    state.apiToken = apiToken;
    localStorage.setItem('apiToken', apiToken);
  },
  SET_USER(state, user) {
    store.commit('locale/SET_LOCALE', user.settings.locale ?? 'en')
    state.user = user;
  },
  UNSET_AUTH(state) {
    state.isAuth = false;
    state.user = null;
    state.apiToken = null;
    localStorage.removeItem('apiToken');
    localStorage.removeItem('isAuth');
  }
};

const actions = {
  register({commit, dispatch}, registerForm) {
    return new Promise((resolve, reject) => {
      window.axios
        .post('auth/register', registerForm)
        .then((response) => {
          commit('SET_API_TOKEN', response.data.user.apiToken);
          commit('SET_USER', response.data.user);
          commit('SET_IS_AUTH', true);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        });
    });
  },
  login({commit, dispatch}, loginForm) {
    return new Promise((resolve, reject) => {
      window.axios
        .post('auth/login', loginForm)
        .then((response) => {
          commit('SET_API_TOKEN', response.data.user.apiToken);
          commit('SET_USER', response.data.user);
          commit('SET_IS_AUTH', true);
          resolve(response);
        })
        .catch((error) => {
          commit('UNSET_AUTH');
          reject(error);
        });
    });
  },
  logout({commit}) {
    return new Promise((resolve, reject) => {
      window.axios
        .post('auth/logout')
        .then((response) => {
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        })
        .finally(() => {
          router.push({name: 'login'});
          commit('UNSET_AUTH');
        });
    });
  },
  getAuth({commit}) {
    return new Promise((resolve, reject) => {
      window.axios
        .get('auth')
        .then((response) => {
          commit('SET_USER', response.data.user);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        });
    });
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
