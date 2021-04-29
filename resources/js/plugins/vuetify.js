import Vue from 'vue';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify);

export default new Vuetify({
  theme: {
    dark: true,
    themes: {
      light: {
        primary: '#fc045c',
        secondary: '#ccc',

        active: '#00d43e',
        inactive: '#ff472b',
        disabled: '#5a5a5a',

        navigationBackground: '#272727',
        navigationColor: '#fff',

        vuetifyCardBackground: '#fff'
      },
      dark: {
        primary: '#fc045c',
        secondary: '#333',

        active: '#00d43e',
        inactive: '#ff472b',
        disabled: '#5a5a5a',

        navigationBackground: '#272727',
        navigationColor: '#fff',

        vuetifyCardBackground: '#1e1e1e'
      }
    }
  },
  icons: {
    iconfont: 'fa'
  }
});
