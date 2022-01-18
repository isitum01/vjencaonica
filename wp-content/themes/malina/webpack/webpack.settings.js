// const ewThemeConfig = require('../theme-config');

const path = require('path');

const PATHS = {
  root: path.join(__dirname, '../'),
  assets: path.join(__dirname, '../assets'),
  styles: path.join(__dirname, '../assets/styles'),
  fonts: path.join(__dirname, '../assets/styles/fonts'),
//   fonts: path.join(__dirname, '../assets/fonts'),
  scripts: path.join(__dirname, '../assets/js'),
  build: path.join(__dirname, '../assets/dist'),
  gutenberg: path.join(__dirname, '../assets/gutenberg')
};

module.exports = {
  PATHS,
//   WebpackDevServerSettings,
//   WebAppServerSettings,
//   BrowserSyncPort,
};
