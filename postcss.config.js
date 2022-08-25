let taildwindcss = require('tailwindcss');

module.exports = {
  plugins: [
    taildwindcss('./tailwind.config.js'),
    require('postcss-import'),
    require('autoprefixer'),
  ],
}
