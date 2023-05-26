const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.sass('resources/sass/jugando-toy/adminApp.scss', 'public/css');

mix.js('resources/js/app.js', 'public/js').vue()
    .js('resources/js/app-back.js', 'public/js')
    .js('resources/js/app-bottom.js', 'public/js')
    .js('resources/js/bootstrap.js', 'public/js');

mix.sass('resources/sass/app.scss', 'public/css');
