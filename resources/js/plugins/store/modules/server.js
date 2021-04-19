const state = {
  loadingServers: false,
  servers: []
};

const getters = {
  loadingServers: (state) => state.loadingServers,
  servers: (state) => state.servers
};

const mutations = {
  SET_LOADING_SERVERS(state, loadingServers) {
    state.loadingServers = loadingServers;
  },
  SET_SERVERS(state, servers) {
    state.servers = servers;
  }
};

const actions = {
  getServers({ commit }) {
    return new Promise((resolve, reject) => {
      commit('SET_LOADING_SERVERS', true);
      commit('SET_SERVERS', []);
      window.axios
        .get('servers')
        .then((response) => {
          commit('SET_SERVERS', response.data.data);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        })
        .finally(() => commit('SET_LOADING_SERVERS', false));
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
