let mix = require('laravel-mix')
let path = require('path')
let tailwindcss = require('tailwindcss')

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

mix
    .js('resources/js/app.js', 'public')
    .extract([
        'axios',
        'chartist-plugin-tooltips',
        'chartist',
        'codemirror',
        'flatpickr',
        'form-backend-validation',
        'inflector-js',
        'laravel-nova',
        'lodash',
        'markdown-it',
        'moment-timezone',
        'moment',
        'numbro',
        'numbro/dist/languages.min',
        'places.js',
        'popper.js',
        'portal-vue',
        'trix',
        'vue-async-computed',
        'vue-clickaway',
        'vue-router',
        'vue-toasted',
        'vue',
    ])
    .setPublicPath('public')
    .postCss('resources/css/app.css', 'public', [tailwindcss('tailwind.js')])
    .copy('public', '../nova-app/public/vendor/nova')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js/'),
            },
        },
    })
    .version()
