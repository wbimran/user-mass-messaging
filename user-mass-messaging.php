<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/wbimran/
 * @since             1.0.0
 * @package           User_Mass_Messaging
 *
 * @wordpress-plugin
 * Plugin Name:       User Mass Messaging
 * Plugin URI:        https://github.com/wbimran/
 * Description:       Mass message to friends 
 * Version:           1.0.0
 * Author:            Mohammad Imran
 * Author URI:        https://github.com/wbimran//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       user-mass-messaging
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
define( 'USER_MASS_MESSAGING_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-user-mass-messaging-activator.php
 */
function activate_user_mass_messaging() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-user-mass-messaging-activator.php';
	User_Mass_Messaging_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-user-mass-messaging-deactivator.php
 */
function deactivate_user_mass_messaging() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-user-mass-messaging-deactivator.php';
	User_Mass_Messaging_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_user_mass_messaging' );
register_deactivation_hook( __FILE__, 'deactivate_user_mass_messaging' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-user-mass-messaging.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_user_mass_messaging() {

	$plugin = new User_Mass_Messaging();
	$plugin->run();

}
run_user_mass_messaging();
