<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/wbimran/
 * @since      1.0.0
 *
 * @package    User_Mass_Messaging
 * @subpackage User_Mass_Messaging/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    User_Mass_Messaging
 * @subpackage User_Mass_Messaging/includes
 * @author     Mohammad Imran <mimran034mohd@gmail.com>
 */
class User_Mass_Messaging_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'user-mass-messaging',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
