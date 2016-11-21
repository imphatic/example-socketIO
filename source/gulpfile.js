const elixir = require('laravel-elixir');

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

var resources = './resources/assets';

elixir(function(mix) {
    mix.
    less([
        resources + '/libs/bootstrap/css/bootstrap.css',
        resources + '/libs/bootstrap/css/bootstrap-theme.css',
        'app.less'
        ]).
    scripts([
        'jquery.min.js',
        'socket.io.min.js',
        'app.js'
    ]).
    version(['css/app.css', 'js/all.js']);
});
