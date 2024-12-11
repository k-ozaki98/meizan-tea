const CopyWebpackPlugin = require('copy-webpack-plugin');
const ImageMinimizerPlugin = require('image-minimizer-webpack-plugin');
const path = require('path');

const { merge } = require('webpack-merge');
const baseConfig = require('./webpack.config.base.js');

const config = merge(baseConfig, {
  mode: "production",
  output: {
    path: path.join(__dirname, '/build/assets/js/'),
    // 出力ファイル名
    filename: "index.bundle.js",
  },
  plugins: [
    new CopyWebpackPlugin({
      patterns: [{
        from: path.resolve(__dirname, 'public'),
        to: path.resolve(__dirname, 'build')
      }]
    }),
    new ImageMinimizerPlugin({
      test: /\.(png|jpe?g)$/i,
      minimizer: {
        implementation: ImageMinimizerPlugin.squooshMinify,
        options: {
          encodeOptions: {
            mozjpeg: {
              quality: 90,
            },
            oxipng: {
              level: 3,
              interlace: false,
            }
          },
        },
      },
    }),
  ]
});
module.exports = config;