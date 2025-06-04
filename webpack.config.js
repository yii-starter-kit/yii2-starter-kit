const path = require('path');
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

var config = {
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: [/node_modules/],
                use: [
                    {
                        loader: 'babel-loader',
                        options: { presets: ['latest'] }
                    }
                ]
            },
            {
                test: /\.less$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'less-loader'
                ]
            }, {
                test: /.(png|jpg|jpeg|gif|svg|woff|woff2|ttf|eot)$/,
                loader: 'url-loader?limit=100000'
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "[name].css",
            allChunks: true
        })
    ],
    optimization: {
        minimizer: [
            new UglifyJsPlugin({
                cache: true,
                parallel: true,
                sourceMap: true
            }),
            new OptimizeCSSAssetsPlugin({})
        ]
    },
    devtool: 'source-map'
}

var frontendConfig = Object.assign({}, config, {
    entry: {
        app: path.resolve(__dirname, './frontend/web/js/app.js'),
        style: path.resolve(__dirname, './frontend/web/css/style.less'),
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, './frontend/web/bundle'),
    },
});

var backendConfig = Object.assign({}, config, {
    entry: {
        app: path.resolve(__dirname, './backend/web/js/app.js'),
        style: path.resolve(__dirname, './backend/web/css/style.less'),
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, './backend/web/bundle'),
    },
});

module.exports = [
    frontendConfig, backendConfig
];
