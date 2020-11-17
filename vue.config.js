module.exports = {
  configureWebpack: {
    devtool: 'source-map'
  },
  pluginOptions: {
    quasar: {
      importStrategy: 'kebab',
      rtlSupport: true
    }
  },
  publicPath: process.env.NODE_ENV === 'production'
  ? '/'
  : '/',
  transpileDependencies: [
    'quasar'
  ]
}
