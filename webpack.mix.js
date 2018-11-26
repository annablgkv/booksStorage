const mix = require('laravel-mix');

mix
  .js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/global.scss', 'public/css')
  .copy('resources/assets/img', 'public/img')

mix.options({
  extractVueStyles: 'public/css/vue-style.css'
})

mix.setPublicPath('public')
