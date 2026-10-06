const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin')

const isProd = process.env.NODE_ENV === 'production'

module.exports = {
	mode: isProd ? 'production' : 'development',

	entry: {
		global: ['./src/js/global.js', './src/scss/index.scss'],
	},

	output: {
		path: path.resolve(__dirname, './dist'),
		filename: 'js/[name].bundle.js',
		// Автоматически очищает папку ./dist перед новой сборкой (замена CleanWebpackPlugin)
		clean: true,
	},

	devtool: isProd ? false : 'source-map',

	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/preset-env'], // Плагин class-properties уже встроен в современные пресеты
					},
				},
			},
			{
				test: /\.(scss|css)$/,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
								plugins: [
									'postcss-preset-env', // Автоматические префиксы и поддержка современных свойств CSS
								],
							},
						},
					},
					{
						loader: 'sass-loader',
						options: {
							api: 'modern',
						},
					},
				],
			},
		],
	},

	plugins: [
		new MiniCssExtractPlugin({
			filename: 'css/[name].bundle.css',
		}),
	],

	optimization: {
		minimizer: [
			`...`, // Сохраняет стандартный TerserPlugin для минификации JS
			new CssMinimizerPlugin(), // Минификация CSS в production режиме
		],
	},
}
