const state = {
  privacy: null,
  loadingPrivacy: false
};

const getters = {
  privacy: (state) => state.privacy,
  loadingPrivacy: (state) => state.loadingPrivacy
};

const mutations = {
  SET_PRIVACY(state, privacy) {
    state.privacy = privacy;
  },
  SET_LOADING_PRIVACY(state, loadingPrivacy) {
    state.loadingPrivacy = loadingPrivacy;
  }
};

const actions = {
  getPrivacy({ commit }) {
    return new Promise((resolve, reject) => {
      commit('SET_LOADING_PRIVACY', true);
      commit('SET_PRIVACY', null);
      window.axios
        .get('legal/privacy-notice')
        .then((response) => {
          commit('SET_PRIVACY', response.data);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        })
        .finally(() => commit('SET_LOADING_PRIVACY', false));
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
