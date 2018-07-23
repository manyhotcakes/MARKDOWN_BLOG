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
  .js('resources/assets/js/auth.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .sass('resources/assets/sass/auth.scss', 'public/css')
  .extract(['lodash', 'axios', 'vue', 'vuetify', 'vee-validate', 'vuetify/dist/vuetify.min.css', 'github-markdown-css/github-markdown.css']);
