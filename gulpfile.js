var gulp = require('gulp');
var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.scripts([
        'layout-front/general.js',
        'category/page-category.js',
        'post/page-post.js'
    ],  'public/js/script.min.js');
});


elixir(function(mix) {
    mix.sass([
        'layout/layout-front.scss',
        'layout/custom.scss',
        'user/register.scss',
        'post/style.scss',
        'category/style.scss',
        'fonts/fonts.scss',
        '_variables.scss'
    ],  'public/css/style.min.css');
});