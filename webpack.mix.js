// const _ = require('lodash')
// const del = require('del')
// const fs = require('fs')
// const mixManifest = 'public/mix-manifest.json'
// const jsonFile = require('jsonfile')
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
    mix.version()
  //   .then(() => {
  //     // Parse the mix-manifest file
  //     jsonFile.readFile(mixManifest, (err, obj) => {
  //         const newJson = {}

  //         _.forIn(obj, (value, key) => {
  //             // Get the hash from the ?id= query string parameter and move it into the file name e.g. 'app.abcd1234.css'
  //             const newFilename = value.replace(/([^.]+)\.([^?]+)\?id=(.+)$/g, '$1.$3.$2')
  //             // Create a glob pattern of all files with the new file naming style e.g. 'app.*.css'
  //             const oldAsGlob = value.replace(/([^.]+)\.([^?]+)\?id=(.+)$/g, '$1.*.$2')
  //             // Delete old versioned file(s) that match the glob pattern
  //             del.sync([`public${oldAsGlob}`])
  //             // Copy as new versioned file name
  //             fs.copyFile(`public${key}`, `public${newFilename}`, (err) => {
  //                 if (err) console.error(err)
  //             })
  //             newJson[key] = newFilename
  //         })
  //         // Write the new contents of the mix manifest file
  //         jsonFile.writeFile(mixManifest, newJson, { spaces: 4 }, (err) => {
  //             if (err) console.error(err)
  //         })
  //     })
  // })
  ;
  }
//mix.copy('node_modules/bootstrap-select/dist/js/bootstrap-select.min.js','public/js/')
//mix.postCss('public/css/technobureau.css', 'public/css');
