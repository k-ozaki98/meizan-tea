const CopyWebpackPlugin = require('copy-webpack-plugin');
const path = require('path');

const { merge } = require('webpack-merge');
const baseConfig = require('./webpack.config.base.js');

const config = merge(baseConfig, {
  mode: "development",
  devtool: 'inline-source-map',
  plugins: [
  ],
});
module.exports = config;