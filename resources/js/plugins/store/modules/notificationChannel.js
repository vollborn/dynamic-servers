const state = {
  isLoadingNotificationChannels: false,
  notificationChannels: []
};

const getters = {
  isLoadingNotificationChannels: (state) => state.isLoadingNotificationChannels,
  notificationChannels: (state) => state.notificationChannels
};

const mutations = {
  SET_IS_LOADING_NOTIFICATION_CHANNELS(state, isLoadingNotificationChannels) {
    state.isLoadingNotificationChannels = isLoadingNotificationChannels;
  },
  SET_NOTIFICATION_CHANNELS(state, notificationChannels) {
    state.notificationChannels = notificationChannels;
  }
};

const actions = {
  getNotificationChannels({commit}) {
    return new Promise((resolve, reject) => {
      commit('SET_IS_LOADING_NOTIFICATION_CHANNELS', true)
      window.axios
        .get('notification-channel-types')
        .then((response) => {
          commit('SET_NOTIFICATION_CHANNELS', response.data);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        })
        .finally(() => commit('SET_IS_LOADING_NOTIFICATION_CHANNELS', false));
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
