const tailwindCSS = require( "tailwindcss" );
const autoprefixer = require( "autoprefixer" );

module.exports = {
	plugins: [
		tailwindCSS( "tailwind.config.js" ),
		autoprefixer,
	],
};
