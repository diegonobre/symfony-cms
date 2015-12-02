var gulp      = require('gulp'),
    css       = require('gulp-minify-css'),
    concat    = require('gulp-concat'),
    uglify    = require('gulp-uglify'),
    cleanDest = require('gulp-clean-dest'),
    watch     = require('gulp-watch'),
    imagemin  = require('gulp-imagemin'),
    pngquant  = require('imagemin-pngquant');


var path = {
    css: {
        src: [
            'web/src/css/bootstrap.css',
            'web/src/css/font-awesome.css',
            'web/src/css/ionicons.min.css',
            'web/src/css/AdminLTE.min.css',
            'web/src/css/skins/skin-red-light.min.css'
        ],
        dist: 'web/dist/css'
    },
    img: {
        src: 'web/src/img/**/*.{gif,jpg,png,svg}',
        dist: 'web/dist/img'
    },
    js: {
        src: [
            'web/src/js/plugins/jQuery/jQuery-2.1.4.min.js',
            'web/src/js/bootstrap.js',
            'web/src/js/plugins/slimScroll/jquery.slimscroll.min.js',
            'web/src/js/plugins/fastclick/fastclick.js',
            'web/src/js/app.min.js',
            'web/src/js/demo.js'
        ],
        dist: 'web/dist/js'
    }
};

gulp.task('css', function () {
    return gulp.src(path.css.src)
        .pipe(css())
        .pipe(concat('all.min.css'))
        .pipe(cleanDest('out'))
        .pipe(gulp.dest(path.css.dist));
});


gulp.task('js', function() {
    return gulp.src(path.js.src)
        .pipe(uglify())
        .pipe(concat('all.min.js'))
        .pipe(cleanDest('out'))
        .pipe(gulp.dest(path.js.dist))
});

gulp.task('img', function () {
    return gulp.src(path.img.src)
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()],
            optimizationLevel: 3,
            interlaced: true
        }))
        .pipe(cleanDest('out'))
        .pipe(gulp.dest(path.img.dist));
});


gulp.task('clean', function () {
    return gulp.src([path.css.dist, path.js.dist, path.img.dist], {read: false})
        .pipe(cleanDest('out'));
});


gulp.task('watch', function () {
    gulp.watch(path.css.src, ['clean', 'css']);
    gulp.watch(path.js.src,  ['clean', 'js']);
    gulp.watch(path.js.src,  ['clean', 'img']);
});


gulp.task('default', ['css', 'js', 'img']);
