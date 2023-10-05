// let mix = require('laravel-mix');
let mix = require('laravel-mix');


mix
    .js('resources/js/app.js', 'public/dist/js')
    // .sass('resources/sass/app.scss', 'public/dist/css')
    .postCss('resources/css/tailwind.css', 'public/dist/css', [
        require("tailwindcss"),
    ]);
