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

elixir.config.sourcemaps = false;

elixir(function(mix) {

    mix.sass(['pages/peerreviewboard.scss'], 'public/css/pages/peerreviewboard.css');

    mix.scripts('peerreviewboard.js', 'public/js/peerreviewboard.js');

    mix.version(['public/css/pages/peerreviewboard.css', 'public/js/peerreviewboard.js']);
});
