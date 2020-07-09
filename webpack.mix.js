const mix = require('laravel-mix')

mix
    .js('resources/js/site.js', 'assets/js/site.js')
    .postCss('resources/css/site.css', 'assets/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
