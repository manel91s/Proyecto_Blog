const mix = require('laravel-mix');


/*
 |--------------------------------------------------------------------------
 | Mix As
 set Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/*mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');*/
mix.js('resources/js/category/page-category','public/js/script.min.js')
   .js('resources/js/layout-front/general.js','public/js/script.min.js');

mix.sass('resources/sass/layout/layout-front.scss', 'public/css/layouts/layout-front/layout-front.css');
mix.sass('resources/sass/layout/custom.scss', 'public/css/layouts/layout-front/custom.css');
mix.sass('resources/sass/user/register.scss', 'public/css/user/register.css');
mix.sass('resources/sass/category/style.scss', 'public/css/category/style.css');
mix.sass('resources/sass/post/style.scss', 'public/css/post/style.css');
mix.styles(['public/css/layouts/layout-front/layout-front.css','public/css/layouts/layout-front/custom.css','public/css/user/register.css', 'public/css/category/style.css','public/css/post/style.css'], 'public/css/style.min.css');

