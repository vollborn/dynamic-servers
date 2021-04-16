import Vue from 'vue';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify);

// https://colorhunt.co/palette/253352

export default new Vuetify({
  theme: {
    dark: false,
    themes: {
      light: {
        primary: '#7c9473',
        secondary: '#cfdac8'
      }
    }
  },
  icons: {
    iconfont: 'fa'
  }
});
