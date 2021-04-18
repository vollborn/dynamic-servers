const mix = require('laravel-mix');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

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
