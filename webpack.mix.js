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

mix.js('resources/js/app.js', 'public/js')
    .styles([
        'resources/sass/inputmask.css',
        'resources/sass/select2.css',
        'resources/sass/tempusdominus-bootstrap-4.css',
        'resources/sass/custom.css',
        'resources/sass/noty.css',
        'resources/sass/jquery-ui.css',
        'resources/sass/themes/bootstrap-v4.css'
    ], 'public/css/app.css')
    .styles(['resources/sass/style.css'], 'public/css/style.css')
    .styles(['resources/sass/bootstrap.min.css'], 'public/css/bootstrap.min.css')
    .copy('resources/js/jquery-ui.js', 'public/js/');
