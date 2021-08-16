const mix = require('laravel-mix');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
//  */

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/app.js', 'public/js')
.vue()
   .sass('resources/sass/app.scss', 'public/css')
//    .extract(['bootstrap', 'jquery', 'popper.js', 'jquery-ui', 'bootbox', 'moment'])
   .browserSync('127.0.0.1:8000')
   .disableNotifications();



// version does not work in hmr mode
if (process.env.npm_lifecycle_event !== 'hot') {
    mix.version()
}

mix.options({
    hmrOptions: {
        host: '127.0.0.1',
        port: '8079'
    },
});

mix.webpackConfig({
    devServer: {
        contentBase: path.resolve(__dirname, 'public'),
    }
});