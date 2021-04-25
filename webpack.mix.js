const mix = require('laravel-mix');
const path = require('path');

mix.webpackConfig({
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "resources/js/"),
      "~": path.resolve(__dirname, "resources/sass/")
    }
  }
});

mix.js('resources/js/main.js', 'public/js/app.js')
  .sass('resources/sass/app.scss', 'public/css/app.css')
  .vue();
