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


 
 
/*add_shortcode('user_kyus_dates','my_get_users_kyus_dates');
function my_get_users_kyus_dates($atts = null)
{
	$out = '';
	
    $user = wp_get_current_user();
    
    $array = array();
    
    if (!empty($user->fecha_5kyu))
        $array["Fecha 5º Kyu"] = $user->fecha_5kyu;
        
    if (!empty($user->fecha_4kyu))
        $array["Fecha 4º Kyu"] = $user->fecha_4kyu;
        
    if (!empty($user->fecha_3kyu))
        $array["Fecha 3º Kyu"] = $user->fecha_3kyu;
        
    if (!empty($user->fecha_2kyu))
        $array["Fecha 2º Kyu"] = $user->fecha_2kyu;
        
    if (!empty($user->fecha_1kyu))
        $array["Fecha 1º Kyu"] = $user->fecha_1kyu;
    
    
    foreach ($array as $key => $value)
    {
        $out.= '<span>' . esc_html( $key ) . ': ' . esc_html( date_format(date_create($value),'d-m-Y') ) . '</span><br/>';
    }
	
	return $out;

}*/

/*add_shortcode('user_dans_dates','my_get_users_dans_dates');
function my_get_users_dans_dates($atts = null)
{
	$out = '';
	
    $user = wp_get_current_user();
    
    $array = array();
    
    if (!empty($user->fecha_5kyu))
        $array["Fecha Shodan"] = $user->fecha_shodan;
        
    if (!empty($user->fecha_4kyu))
        $array["Fecha Nidan"] = $user->fecha_nidan;
        
    if (!empty($user->fecha_3kyu))
        $array["Fecha Sandan"] = $user->fecha_sandan;
        
    if (!empty($user->fecha_2kyu))
        $array["Fecha Yondan"] = $user->fecha_yondan;
    
    foreach ($array as $key => $value)
    {
        $out.= '<span>' . esc_html( $key ) . ': *****' . esc_html( date_format(date_create($value),'d-m-Y') ) . '</span><br/>';
    }
	
	return $out;

}*/


function adp_format_date ($date)
{
    $dias = array("Dom","Lun","Mar","Mie","Jue","Vie","Sab");
    $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

    return '' . $dias[$date->format('w')] . ' ' . $date->format('j') . "-" . $meses[$date->format('n')-1] . "-" . $date->format('Y') ;
}

function adp_user_get_date($fecha='')
{
    if ($fecha != '')
    {
        $user = wp_get_current_user();
        $d_fecha = date_create( get_user_meta( $user->id, $fecha, true ) );
    }
    else
        $d_fecha = date_create();
    
	return $d_fecha;
}

add_shortcode('user_date','my_get_user_date');
function my_get_user_date($atts)
{
	$out = '';
	//$user = wp_get_current_user();
	
	extract( shortcode_atts( array(
        'fecha' => ''
    ), $atts ) );
    
    $d_fecha = adp_user_get_date($fecha);
    if ($d_fecha->format('Ymd') != date('Ymd'))
        $out = adp_format_date($d_fecha);
    
	return $out;

}

add_shortcode('user_datediff','my_get_user_datediff');
function my_get_user_datediff($atts)
{
    $out = '';
    
	extract( shortcode_atts( array(
        'fecha_inicio' => '',
        'fecha_fin' => ''
    ), $atts ) );
    
    $d_fecha_inicio = adp_user_get_date($fecha_inicio);
    $d_fecha_fin = adp_user_get_date($fecha_fin);
    $date_diff = date_diff($d_fecha_fin, $d_fecha_inicio);
    
    if ($date_diff->days > 0)
    {
    
        if ($date_diff->y == 1)
            $out .= '1 año, ';
        else
            $out .= $date_diff->y . ' años, ';
            
        if ($date_diff->m == 1)
            $out .= '1 mes, ';
        else
            $out .= $date_diff->m . ' meses, ';
            
        if ($date_diff->d == 1)
            $out .= '1 día';
        else
            $out .= $date_diff->d . ' días';
    }
    
    return $out;
}

function adp_lista_usuarios($rol)
{
    if ($rol == '')
        $rol = 'alumno';

    $usuarios = get_users( 'role=' . $rol . '&orderby=first_name' );
    
    if( $usuarios )
    {
        $out.='<ul>';
    	foreach ( $usuarios as $usuario ) 
    		$out.= '<li><a href="/admin-dojo/ficha-alumno/?id=' . $usuario->id . '">' . esc_html( $usuario->first_name ) . ' ' . esc_html( $usuario->last_name ) . '</a>';
    	
    	$out.='</ul>';
    } 
    else
    	$out.= 'No hay usuarios con el rol de "' . $rol . '"';
    
    return $out;
}



add_shortcode('adp_lista_alumnos','adp_lista_alumnos');
function adp_lista_alumnos()
{
    return adp_lista_usuarios ('alumno');
}

add_shortcode('adp_lista_pendientes_activar','adp_lista_pendientes_activar');
function adp_lista_pendientes_activar()
{
    return adp_lista_usuarios ('pendiente_activar');
}
 
 
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
run_aikidojopozuelo_plugin();
