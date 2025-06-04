const { defineConfig } = require('@vue/cli-service')

module.exports = defineConfig({
  transpileDependencies: true,
  
  // 开发服务器配置
  devServer: {
    proxy: {
      '/api': {
        target: 'http://localhost:3000', // PHP服务器地址
        changeOrigin: true,
        pathRewrite: {
          '^/api': '/backend/api' // 将请求中的/api重写为/backend/api
        }
      }
    }
  },
  
  // 生产环境配置
  productionSourceMap: false,
  
  // 输出目录配置
  outputDir: '../public',
  
  // 静态资源目录
  assetsDir: 'assets',
  
  // 公共路径
  publicPath: '/',
  
  indexPath: 'index.html',
  
  pages: {
    index: {
      entry: 'src/main.js',
      template: 'public/index.html',
      filename: 'index.html',
      title: '我的作品集'
    }
  }
}) 