const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');

// Definición de las rutas de los archivos
const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js'
}

// Tarea para procesar archivos SCSS
function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('build/css'));
}

// Tarea para procesar archivos JavaScript
function javascript() {
    return src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js'))
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('./build/js'));
}

// Función para observar cambios en los archivos y ejecutar las tareas correspondientes
function watchArchivos() {
    watch(paths.scss, css);
    watch(paths.js, javascript);
}

// Exportar las tareas de Gulp
exports.css = css;
exports.watchArchivos = watchArchivos;
exports.default = parallel(css, javascript, watchArchivos);
