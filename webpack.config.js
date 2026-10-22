const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');

const createConfig = (app) => ({
    entry: {
        app: path.resolve(__dirname, `./${app}/web/js/app.js`),
        style: path.resolve(__dirname, `./${app}/web/css/style.less`),
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, `./${app}/web/bundle`),
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: 'babel-loader',
            },
            {
                test: /\.less$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader', 'less-loader'],
            },
            {
                test: /\.(png|jpe?g|gif|svg|woff2?|ttf|eot)$/i,
                type: 'asset',
                parser: {
                    dataUrlCondition: {
                        maxSize: 100000,
                    },
                },
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css',
        }),
    ],
    optimization: {
        minimizer: [
            new TerserPlugin({ parallel: true }),
            new CssMinimizerPlugin(),
        ],
    },
    devtool: 'source-map',
});

module.exports = [createConfig('frontend'), createConfig('backend')];
