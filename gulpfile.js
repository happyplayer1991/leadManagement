const elixir = require('laravel-elixir');
const path = require('path');

require('laravel-elixir-webpack-official');
require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.sourcemaps = false;

elixir(mix => {
    // Elixir.webpack.config.module.loaders = [];
    Elixir.webpack.mergeConfig({
        resolveLoader: {
            root: path.join(__dirname, 'node_modules'),
        },
        module: {
            loaders: [
                {
                    test: /\.css$/,
                    loader: 'style!css'
                }
            ]
        }
    });

    mix.styles(['bootstrap.min.css',
        'font-awesome.min.css',
        'jasny-bootstrap.css',
        'toastr.css',
        'dropzone.css',
        'responsive.dataTables.min.css',
        'material-timeline.min.css',

        'lmdd.css'],
        'public/css/');

    mix.sass('app.scss')
        .version('public/css/app.css')
        .sass('material-kit.scss')
        .version('public/css/material-kit.css')
        .sass('material-dashboard.scss')
        .version('public/css/material-dashboard.css')
        .sass('custom.scss')
        .version('public/css/custom.css')
        .copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/','public/fonts/bootstrap');


    mix.scripts(['vendor/jquery.min.js',
                'vendor/bootstrap.min.js',
                'vendor/material.min.js',
                'vendor/moment.min.js',
                'vendor/nouislider.min.js',
                'vendor/bootstrap-datetimepicker.js',
                'vendor/bootstrap-selectpicker.js',
                'vendor/bootstrap-tagsinput.js',
                'vendor/jasny-bootstrap.min.js',
                'vendor/jquery.dataTables.min.js',
                'vendor/dropzone.js',
                'vendor/toastr.js'],
                "public/js/vendor.js");


    mix.scripts(['vendor/jquery.min.js',
        'vendor/bootstrap.min.js',
        'vendor/material.min.js',
        'vendor/moment.min.js',
        'vendor/perfect-scrollbar.jquery.min.js',
        'vendor/core.js',
        'vendor/arrive.min.js',
        'vendor/jquery.validate.min.js',
        'vendor/moment.min.js',
        'vendor/chartist.min.js',
        'vendor/bootstrap-notify.js',
        'vendor/bootstrap-datetimepicker.js',
        'vendor/jquery-jvectormap.js',
        'vendor/nouislider.min.js',
        'vendor/jquery.select-bootstrap.js',
        'vendor/jquery.dataTables.min.js',
        'vendor/sweetalert2.js',
        'vendor/jasny-bootstrap.min.js',
        'vendor/fullcalendar.min.js',
        'vendor/bootstrap-tagsinput.js',
        'vendor/bootstrap-selectpicker.js',
        'vendor/dropzone.js',
        'vendor/toastr.js',
        'vendor/material-dashboard.js',
        'vendor/lmdd.js',
        'vendor/jquery.timeago.js',
        'vendor/material-timeline.min.js',
         'vendor/dataTables.responsive.min.js',
         'vendor/jquery-1.12.4.js',
        'vendor/jquery.more.js',
        'vendor/select2.js',
        'vendor/bootstrap-select.js',
        'vendor/fullcalender.js',
        'vendor/moment.js',
        'vendor/jquery.js',
        'vendor/typeahead.bundle.js'
        ],
            "public/js/dashboard-vendor.js");

    mix.scripts(["crm/global.js",
                 "crm/utils.js",
                 "crm/core.js",
                 "crm/events.js"],"public/js/ocrm.js")

});