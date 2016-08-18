var gulp = require('gulp');

// --------------------------------------------
// ENVIRONMENT VARS
// --------------------------------------------

var localHost = 'aa.dev';
var compiledFolder = 'public_html/assets';
var srcFolder = 'src';
var tmplFolder = 'templates';
var stashFolder = 'stash_templates';

// --------------------------------------------
// PLUGINS
// --------------------------------------------

var browserSync = require('browser-sync');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
var svgSprite = require('gulp-svg-sprite');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');
var gutil = require('gulp-util');

// ----------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------

// --------------------------------------------
// BROWSER SYNC
// --------------------------------------------

gulp.task('browser-sync', function() {
	browserSync({
		proxy: localHost,
		open: false,
		notify: false
	});
	browserSync.notify("This message will only last a second", 1000);
});

gulp.task('bs-reload', function () {
	browserSync.reload();
});

// --------------------------------------------
// STYLES
// --------------------------------------------

gulp.task('styles', function(){
	gulp.src(srcFolder + '/sass/style.scss')
		.pipe(sass({ outputStyle: 'compressed' }))
		.on('error', function(err) { gutil.log('Line: ' + err.lineNumber + ' - ' + err.message); gutil.beep(); })
		.pipe(autoprefixer())
		.pipe(gulp.dest(compiledFolder+'/css'))
		.pipe(browserSync.reload({ stream: true }));
});

// --------------------------------------------
// SCRIPTS
// --------------------------------------------

gulp.task('scripts', function(){
	gulp.src(srcFolder + '/js/*.js')
		.pipe(jshint())
		.pipe(jshint.reporter('default'))
		//.pipe(jshint.reporter('fail'))
		.pipe(uglify())
		.on('error', function(err) { gutil.log(err.message);gutil.beep(); })
		.pipe(concat('js.min.js'))
		.pipe(gulp.dest(compiledFolder+'/js'))
		.pipe(browserSync.reload({ stream: true }));
});

// --------------------------------------------
// IMAGE MINIFIER
// --------------------------------------------

gulp.task('images', function () {
	return gulp.src(srcFolder + '/img/*')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()]
		}))
		.pipe(gulp.dest(compiledFolder + '/img'));
});

// --------------------------------------------
// SVG SPRITE GENERATOR (also minifies SVG)
// --------------------------------------------

gulp.task('icons', function(){
	return gulp.src(srcFolder + '/svg/*.svg')
		.pipe(svgSprite({
			'mode': {
				'symbol': {
					'inline': true,
					'dest': 'svg-sprite',
					'example': {
						'dest': 'preview.html'
					},
					'sprite': 'svg-sprite.html',
				}
			}
		}))
		.pipe(gulp.dest(stashFolder));
});

// --------------------------------------------
// WATCH
// --------------------------------------------

gulp.task('watch', function(){
	gulp.watch(srcFolder + '/sass/**/*.scss', ['styles']);
	gulp.watch(srcFolder + '/icons/*.svg', ['icons']);
	gulp.watch(tmplFolder + '/**/*', ['bs-reload']);
	gulp.watch(stashFolder + '/**/*', ['bs-reload']);
	gulp.watch(srcFolder + '/js/*', ['scripts']);
});

// --------------------------------------------
// DEFAULT TRIGGER (typing 'gulp' at command line triggers these tasks)
// --------------------------------------------

gulp.task('default', ['styles', 'scripts', 'watch', 'browser-sync']);