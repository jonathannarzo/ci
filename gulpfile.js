var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix
    .styles([
		'font-awesome/css/font-awesome.css',
        'bootstrap/dist/css/bootstrap.css',
        'adminlte/css/AdminLTE.min.css',
        'adminlte/css/skins/skin-black.min.css',
        'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
		'PACE/themes/blue/pace-theme-center-circle.css',
    ], 'assets/css/all.css', 'bower_components/')
    .scripts([
        'jquery/dist/jquery.js',
        'moment/min/moment.min.js',
        'bootstrap/dist/js/bootstrap.js',
        'bootbox.js/bootbox.js',
        'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
        'PACE/pace.min.js',
    ],'assets/js/all.js', 'bower_components/')
    .copy('bower_components/font-awesome/fonts', 'assets/fonts')
    .copy('bower_components/bootstrap/fonts', 'assets/fonts');
});