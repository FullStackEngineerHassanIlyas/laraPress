/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package WPGulp
 */
let plugin_name = 'autobiddy-members';
let root = `../../${plugin_name}/`;
module.exports = {

	// Project options.
	projectURL: 'http://localhost/autobiddy/', // Local project URL of your already running WordPress site. Could be something like wpgulp.local or localhost:3000 depending upon your local WordPress setup.
	productURL: './', // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.
	browserAutoOpen: false,
	injectChanges: true,
	root: root,

	// Style options.
	styleSRC: root+'src/scss/style.scss', // Path to main .scss file.
	styleDestination: root+'assets/css', // Path to place the compiled CSS file. -->Default set to root folder.<--
	styleFile: plugin_name,
	outputStyle: 'expanded', // Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
	errLogToConsole: true,
	precision: 10,

	// JS Vendor options.
	jsVendorSRC: [
		root+'src/js/vendor/*.js'
	], // Path to JS vendor folder.
	jsVendorDestination: root+'assets/js/', // Path to place the compiled JS vendors file.
	jsVendorFile: plugin_name, // Compiled JS vendors file name. Default set to vendors i.e. vendors.js.

	// JS Custom options.
	jsCustomSRC: root+'src/js/custom/*.js', // Path to JS custom scripts folder.
	jsCustomDestination: root+'assets/js/', // Path to place the compiled JS custom scripts file.
	jsCustomFile: 'custom', // Compiled JS custom file name. Default set to custom i.e. custom.js.

	// Images options.
	imgSRC: root+'assets/images/raw/**/*', // Source folder of images which should be optimized and watched. You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
	imgDST: root+'assets/images/', // Destination folder of optimized images. Must be different from the imagesSRC folder.

	// Watch files paths.
	watchStyles: root+'src/scss/**/*.scss', // Path to all *.scss files inside css folder and inside them.
	watchJsVendor: root+'src/js/vendor/*.js', // Path to all vendor JS files.
	watchJsCustom: root+'src/js/custom/*.js', // Path to all custom JS files.
	watchPhp: root+'**/*.php', // Path to all PHP files.

	// Translation options.
	textDomain: 'WPGULP', // Your textdomain here.
	translationFile: 'WPGULP.pot', // Name of the translation file.
	translationDestination: './languages', // Where to save the translation files.
	packageName: 'WPGULP', // Package name.
	bugReport: 'https://AhmadAwais.com/contact/', // Where can users report bugs.
	lastTranslator: 'Ahmad Awais <your_email@email.com>', // Last translator Email ID.
	team: 'AhmadAwais <your_email@email.com>', // Team's Email ID.

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
