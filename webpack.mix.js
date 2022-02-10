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
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/admin/plugins/font-awesome/css/font-awesome.min.css',
    'resources/admin/dist/css/adminlte.min.css',
    'resources/admin/dist/css/ionicons.min.css',
    'resources/admin/plugins/iCheck/flat/blue.css',
    'resources/admin/plugins/morris/morris.css',
    'resources/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
    'resources/admin/plugins/datepicker/datepicker3.css',
    'resources/admin/plugins/daterangepicker/daterangepicker-bs3.css',
    'resources/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    'resources/admin/dist/css/bootstrap-rtl.min.css',
    'resources/admin/dist/css/custom-style.css',
], 'public/admin/css/all.css');

mix.scripts([
    'resources/admin/plugins/jquery/jquery.min.js',
    'resources/admin/dist/js/jquery-ui.min.js',
    'resources/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/admin/plugins/morris/morris.min.js',
    'resources/admin/plugins/sparkline/jquery.sparkline.min.js',
    'resources/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
    'resources/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
    'resources/admin/plugins/knob/jquery.knob.js',
    'resources/admin/plugins/daterangepicker/daterangepicker.js',
    'resources/admin/plugins/datepicker/bootstrap-datepicker.js',
    'resources/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
    'resources/admin/plugins/slimScroll/jquery.slimscroll.min.js',
    'resources/admin/plugins/fastclick/fastclick.js',
    'resources/admin/dist/js/adminlte.js',
    'resources/admin/dist/js/pages/dashboard.js',
    'resources/admin/dist/js/demo.js',
    'resources/admin/dist/js/raphael-min.js',
    'resources/admin/dist/js/moment.min.js',
], 'public/admin/js/all.js');

