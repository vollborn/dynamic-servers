const state = {
  isLoadingBackgroundImages: false,
  backgroundImages: []
};

const getters = {
  isLoadingBackgroundImages: (state) => state.isLoadingBackgroundImages,
  backgroundImages: (state) => state.backgroundImages
};

const mutations = {
  SET_IS_LOADING_BACKGROUND_IMAGES(state, isLoadingBackgroundImages) {
    state.isLoadingBackgroundImages = isLoadingBackgroundImages;
  },
  SET_BACKGROUND_IMAGES(state, backgroundImages) {
    state.backgroundImages = backgroundImages;
  }
};

const actions = {
  getBackgroundImages({commit}) {
    return new Promise((resolve, reject) => {
      commit('SET_IS_LOADING_BACKGROUND_IMAGES', true)
      window.axios
        .get('background-images')
        .then((response) => {
          commit('SET_BACKGROUND_IMAGES', response.data.data);
          resolve(response);
        })
        .catch((error) => {
          reject(error);
        })
        .finally(() => commit('SET_IS_LOADING_BACKGROUND_IMAGES', false));
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
