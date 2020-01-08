'use strict';

const
    path = require('path'),
    gulp = require('gulp'),
    debug = require('gulp-debug'),
    gutil = require('gulp-util'),
    newer = require('gulp-newer'),
    imagemin = require('gulp-imagemin'),
    cleanCSS = require('gulp-clean-css'),
    sass = require('gulp-sass'),
    postcss = require('gulp-postcss'),
    deporder = require('gulp-deporder'),
    concat = require('gulp-concat'),
    stripdebug = require('gulp-strip-debug'),
    uglify = require('gulp-uglify'),
    del = require('del'),
    babel = require('gulp-babel'),
    browserSync = require('browser-sync'),
    version = require('gulp-version-number');

const paths = {
    scripts: {
        src: './../js/main.js',
        js: './../js',
        dest: './js'
    },
    styles: {
        src: 'scss/style.scss',
        all: 'scss/**/*.scss',
        dest: './../'
    },
    modules: {
        src: 'node_modules'
    }
};

const getUnixTime = () => {
    const date = new Date();
    return date.getTime();
}

// Clean dist folder

const clean = () => del(['./../dist'], { force: true });

// Compile js files

function scripts()
{
    return gulp.src([
        paths.modules.src+'/jquery/dist/jquery.js',
        paths.modules.src+'/stickyfilljs/src/stickyfill.js',
        //paths.scripts.js+'/popper.min.js',
        paths.modules.src+'/bootstrap/dist/js/bootstrap.bundle.js',
        paths.modules.src+'/jquery-validation/dist/jquery.validate.js',
        paths.modules.src+'/owl.carousel/dist/owl.carousel.js',
        paths.modules.src+'/js-cookie/src/js.cookie.js',
        paths.scripts.src
    ], { sourcemaps: true })
        .pipe(babel({
            presets: ['@babel/env']
        }))
        .pipe(uglify())
        .pipe(concat('index.min.js'))
        .pipe(gulp.dest(paths.scripts.dest));
}

// Compile scss files

function styles() {
    return gulp.src([paths.styles.src], { sourcemaps: true })
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest(paths.styles.dest));
}

// Create BrowserSync instance

const server = browserSync.create();

// Reload BrowserSync

function reload(done) {
    server.reload();
    done();
}

// Launch BrowserSync instance

function serve(done) {
    server.init({
        proxy: 'localhost/wm',
        open: false,
        notify: false,
        ghostMode: false,
        ui: {
            port: 8001
        }
    });
    done();
}

// Default task
gulp.task('default', gulp.series(/*clean,*/scripts, styles, serve, () => {
    gulp.watch(paths.scripts.src, gulp.series(scripts, reload));
    gulp.watch([
        paths.styles.src,
        paths.styles.all
    ], gulp.series(styles, reload));
}));

