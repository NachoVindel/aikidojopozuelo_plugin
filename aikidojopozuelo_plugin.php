<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Nacho Vindel
 * @since             1.0.0
 * @package           Aikidojopozuelo_plugin
 *
 * @wordpress-plugin
 * Plugin Name:       AikidojoPozuelo_Plugin
 * Plugin URI:        AikidojoPozuelo_Plugin
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Nacho Vindel
 * Author URI:        Nacho Vindel
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       aikidojopozuelo_plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-aikidojopozuelo_plugin-activator.php
 */
function activate_aikidojopozuelo_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aikidojopozuelo_plugin-activator.php';
	Aikidojopozuelo_plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-aikidojopozuelo_plugin-deactivator.php
 */
function deactivate_aikidojopozuelo_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aikidojopozuelo_plugin-deactivator.php';
	Aikidojopozuelo_plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_aikidojopozuelo_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_aikidojopozuelo_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-aikidojopozuelo_plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_aikidojopozuelo_plugin() {

	$plugin = new Aikidojopozuelo_plugin();
	$plugin->run();

}

include_once( plugin_dir_path( __FILE__ ) . 'includes/adp/adp_funciones.php' );
add_action('admin_head','action_remove_personal_options');
//add_shortcode('user_date','code_user_date');
//add_shortcode('user_datediff','code_user_datediff');
add_shortcode('adp_acciones_admin','code_adp_acciones_admin');
add_shortcode('adp_ficha_alumno','code_adp_ficha_alumno');

run_aikidojopozuelo_plugin();
