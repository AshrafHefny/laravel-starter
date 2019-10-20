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

mix.styles([
    'node_modules/@fortawesome/fontawesome-free/css/all.css',
    'resources/lib/Ionicons/css/ionicons.css',
    'resources/lib/datatables/css/jquery.dataTables.css',
    'resources/lib/select2/css/select2.min.css',
    'resources/lib/selectize/css/selectize.css',
    'node_modules/trumbowyg/dist/ui/trumbowyg.css',
    'resources/lib/jt.timepicker/css/jquery.timepicker.css',
    'resources/lib/jquery.steps/css/jquery.steps.css',
    'resources/lib/mdb/css/mdb.min.css',
], 'public/css/vendors.css');
mix.sass('resources/sass/app.scss', 'public/css');

mix.scripts([
    'resources/lib/jquery/js/jquery.js',
    'resources/lib/popper.js/js/popper.js',
    'resources/lib/bootstrap/js/bootstrap.js',
    'resources/lib/jquery-ui/js/jquery-ui.js',
    'resources/lib/datatables/js/jquery.dataTables.js',
//    'resources/lib/datatables-responsive/js/dataTables.responsive.js',
    'resources/lib/select2/js/select2.min.js',
    'resources/lib/selectize/js/selectize.min.js',
    'resources/lib/notify/js/notify.min.js',
    'node_modules/trumbowyg/dist/trumbowyg.js',
    'resources/lib/jt.timepicker/js/jquery.timepicker.js',
    'resources/lib/peity/js/jquery.peity.js',
    'resources/lib/jquery.steps/js/jquery.steps.js',
    'resources/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js',
    'resources/lib/mdb/js/mdb.min.js',
], 'public/js/vendors.js');
mix.js('resources/js/app.js', 'public/js');
mix.js('resources/js/theme.js', 'public/js');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');
if (mix.inProduction()) {
    mix.version();
}



//mix.browserSync('http://localhost:8000');


