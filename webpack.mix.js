const mix = require('laravel-mix');

mix.js('resources/js/app.js','resources/js/ongkir.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/jquery/dist/jquery.min.js', 'public/js');