const { inProduction, webpackConfig, version } = require('laravel-mix');
const mix = require('laravel-mix');
const Dotenv = require('dotenv-webpack');

/**
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

// noinspection JSIgnoredPromiseFromCall
mix
  .js('resources/js/app.js', 'public')
  .sass('resources/css/app.scss', 'public/css')
  .webpackConfig((webpack) => {
    return {
      mode: inProduction ? 'production' : 'development',
      plugins: [
        new webpack.DefinePlugin({
          'process.env.NODE_ENV': JSON.stringify('production'),
        }),
        new webpack.DefinePlugin(Dotenv, {
          path: './.env', // load this now instead of the ones in '.env'
          safe: true, // load '.env.example' to verify the '.env' variables are all set. Can also be a string to a different file.
          allowEmptyValues: true, // allow empty variables (e.g. `FOO=`) (treat it as empty string, rather than missing)
          systemvars: true, // load all the predefined 'process.env' variables which will trump anything local per dotenv specs.
          silent: true, // hide any errors
          defaults: false, // load '.env.defaults' as the default values if empty.
        }),
      ],
      module: {
        rules: [
          {
            test: /\.js$/,
            loader: 'babel-loader',
            exclude: (file) =>
            /node_modules/.test(file) && !/\.vue\.js/.test(file),
          },
        ],
      },
      resolve: {
        alias: {
          vue$: inProduction()
            ? 'vue/dist/vue.esm.js'
            : 'vue/dist/vue.runtime.esm.js',
          '@': path.resolve(__dirname, 'resources/js'),
        },
      },
      output: {
        umdNamedDefine: true,
        publicPath: '/',
        path: path.resolve(__dirname, 'public/'),
        filename: 'js/[name].js',
        chunkFilename: 'js/[name].js',
      },
    };
  })
  .disableNotifications()
  .options({
    processCssUrls: true,
    cssNano: {
      discardDuplicates: inProduction,
      discardOverridden: inProduction,
      rawCache: inProduction,
    },
  });

//Add version to mixed files, when in production
if (inProduction) version();
