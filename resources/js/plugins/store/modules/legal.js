const state = {
  legal: null,
  loadingLegal: false
};

const getters = {
  legal: (state) => state.legal,
  loadingLegal: (state) => state.loadingLegal
};

const mutations = {
  SET_LEGAL(state, legal) {
    state.legal = legal;
  },
  SET_LOADING_LEGAL(state, loadingLegal) {
    state.loadingLegal = loadingLegal;
  }
};

const actions = {
  getLegal({ commit }) {
    return new Promise((resolve, reject) => {
      commit('SET_LOADING_LEGAL', true);
      commit('SET_LEGAL', null);
      window.axios
        .get('legal/legal-notice')
        .then((response) => {
          commit('SET_LEGAL', response.data);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        })
        .finally(() => commit('SET_LOADING_LEGAL', false));
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
