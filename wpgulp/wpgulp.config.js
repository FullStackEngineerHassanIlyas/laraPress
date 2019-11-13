/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package WPGulp
 */
let path = require('path');
let dirPath = path.resolve(__dirname, '..');

let plugin_name = path.basename(dirPath);
let root = dirPath;

let config = {
	plugin_name: plugin_name,
	root: dirPath,

	// Project options.
	projectURL: 'http://localhost/wordpress/', // Local project URL of your already running WordPress site. Could be something like wpgulp.local or localhost:3000 depending upon your local WordPress setup.
	productURL: './', // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.
	browserAutoOpen: false,
	injectChanges: true,

	// Style options.
	styleSRC: root+'/src/public/scss/style.scss', // Path to main .scss file.
	styleDestination: root+'/app/assets/public/css', // Path to place the compiled CSS file. -->Default set to root folder.<--
	styleFile: plugin_name,
	outputStyle: 'expanded', // Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
	errLogToConsole: true,
	precision: 10,

	// JS Vendor options.
	jsVendorSRC: [
		root+'/src/public/js/vendor/*.js'
	], // Path to JS vendor folder.
	jsVendorDestination: root+'/app/assets/public/js/', // Path to place the compiled JS vendors file.
	jsVendorFile: plugin_name, // Compiled JS vendors file name. Default set to vendors i.e. vendors.js.

	// JS Custom options.
	jsCustomSRC: root+'/src/public/js/custom/*.js', // Path to JS custom scripts folder.
	jsCustomDestination: root+'/assets/public/js/', // Path to place the compiled JS custom scripts file.
	jsCustomFile: plugin_name+'-custom', // Compiled JS custom file name. Default set to custom i.e. custom.js.

	// Images options.
	imgSRC: root+'/src/public/images/**/*', // Source folder of images which should be optimized and watched. You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
	imgDST: root+'/assets/public/images/', // Destination folder of optimized images. Must be different from the imagesSRC folder.

	// Watch files paths.
	watchStyles: root+'/src/public/scss/**/*.scss', // Path to all *.scss files inside css folder and inside them.
	watchJsVendor: root+'/src/public/js/vendor/*.js', // Path to all vendor JS files.
	watchJsCustom: root+'/src/public/js/custom/*.js', // Path to all custom JS files.
	watchPhp: root+'/**/*.php', // Path to all PHP files.

	// Translation options.
	textDomain: 'WPGULP', // Your textdomain here.
	translationFile: 'WPGULP.pot', // Name of the translation file.
	translationDestination: './languages', // Where to save the translation files.
	packageName: 'WPGULP', // Package name.
	lastTranslator: 'Hassan Mughal <your_email@email.com>', // Last translator Email ID.
	team: 'HassanMughal <your_email@email.com>', // Team's Email ID.

	// Browsers you care about for autoprefixing. Browserlist https://github.com/ai/browserslist
	// The following list is set as per WordPress requirements. Though, Feel free to change.
	BROWSERS_LIST: [
		'last 99 version',
		'> 90%',
		'ie >= 11',
		'last 99 Android versions',
		'last 99 ChromeAndroid versions',
		'last 99 Chrome versions',
		'last 99 Firefox versions',
		'last 99 Safari versions',
		'last 99 iOS versions',
		'last 99 Edge versions',
		'last 99 Opera versions'
	]
};
module.exports = config;
