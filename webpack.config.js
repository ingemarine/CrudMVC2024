const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  entry: {
    'js/app' : './src/js/app.js',
    'js/inicio' : './src/js/inicio.js',
    'js/producto/index': './src/js/producto/index.js',
    'js/aplicacion/index' : './src/js/aplicacion/index.js',
    'js/rol/index' : './src/js/rol/index.js',
    'js/usuario/index' : './src/js/usuario/index.js',
    'js/permiso/index' : './src/js/permiso/index.js',
    'js/auth/login': './src/js/auth/login.js',
    'js/auth/registro': './src/js/auth/registro.js',

    
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build')
  },
  plugins: [
    new MiniCssExtractPlugin({
        filename: 'styles.css'
    })
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader
            },
            'css-loader',
            'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpe?g|gif)$/,
        type: 'asset/resource',
      },
    ]
  }
};