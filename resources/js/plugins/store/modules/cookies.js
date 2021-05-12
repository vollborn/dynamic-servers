const state = {
  cookies: localStorage.getItem('cookies') === 'true'
};

const getters = {
  cookies: (state) => state.cookies
};

const mutations = {
  SET_COOKIES(state, cookies) {
    state.cookies = cookies;
  }
};

const actions = {
  setCookies({commit}, cookies) {
    localStorage.setItem('cookies', cookies)
    commit('SET_COOKIES', cookies);
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
