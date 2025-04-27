const Encore = require('@symfony/webpack-encore');

// Configure the runtime environment
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // Basic configuration
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    
    // Entry points
    .addEntry('app', './assets/app.js')
    .addEntry('calendar', './assets/calendar.js')
    .addEntry('notification', './assets/notification.js')
    
    // Enable features
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    
    // Configure Babel for modern JavaScript
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })
    
    // Add Babel plugin for async/await support
    .configureBabel(config => {
        config.plugins.push('@babel/plugin-transform-runtime');
    })
    
    // Enable PostCSS and Sass if needed
    .enablePostCssLoader()
    .enableSassLoader()
    
    // Enable React if you're using it
    // .enableReactPreset()
    
    // Enable jQuery if needed
    .autoProvidejQuery()
    
    // Add copy plugin for FullCalendar styles if needed
    .copyFiles({
        from: './node_modules/@fullcalendar/core/main.min.css',
        to: 'fullcalendar/[name].[ext]'
    })
    .copyFiles({
        from: './node_modules/@fullcalendar/daygrid/main.min.css',
        to: 'fullcalendar/[name].[ext]'
    })
    .copyFiles({
        from: './node_modules/@fullcalendar/timegrid/main.min.css',
        to: 'fullcalendar/[name].[ext]'
    })
;

const config = Encore.getWebpackConfig();

// Optional: If you need to resolve .mjs files (for FullCalendar)
config.module.rules.push({
    test: /\.mjs$/,
    include: /node_modules/,
    type: 'javascript/auto'
});

module.exports = config;