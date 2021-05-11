import i18n from "../../i18n";

const state = {
  locale: 'en'
};

const getters = {
  locale: (state) => state.locale
};

const mutations = {
  SET_LOCALE(state, locale) {
    i18n.locale = locale;
    state.locale = locale;
  }
};

const actions = {
  setLocale({commit}, locale) {
    commit('SET_LOCALE', locale);
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
