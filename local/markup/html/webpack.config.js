const path = require('path');
const fs = require('fs');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CopyPlugin = require("copy-webpack-plugin");
const PugPlugin = require('pug-plugin');
const {VueLoaderPlugin} = require('vue-loader');
const Webpack = require('webpack');

const PATHS = {
	src: path.join(__dirname, './src'),
	build: path.join(__dirname, './build')
};
const PAGES_DIR = `${PATHS.src}/pug`;
const PAGES = fs.readdirSync(PAGES_DIR).filter(filename => filename.endsWith('.pug'));

module.exports = {
	mode: 'development',
	entry: [
		`${PATHS.src}/js/core.js`,
		`${PATHS.src}/style/scss/style.scss`,
	],
	externals: {
		ymaps3: 'ymaps3'
	},
	devtool: 'source-map',
	devServer: {
		historyApiFallback: true,
		static: path.resolve(__dirname, './build'),
		open: true,
		compress: true,
		host: '0.0.0.0',
		hot: true,
		port: 27000,
	},
	output: {
		path: `${PATHS.build}`,
		filename: 'js/bundle.js',
	},
	plugins: [
		new Webpack.DefinePlugin({__VUE_OPTIONS_API__: true, __VUE_PROD_DEVTOOLS__: true}),
		new VueLoaderPlugin(),
		new CopyPlugin({
			patterns: [
				{from: `${PATHS.src}/images`, to: `${PATHS.build}/images`},
				// {from: `${PATHS.src}/fonts`, to: `${PATHS.build}/assets/fonts`},
				// {from: "other", to: "public"},
			],
		}),
		new MiniCssExtractPlugin({
			chunkFilename: "css/chunks/[id].css",
			filename: "css/[name].css",
		}),
		...PAGES.map(page => new HtmlWebpackPlugin({
			inject: 'body',
			template: `${PAGES_DIR}/${page}`,
			filename: `./${page.replace(/\.pug/, '.html')}`
		}))
	],
	module: {
		rules: [
			{
				test: /\.vue$/i,
				loader: 'vue-loader',
			},
			{
				test: /\.pug$/i,
				use: ['@webdiscus/pug-loader'],
			},
			{
				test: /\.css$/i,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							url: false,
						},
					},
				],
			},
			{
				test: /\.scss$/i,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							url: false,
						},
					},
					'sass-loader'
				],
			},
			{
				test: /\.m?js$/,
				exclude: /(node_modules|bower_components)/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env']
					}
				},
			},
			{
				test: /\.m?js$/,
				resolve: {
					fullySpecified: false,
				},
			},
		]
	}
};