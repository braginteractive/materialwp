// Load all the modules from package.json
var gulp = require( 'gulp' ),
  plumber = require( 'gulp-plumber' ),
  autoprefixer = require('gulp-autoprefixer'),
  watch = require( 'gulp-watch' ),
  jshint = require( 'gulp-jshint' ),
  stylish = require( 'jshint-stylish' ),
  uglify = require( 'gulp-uglify' ),
  rename = require( 'gulp-rename' ),
  notify = require( 'gulp-notify' ),
  include = require( 'gulp-include' ),
  tildeImporter = require('node-sass-tilde-importer'),
  sourcemaps = require('gulp-sourcemaps'),
  sass = require( 'gulp-sass' ),
  imageoptim = require('gulp-imageoptim'),
  browserSync = require('browser-sync').create(),
  critical = require('critical'),
  zip = require('gulp-zip');

var config = {
     nodeDir: './node_modules' 
}


// automatically reloads the page when files changed
var browserSyncWatchFiles = [
    './*.min.css',
    './js/**/*.min.js',
    './**/*.php'
];

// see: https://www.browsersync.io/docs/options/
var browserSyncOptions = {
    watchTask: true,
    proxy: "http://dev:8888/"
}
 
// Default error handler
var onError = function( err ) {
  console.log( 'An error occured:', err.message );
  this.emit('end');
}

// Zip files up
gulp.task('zip', function () {
 return gulp.src([
   '*',
   './css/*',
   './fonts/*',
   './images/**/*',
   './inc/**/*',
   './js/**/*',
   './languages/*',
   './sass/**/*',
   './template-parts/*',
   './templates/*',
   '!bower_components',
   '!node_modules',
  ], {base: "."})
  .pipe(zip('materialwp.zip'))
  .pipe(gulp.dest('.'));
});
 
// Jshint outputs any kind of javascript problems you might have
// Only checks javascript files inside /src directory
gulp.task( 'jshint', function() {
  return gulp.src( './js/src/*.js' )
    .pipe( jshint() )
    .pipe( jshint.reporter( stylish ) )
    .pipe( jshint.reporter( 'fail' ) );
})
 
 
// Concatenates all files that it finds in the manifest
// and creates two versions: normal and minified.
// It's dependent on the jshint task to succeed.
gulp.task( 'scripts', ['jshint'], function() {
  return gulp.src( './js/manifest.js' )
    .pipe( include() )
    .pipe( rename( { basename: 'scripts' } ) )
    .pipe( gulp.dest( './js/dist' ) )
    // Normal done, time to create the minified javascript (scripts.min.js)
    // remove the following 3 lines if you don't want it
    .pipe( uglify() )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( gulp.dest( './js/dist' ) )
    .pipe(browserSync.reload({stream: true}))
    .pipe( notify({ message: 'scripts task complete' }));
} );
 
// Different options for the Sass tasks
var options = {};
options.sass = {
  errLogToConsole: true,
  precision: 8,
  noCache: true,
  importer: tildeImporter,
  //imagePath: 'assets/img',
  includePaths: [
    config.nodeDir + '/bootstrap-material-design/scss',
  ]
};

options.sassmin = {
  errLogToConsole: true,
  precision: 8,
  noCache: true,
  importer: tildeImporter,
  outputStyle: 'compressed',
  //imagePath: 'assets/img',
  includePaths: [
    config.nodeDir + '/bootstrap-material-design/scss',
  ]
};

// Sass
gulp.task('sass', function() {
    return gulp.src('./sass/style.scss')
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass(options.sass).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('.'))
        .pipe(browserSync.reload({stream: true}))
        .pipe(notify({ title: 'Sass', message: 'sass task complete'  }));
});

// Sass-min - Release build minifies CSS after compiling Sass
gulp.task('sass-min', function() {
    return gulp.src('./sass/style.scss')
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass(options.sassmin).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write())
        .pipe(rename( { suffix: '.min' } ) )
        .pipe(gulp.dest('.'))
        .pipe(browserSync.reload({stream: true}))
        .pipe(notify({ title: 'Sass', message: 'sass-min task complete' }));
});

// Optimize Images
gulp.task('images', function() {
    return gulp.src('./images/**/*')
        .pipe(imageoptim.optimize({jpegmini: true}))
        .pipe(gulp.dest('./images'))
        .pipe( notify({ message: 'Images task complete' }));
});

// Generate & Inline Critical-path CSS
gulp.task('critical', function (cb) {
    critical.generate({
        base: './',
        src: 'http://dev:8888/',
        dest: 'css/home.min.css',
        ignore: ['@font-face'],
        dimensions: [{
          width: 320,
          height: 480
        },{
          width: 768,
          height: 1024
        },{
          width: 1280,
          height: 960
        }],
        minify: true
    });
});


// Starts browser-sync task for starting the server.
gulp.task('browser-sync', function() {
    browserSync.init(browserSyncWatchFiles, browserSyncOptions);
});
 
 
// Start the livereload server and watch files for change
gulp.task( 'watch', function() {
 
  // don't listen to whole js folder, it'll create an infinite loop
  gulp.watch( [ './js/**/*.js', '!./js/dist/*.js' ], [ 'scripts' ] )
 
  gulp.watch( './sass/**/*.scss', ['sass', 'sass-min'] );

  gulp.watch( './images/**/*', ['images']);
 
  //gulp.watch( './**/*.php' ).on('change', browserSync.reload);
   
} );
 
 
gulp.task( 'default', ['watch', 'browser-sync'], function() {
 // Does nothing in this task, just triggers the dependent 'watch'
} );