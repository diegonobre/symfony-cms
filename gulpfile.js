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
            'app/Resources/assets/css/bootstrap.css',
            'app/Resources/assets/css/ionicons.min.css',
            'app/Resources/assets/css/AdminLTE.min.css',
            'app/Resources/assets/css/skins/skin-red-light.min.css',
            'app/Resources/assets/js/iCheck/square/red.css'
        ],
        dist: 'web/dist/css'
    },
    img: {
        src: 'app/Resources/assets/img/**/*.{gif,jpg,png,svg}',
        dist: 'web/dist/img'
    },
    js: {
        src: [
            'app/Resources/assets/js/plugins/jQuery/jQuery-2.1.4.min.js',
            'app/Resources/assets/js/bootstrap.js',
            'app/Resources/assets/js/plugins/slimScroll/jquery.slimscroll.min.js',
            'app/Resources/assets/js/plugins/fastclick/fastclick.js',
            'app/Resources/assets/js/plugins/iCheck/icheck.js',
            'app/Resources/assets/js/app.min.js',
            'app/Resources/assets/js/demo.js'
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
