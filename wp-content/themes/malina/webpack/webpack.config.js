// Include settings
const settings = require('./webpack.settings');

// Include externals
const externals = require('./webpack.externals');

const PATHS = settings.PATHS;

var config = {
    // Define entries for javascript and style files.
    entry: {
        // Main entry for all files
        bundle: [
            //   'babel-polyfill',
            //   'react-hot-loader/patch', // Patch for react hot loader
            PATHS.scripts + '/main.js'
        ]
    },

    // Define output for webpack
    output: {
        // Output directory path
        path: PATHS.build,

        // Output file name as [entry-point-name].min.js
        filename: '[name].min.js',
    },

    // Adds externals
    externals,

    // Define mode
    mode: 'development',

    // Set up loaders for files
    module: {
        // Define rules for files
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                use: 'babel-loader'
            },
            {
                test: /\.s[ac]ss$/i,
                use: [
                    // Creates `style` nodes from JS strings
                    "style-loader",
                    // Translates CSS into CommonJS
                    "css-loader",
                    // Compiles Sass to CSS
                    "sass-loader",
                ],
            },
            {
                test: /\.module\.scss$/,
                include: [
                    PATHS.assets,
                ],
                use: [
                    'style-loader',
                    {
                        loader: 'css-loader',
                        options: {
                            modules: true,
                            importLoaders: true,
                            localIdentName: '[name]__[local]___[hash:base64:5]',
                        },
                    },
                    'sass-loader',
                ],
            }
        ],
    },

};

module.exports = config;