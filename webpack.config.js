/**
 * Created by Mekki on 30/10/2020.
 */
var Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

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
     * Each entry will result in one JavaScript file (e.g. home.js)
     * and one CSS file (e.g. home.css) if your JavaScript imports CSS.
     */
    .addEntry('home', './assets/home.js')
    .addEntry('consultation_confirmation', './assets/consultation_confirmation.js')
    .addEntry('doctor_schedule', './assets/doctor_schedule.js')
    .addEntry('doctors', './assets/doctors.js')
    .addEntry('patients', './assets/patients.js')
    .addEntry('registration', './assets/registration.js')
    .addEntry('show_doctor_agenda', './assets/show_doctor_agenda.js')
    .addEntry('show_patients_agenda', './assets/show_patients_agenda.js')
    .addEntry('login', './assets/login.js')
    .addEntry('show_profile', './assets/show_profile.js')
    .addEntry('patient_consultations', './assets/patient_consultations.js')
    .addEntry('doctor_consultations', './assets/doctor_consultations.js')
    .addEntry('view_patient_consultation', './assets/view_patient_consultation.js')
    .addEntry('view_doctor_consultation', './assets/view_doctor_consultation.js')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

// enables Sass/SCSS support
//.enableSassLoader()

// uncomment if you use TypeScript
//.enableTypeScriptLoader()

// uncomment to get integrity="..." attributes on your script & link tags
// requires WebpackEncoreBundle 1.4 or higher
//.enableIntegrityHashes(Encore.isProduction())

// uncomment if you're having problems with a jQuery plugin
//.autoProvidejQuery()

// uncomment if you use API Platform Admin (composer require api-admin)
.enableReactPreset()
//.addEntry('admin', './assets/admin.js')
;

module.exports = Encore.getWebpackConfig();
