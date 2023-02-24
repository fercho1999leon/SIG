let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix secure_asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.browserSync({ proxy: 'pined.test' });
mix.options({
	processCssUrls: false // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
});
mix.webpackConfig({ devtool: "inline-source-map" });

// mix.js('resources/assets/js/app.js', 'public/js')
// mix.sass('public/css/login.scss', 'public/css/')
// mix.sass('public/css/print.scss', 'public/css') 
mix.sass('public/css/pdf/pdf.scss', 'public/css/pdf')
mix.sass('public/css/style.scss', 'public/css/').sourceMaps();
// mix.postCss('resources/css/tailwind.css', 'public/css', [
// 	require('tailwindcss'),
// 	require('autoprefixer'),
//   ]) 
	
// mix.scripts(['public/js/jquery-2.1.1.js',
// 'resources/assets/js/sweetalert2.js',
// 'public/js/bootstrap.min.js',
// 'public/js/plugins/metisMenu/jquery.metisMenu.js',
// 'public/js/plugins/slimscroll/jquery.slimscroll.min.js',
// 'public/js/inspinia.js',
// 'public/js/plugins/pace/pace.min.js',
// 'public/js/plugins/jquery-ui/jquery-ui.min.js',
// 'public/js/gritter/jquery.gritter.min.js',
// 'public/js/toastr/toastr.min.js', 'public/js/select2.min.js']
// 		, 'public/js/theme-js.js');
 

