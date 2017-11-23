<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       Nacho Vindel
 * @since      1.0.0
 *
 * @package    Aikidojopozuelo_plugin
 * @subpackage Aikidojopozuelo_plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Aikidojopozuelo_plugin
 * @subpackage Aikidojopozuelo_plugin/includes
 * @author     Nacho Vindel <nacho.vindel@gmail.com>
 */
class Aikidojopozuelo_plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'aikidojopozuelo_plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
