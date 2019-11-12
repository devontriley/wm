<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.example.com
 * @since             1.0.0
 * @package           Wholistic_Matters
 *
 * @wordpress-plugin
 * Plugin Name:       Wholistic Matters
 * Plugin URI:        https://www.example.com
 * Description:       Custom Plugin for Wholistic Matters Website
 * Version:           1.0.0
 * Author:            WholisticMatters
 * Author URI:        https://www.example.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wholistic-matters
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'W_M_VERSION', '1.0.0' );
define( 'W_M_BOOKMARK_TBL', 'wm_bookmark' );
define( 'W_M_BOOKMARK_CAT_TBL', 'wm_bookmark_folder' );
define( 'W_M_PATH', plugin_dir_path( __FILE__ ) );
if(!defined('WM_META_PREFIX')){
	define( 'WM_META_PREFIX', '_wm_' );
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wholistic-matters-activator.php
 */
function activate_wholistic_matters() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wholistic-matters-activator.php';
	Wholistic_Matters_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wholistic-matters-deactivator.php
 */
function deactivate_wholistic_matters() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wholistic-matters-deactivator.php';
	Wholistic_Matters_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wholistic_matters' );
register_deactivation_hook( __FILE__, 'deactivate_wholistic_matters' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'vendor/dependency.php';
include_once plugin_dir_path( __FILE__ ) . 'vendor/taxonomy-term-image/taxonomy-term-image.php';
require_once plugin_dir_path( __FILE__ ) . 'vendor/wp-menu-item-custom-fields/menu-item-custom-fields.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-wholistic-matters.php';
require plugin_dir_path(__FILE__) . 'includes/class-wholistic-matters-helper.php';
require plugin_dir_path(__FILE__) . 'includes/template-tags.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wholistic_matters() {
	$plugin = new Wholistic_Matters();
	$plugin->run();

}
run_wholistic_matters();
