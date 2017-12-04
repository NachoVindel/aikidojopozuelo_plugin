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


// ----------------------------

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

add_action('admin_head','remove_personal_options');
function remove_personal_options(){
    echo '<script type="text/javascript">jQuery(document).ready(function($) {
  
$(\'form#your-profile > h2:first\').remove(); // remove the "Personal Options" title
  
$(\'form#your-profile tr.user-rich-editing-wrap\').remove(); // remove the "Visual Editor" field
  
$(\'form#your-profile tr.user-admin-color-wrap\').remove(); // remove the "Admin Color Scheme" field
  
$(\'form#your-profile tr.user-comment-shortcuts-wrap\').remove(); // remove the "Keyboard Shortcuts" field
  
$(\'form#your-profile tr.user-admin-bar-front-wrap\').remove(); // remove the "Toolbar" field
  
$(\'form#your-profile tr.user-language-wrap\').remove(); // remove the "Language" field
  
$(\'form#your-profile tr.user-first-name-wrap\').remove(); // remove the "First Name" field
  
$(\'form#your-profile tr.user-last-name-wrap\').remove(); // remove the "Last Name" field
  
$(\'form#your-profile tr.user-nickname-wrap\').hide(); // Hide the "nickname" field
  
$(\'table.form-table tr.user-display-name-wrap\').remove(); // remove the “Display name publicly as” field
  
$(\'table.form-table tr.user-url-wrap\').remove();// remove the "Website" field in the "Contact Info" section
  
$(\'h2:contains("About Yourself"), h2:contains("About the user")\').remove(); // remove the "About Yourself" and "About the user" titles

$(\'form#your-profile tr.user-description-wrap\').remove(); // remove the "Biographical Info" field
  
$(\'form#your-profile tr.user-profile-picture\').remove(); // remove the "Profile Picture" field

$(\'form#your-profile tr.user-googleplus-wrap\').remove(); // ***
$(\'form#your-profile tr.user-twitter-wrap\').remove(); // ***
$(\'form#your-profile tr.user-facebook-wrap\').remove(); // ***

$(\'h2:contains("Acerca del Usuario")\').remove(); // ***
$(\'h3:contains("Capacidades adicionales")\').remove(); // ***
$(\'table.form-table tr.user-display-name-wrap\').remove(); // ***


  
$(\'table.form-table tr.user-aim-wrap\').remove();// remove the "AIM" field in the "Contact Info" section
 
$(\'table.form-table tr.user-yim-wrap\').remove();// remove the "Yahoo IM" field in the "Contact Info" section
 
$(\'table.form-table tr.user-jabber-wrap\').remove();// remove the "Jabber / Google Talk" field in the "Contact Info" section
 
});</script>';
  
}


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
    		$out.= '<li><a href="/admin-dojo/?id_alumno=' . $usuario->id . '">' . esc_html( $usuario->first_name ) . ' ' . esc_html( $usuario->last_name ) 
    		. '</a> (<a href="/admin-dojo/?accion=activar_alumno&id_alumno=' . $usuario->id . '">Activar</a> ' 
    		. '- <a href="/admin-dojo/?accion=desactivar_alumno&id_alumno=' . $usuario->id . '">Desactivar</a> '
    		. '- <a href="/wp-admin/user-edit.php?user_id=' . $usuario->id . '&wp_http_referer=%2Fadmin%2">Editar</a>)';
    	
    	$out.='</ul>';
    } 
    else
    	$out.= 'No hay usuarios con el rol de "' . $rol . '"';
    
    return $out;
}



//add_shortcode('adp_lista_alumnos','adp_lista_alumnos');
function adp_lista_alumnos()
{
    return adp_lista_usuarios ('alumno');
}

//add_shortcode('adp_lista_pendientes_activar','adp_lista_pendientes_activar');
function adp_lista_pendientes_activar()
{
    return adp_lista_usuarios ('pendiente_activar');
}


function adp_activar_alumno ($id_alumno)
{   
    $user = new \WP_User( $id_alumno );
	$user->set_role( 'alumno' );
}

function adp_desactivar_alumno ($id_alumno)
{   
    $user = new \WP_User( $id_alumno );
	$user->set_role( 'pendiente_activar' );
}

function adp_ficha_alumno($id_alumno)
{
    $out = 
    '[wpmem_avatar]
    <h5></h5>
    <h5>Datos Personales</h5>
    <ul>
     	<li><strong>Nombre</strong>: ' . get_user_meta( $id_alumno->id, 'first_name', true ) . ' ' .get_user_meta( $id_alumno->id, 'last_name', true ) . '</li>
     	<li><strong>Dirección</strong>: ' . get_user_meta( $id_alumno->id, 'addr1', true ) . ', ' . get_user_meta( $id_alumno->id, 'zip', true ) . ' - ' . get_user_meta( $id_alumno->id, 'city', true ) . ' (' . get_user_meta( $id_alumno->id, 'thestate', true ) . ')</li>
     	<li><strong>Teléfono</strong>: ' . get_user_meta( $id_alumno->id, 'phone1', true ) . '</li>
     	<li><strong>Email</strong>: ' . get_user_meta( $id_alumno->id, 'user_email', true ) . '</li>
     	<li><strong>Fecha de Nacimiento</strong>: ' . get_user_meta( $id_alumno->id, 'bithdate', true ) . '</li>
    </ul>
    <strong><em><a href="/area-alumnos/editar-alumno">Editar</a></em></strong>
    <h5>Licencia</h5>
    <ul>
     	<li>' . get_user_meta( $id_alumno->id, 'licencia_aikikan', true ) . '</li>
    </ul>
    <h5>Práctica</h5>
    <ul>
     	<li><strong>Inicio</strong>: ' . my_get_user_date(array('fecha' => 'fecha_ingreso_dojo')) . ' - ' . my_get_user_datediff(array('fecha_inicio' => 'fecha_ingreso_dojo', 'fecha_fin' => '')) . '</li>
    </ul>
    <h5>Grados Kyu</h5>
    <ul>
     	<li><strong><span style="color: #ffcc00;">5º Kyu</span></strong>: ' . my_get_user_date(array('fecha' => 'fecha_5kyu')) . ' - ' . my_get_user_datediff(array('fecha_inicio' => 'fecha_5kyu', 'fecha_fin' => 'fecha_4kyu')) . '</li>
     	<li><strong><span style="color: #ff6600;">4º Kyu</span></strong>: ' . my_get_user_date(array('fecha' => 'fecha_4kyu')) . ' - ' . my_get_user_datediff(array('fecha_inicio' => 'fecha_4kyu', 'fecha_fin' => 'fecha_3kyu')) . '</li>
     	<li><strong><span style="color: #008000;">3º Kyu</span></strong>: ' . my_get_user_date(array('fecha' => 'fecha_3kyu')) . ' - ' . my_get_user_datediff(array('fecha_inicio' => 'fecha_3kyu', 'fecha_fin' => 'fecha_2kyu')) . '</li>
     	<li><strong><span style="color: #0000ff;">2º Kyu</span></strong>: ' . my_get_user_date(array('fecha' => 'fecha_2kyu')) . ' - ' . my_get_user_datediff(array('fecha_inicio' => 'fecha_2kyu', 'fecha_fin' => 'fecha_1kyu')) . '</li>
     	<li><strong><span style="color: #800000;">1º Kyu</span></strong>: ' . my_get_user_date(array('fecha' => 'fecha_1kyu')) . ' - ' . my_get_user_datediff(array('fecha_inicio' => 'fecha_1kyu', 'fecha_fin' => 'fecha_shodan')) . '</li>
    </ul>
    <h5>Grados DAN</h5>
    <ul>
     	<li><strong><span style="color: #333333;">Shodan</span></strong>: ' . my_get_user_date(array('fecha' => 'fecha_shodan')) . ' - ' . my_get_user_datediff(array('fecha_inicio' => 'fecha_shodan', 'fecha_fin' => 'fecha_nidan')) . '</li>
     	<li><strong><span style="color: #333333;">Nidan</span></strong>: ' . my_get_user_date(array('fecha' => 'fecha_shodan')) . ' - ' . my_get_user_datediff(array('fecha_inicio' => 'fecha_nidan', 'fecha_fin' => 'fecha_sandan')) . '</li>
     	<li><span style="color: #333333;"><strong>Sandan</strong></span>: ' . my_get_user_date(array('fecha' => 'fecha_shodan')) . ' - ' . my_get_user_datediff(array('fecha_inicio' => 'fecha_sandan', 'fecha_fin' => 'fecha_yondan')) . '</li>
     	<li><span style="color: #333333;"><strong>Yondan</strong></span>: ' . my_get_user_date(array('fecha' => 'fecha_shodan')) . ' - ' . my_get_user_datediff(array('fecha_inicio' => 'fecha_yondan', 'fecha_fin' => '')) . '</li>
    </ul>';
    
    return $sout;
}

add_shortcode('adp_acciones_admin','adp_acciones_admin');
function adp_acciones_admin()
{
    $out = '';
    
    if (isset($_GET['accion']))
        $accion = $_GET['accion'];
    else
        $accion = '';
        
        
    if (isset($_GET['id_alumno']))
        $id_alumno = $_GET['id_alumno'];
    else {
        $id_alumno = '';
    }
    switch($accion)
    {
        case '':
            $out = 'Lista de Alumnos<br/>'
                . adp_lista_alumnos() . '<br/>'
                . 'Pendiente de Activar</br>'
                . adp_lista_pendientes_activar();
            break;
            
        case 'desactivar_alumno':
            if ($id_alumno != '')
            {   
                adp_desactivar_alumno ($id_alumno);
            }
            break;
        case 'activar_alumno':
            if ($id_alumno != '')
            {
                adp_activar_alumno ($id_alumno);
            }
            break;
        case 'ficha_alumno':
            if ($id_alumno != '')
            {
                $out = adp_ficha_alumno ($id_alumno);
            }
            break;
        default:
            break;
    }
    
    return $out;
    
}

// ---------------------


run_aikidojopozuelo_plugin();
