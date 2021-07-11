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
mix.options({
      //processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
      //purifyCss: false, // Remove unused CSS selectors.
      uglify: false, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
      //postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
    });
mix.disableNotifications();

mix.js('resources/js/technobureau.js', 'public/js')
    .sass('resources/scss/technobureau.scss', 'public/css');
  // mix.extract(['bootstrap-select'],'public/js/bootstrap-select');
  // mix.extract(['bootstrap'],'public/js/bootstrap');
  mix.extract();
      
  if (mix.inProduction()) {
    mix.version();
  }
//mix.copy('node_modules/bootstrap-select/dist/js/bootstrap-select.min.js','public/js/')
//mix.postCss('public/css/technobureau.css', 'public/css');
