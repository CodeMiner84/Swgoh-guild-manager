var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .autoProvideVariables({
        "window.jQuery": "jquery",
    })
    .enableSassLoader()
    .enableVersioning(false)
  .addEntry('js/app', ['babel-polyfill', './assets/js/react/app.jsx'])
  .addEntry('js/scripts', ['babel-polyfill', './assets/js/app.js'])
    .addStyleEntry('css/app', ['./assets/scss/app.scss'])
    .enableReactPreset()
;

module.exports = Encore.getWebpackConfig();
