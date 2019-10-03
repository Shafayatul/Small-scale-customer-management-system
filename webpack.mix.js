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

mix.copy('node_modules/startbootstrap-sb-admin-2/vendor/jquery/jquery.min.js', 'public/js')
	.copy('node_modules/startbootstrap-sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js', 'public/js')
	.copy('node_modules/startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js', 'public/js')
	.copy('node_modules/startbootstrap-sb-admin-2/js/sb-admin-2.min.js', 'public/js')
	.copy('node_modules/startbootstrap-sb-admin-2/vendor/chart.js/Chart.min.js', 'public/js')
	.copy('node_modules/startbootstrap-sb-admin-2/js/demo/chart-area-demo.js', 'public/js')
	.copy('node_modules/startbootstrap-sb-admin-2/js/demo/chart-pie-demo.js', 'public/js')
	.js('resources/js/app.js', 'public/js')
   	.sass('resources/sass/app.scss', 'public/css');
