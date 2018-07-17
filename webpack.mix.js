let mix = require('laravel-mix');

mix.webpackConfig({
  module: {
    rules: [
      {
        test: '/\.css/',
        use: [
          'style-loader',
          {loader: 'css-loader', options: {url: false}}
        ]
      }
    ]
  }
})

mix.js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .extract(['lodash', 'axios', 'vue', 'vuetify', 'vuetify/dist/vuetify.min.css']);
