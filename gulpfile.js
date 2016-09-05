var gulp = require('gulp');

var autoprefixer = require('gulp-autoprefixer');
var cssmin = require('gulp-cssmin');
var notify = require('gulp-notify');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');

// css
gulp.task('css', function() {
	gulp.src('assets/scss/style.scss')
		.pipe(sass())
		.pipe(autoprefixer())
		.pipe(gulp.dest('assets/css'))
		.pipe(cssmin())
		.pipe(notify("CSS generated!"))
	;
});

// stars
gulp.task('stars', function() {
	gulp.src('assets/scss/stars.scss')
		.pipe(sass())
		.pipe(autoprefixer())
		.pipe(gulp.dest('fields/ratings/assets/css'))
		.pipe(cssmin())
		.pipe(notify("CSS generated!"))
	;
});

// JS
gulp.task('js', function() {
	gulp.src('assets/js/script.js')
		.pipe(uglify())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('assets/js/'))
		.pipe(notify("JS generated!"))
	;
});

// Default
gulp.task('default',function() {
	gulp.watch('assets/scss/**/*.scss',['css']);
	gulp.watch('assets/scss/stars.scss',['stars']);
	gulp.watch('assets/js/**/*.js',['js']);
});