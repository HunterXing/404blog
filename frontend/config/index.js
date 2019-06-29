'use strict'
// Template version: 1.3.1
// see http://vuejs-templates.github.io/webpack for documentation.

const path = require('path')

module.exports = {
  dev: {

    // Paths
    assetsSubDirectory: 'static',
    assetsPublicPath: '/',
    proxyTable: {
      // php 后台API
      '/phpApi': {
        // 不要写localhost
        target: 'http://127.0.0.1:80/',
        // true允许跨域
        changeOrigin: true,
        pathRewrite: {
          // 需要rewrite重写的, 如果在服务器端做了处理则可以不要这段
          '^/phpApi': '/404blog/backend/php/index.php'
        }
      },
      // node后台API
      '/nodeApi': {
        // 不要写localhost
        target: 'http://127.0.0.1:8000/404blog/backend/node',
        // true允许跨域
        changeOrigin: true,
        pathRewrite: {
          // rewrite重写的
          '^/nodeApi': ''
        }
      }
      // 服务器根目录下的接口
      // '/interface': {
      //   target: 'http://localhost/',
      //   changeOrigin: true,
      //   pathRewrite: {
      //     '^/interface': '/api'
      //   }
      // },
      // '/api': {
      //   target: 'http://localhost:8080',
      //   pathRewrite: {
      //     '^/api': 'static/mock/'
      //   }
      // }
    },

    // Various Dev Server settings
    host: '0.0.0.0', // can be overwritten by process.env.HOST
    port: 8080, // can be overwritten by process.env.PORT, if port is in use, a free one will be determined
    autoOpenBrowser: false,
    errorOverlay: true,
    notifyOnErrors: true,
    poll: false, // https://webpack.js.org/configuration/dev-server/#devserver-watchoptions-

    // Use Eslint Loader?
    // If true, your code will be linted during bundling and
    // linting errors and warnings will be shown in the console.
    useEslint: true,
    // If true, eslint errors and warnings will also be shown in the error overlay
    // in the browser.
    showEslintErrorsInOverlay: false,

    /**
     * Source Maps
     */

    // https://webpack.js.org/configuration/devtool/#development
    devtool: 'cheap-module-eval-source-map',

    // If you have problems debugging vue-files in devtools,
    // set this to false - it *may* help
    // https://vue-loader.vuejs.org/en/options.html#cachebusting
    cacheBusting: true,

    cssSourceMap: true
  },

  build: {
    // Template for index.html
    index: path.resolve(__dirname, '../dist/index.html'),

    // Paths
    assetsRoot: path.resolve(__dirname, '../dist'),
    assetsSubDirectory: 'static',
    assetsPublicPath: '/',

    /**
     * Source Maps
     */

    productionSourceMap: true,
    // https://webpack.js.org/configuration/devtool/#production
    devtool: '#source-map',

    // Gzip off by default as many popular static hosts such as
    // Surge or Netlify already gzip all static assets for you.
    // Before setting to `true`, make sure to:
    // npm install --save-dev compression-webpack-plugin
    productionGzip: false,
    productionGzipExtensions: ['js', 'css'],

    // Run the build command with an extra argument to
    // View the bundle analyzer report after build finishes:
    // `npm run build --report`
    // Set to `true` or `false` to always turn it on or off
    bundleAnalyzerReport: process.env.npm_config_report
  }
}
