const { series, src, dest,watch} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat=require('gulp-concat');

const rutas={
    imagenes:'src/img/**/*',
    js:'src/js/**/*.js',
}


function css() {
    return src('src/scss/app.scss')
        .pipe( sass() )
        .pipe( dest('./build/css') )
}

function javaScript() {
    return src(rutas.js)
    .pipe(concat('bundle.js'))
    .pipe(dest('./build/js'))
}

function watchArchivos() {
    watch('src/scss/**/*.scss',css);//* carpeta actual
    watch(rutas.js,javaScript);
   
}

exports.css=css;
exports.watchArchivos=watchArchivos;
