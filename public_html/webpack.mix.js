const mix = require('laravel-mix');

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

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/helper.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css')
    .sass('resources/scss/login.scss', 'public/css');

mix.copyDirectory('resources/images', 'public/images');
mix.babel(['public/js/app.js'], 'public/js/app.js')
    .babel('public/js/helper.js', 'public/js/helper.js')
    .babel('public/js/dashboard.js', 'public/js/dashboard.js');