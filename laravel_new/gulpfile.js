var elixir = require('laravel-elixir');

elixir.config.sourcemaps = false;

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('login.scss', 'public/css/login.css');
    mix.sass('signup.scss', 'public/css/signup.css');
    mix.sass('reset_password.scss', 'public/css/reset_password.css');

    mix.version([
        'public/css/login.css',
        'public/css/signup.css',
        'public/css/reset_password.css'
    ]);
});
