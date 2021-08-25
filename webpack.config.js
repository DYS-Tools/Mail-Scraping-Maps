var Encore = require('@symfony/webpack-encore');
Encore

    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('build')

    .addEntry('main', './assets/main.js')
    .configureBabel()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .splitEntryChunks()
    .autoProvidejQuery()
    //.enablePostCssLoader()
    .enableVersioning(Encore.isProduction())
    .splitEntryChunks()

    //react-Options
    .enableReactPreset()


;
module.exports = Encore.getWebpackConfig();