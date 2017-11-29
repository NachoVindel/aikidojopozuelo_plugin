<?php

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
    		$out.= '<li><a href="/admin-dojo/ficha-alumno/?id=' . $usuario->id . '">' . esc_html( $usuario->first_name ) . ' ' . esc_html( $usuario->last_name ) 
    		. '</a> (<a href="/admin-dojo/?accion=activar&id_alumno=' . $usuario->id . '">Activar</a> - <a href="/admin-dojo/?accion=desactivar&id_alumno=' . $usuario->id . '">Desactivar</a>)';
    	
    	$out.='</ul>';
    } 
    else
    	$out.= 'No hay usuarios con el rol de "' . $rol . '"';
    
    return $out;
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

add_shortcode('adp_acciones_admin','adp_acciones_admin');
function adp_acciones_admin()
{
    if (isset($_GET['accion'])) {
      $accion = $_GET['accion'];
      
      switch($accion)
      {
        case 'desactivar_alumno':
            if (isset($_GET['id_alumno']))
            {    
                $id_alumno = $_GET['id_alumno'];
                adp_desactivar_alumno ($id_alumno);
            }
            break;
        case 'activar_alumno':
            if (isset($_GET['id_alumno']))
            {
                $id_alumno = $_GET['id_alumno'];
                adp_activar_alumno ($id_alumno);
            }
            break;
            break;
        default:
            break;
      }
    }
    
    return null;
    
}
