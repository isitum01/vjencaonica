const path = require('path');

const PATHS = {
  root: path.join(__dirname, '../'),
  assets: path.join(__dirname, '../_vjencaonica'),
  styles: path.join(__dirname, '../_vjencaonica/styles'),
  fonts: path.join(__dirname, '../_vjencaonica/styles/fonts'),
//   fonts: path.join(__dirname, '../_vjencaonica/fonts'),
  scripts: path.join(__dirname, '../_vjencaonica/js'),
  build: path.join(__dirname, '../_vjencaonica/dist'),
  gutenberg: path.join(__dirname, '../_vjencaonica/gutenberg')
};

module.exports = {
  PATHS,
//   WebpackDevServerSettings,
//   WebAppServerSettings,
//   BrowserSyncPort,
};
