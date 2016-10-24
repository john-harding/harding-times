var gulp = require('gulp');
var sass = require('gulp-sass');
var babel = require('gulp-babel');
var gutil = require('gulp-util');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var browserify = require('browserify');
var source = require('vinyl-source-stream');

gulp.task('styles', function() {
  	return gulp.src('wp-content/themes/harding/dev/styles/*.scss')
    	.pipe(sourcemaps.init())  // Process the original sources
	    .pipe(sass()) // Using gulp-sass
    	.pipe(sourcemaps.write()) // Add the map to modified source.
	    .pipe(gulp.dest('wp-content/themes/harding/build/styles'))
	    .pipe(browserSync.reload({
	      stream: true
	    }))
});
gulp.task('scripts', function () {
    return browserify('wp-content/themes/harding/dev/scripts/scripts.js')
	    .transform("babelify", {presets: ["es2015"]})
	    .bundle()
        .pipe(source('scripts.bundle.js'))
      	//.pipe(concat('scripts.bundle.js'))
        //.transform("babelify", {presets: ["es2015"]})
        //.bundle()
    	//.pipe(sourcemaps.init())
      	.pipe(gutil.env.env === 'production' ? uglify() : gutil.noop()) 
    	//.pipe(sourcemaps.write())
        .pipe(gulp.dest('wp-content/themes/harding/build/scripts'))
	    .pipe(browserSync.reload({
	      stream: true
	    }));
});
gulp.task('browserSync', function() {
  browserSync.init({
    proxy: 'http://localhost'
  })
});

gulp.task('watch', ['browserSync'], function (){
  gulp.watch('wp-content/themes/harding/dev/styles/**/*.scss', ['styles']); 
  gulp.watch('wp-content/themes/harding/dev/scripts/**/*.js', ['scripts']); 
  // Other watchers
})