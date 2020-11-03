var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
 
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('/js/app', './assets/js/app.js')
    .addEntry('/js/delete-confirmation', './assets/js/delete-confirmation.js')
    .addEntry('/js/validate', './assets/js/validate.js')
    .addEntry('/js/tags', './assets/js/tags.js')
    .addStyleEntry('/css/app', ['./assets/scss/app.scss'])
 // allow legacy applications to use $/jQuery as a global variable
    .autoProvidejQuery()

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    .enableSassLoader()

     .copyFiles({
             from: './assets/images',
     
            // optional target path, relative to the output dir
            //to: 'images/[path][name].[ext]',

            // if versioning is enabled, add the file hash too
            //to: 'images/[path][name].[hash:8].[ext]',

            // only copy files matching this pattern
            //pattern: /\.(png|jpg|jpeg)$/
       })
;

module.exports = Encore.getWebpackConfig();
