import Vue from 'vue';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify);

export default new Vuetify({
  theme: {
    dark: true,
    themes: {
      dark: {
        primary: '#fc045c',
        secondary: '#333',

        accent: '#fc045c',
        active: '#00d43e',
        inactive: '#ff472b',
        disabled: '#5a5a5a'
      }
    }
  },
  icons: {
    iconfont: 'fa'
  }
});
