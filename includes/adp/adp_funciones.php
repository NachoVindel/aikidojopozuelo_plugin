<?php



function adp_FormatDate($date)
{
    $out = '';
    if ($date->format('Ymd') != date('Ymd'))
    {
        $dias = array("Dom","Lun","Mar","Mie","Jue","Vie","Sab");
        $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

        $out = $dias[$date->format('w')] . ' ' . $date->format('j') . "-" . $meses[$date->format('n')-1] . "-" . $date->format('Y') ;
    }
    return $out;
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

/*
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
*/



function adp_lista($usuarios)
{
    if( $usuarios )
    {
        $out.='<ul>';
    	foreach ( $usuarios as $usuario ) 
    		$out.= '<li><a href="/admin-dojo/?accion=ficha_alumno&id_alumno=' . $usuario->id . '">' . esc_html( $usuario->first_name ) . ' ' . esc_html( $usuario->last_name ) 
    		. '</a> (<a href="/admin-dojo/?accion=activar_alumno&id_alumno=' . $usuario->id . '">Activar</a> ' 
    		. '- <a href="/admin-dojo/?accion=desactivar_alumno&id_alumno=' . $usuario->id . '">Desactivar</a> '
    		. '- <a href="/wp-admin/user-edit.php?user_id=' . $usuario->id . '&wp_http_referer=%2Fadmin%2">Editar</a>)';
    	
    	$out.='</ul>';
    } 
    else
    	$out.= 'No hay usuarios con el rol de "' . $rol . '"';
    
    return $out;
}



/*
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
     	<li><strong>Fecha de Nacimiento</strong>: ' . get_user_meta( $id_alumno->id, 'birthdate', true ) . '</li>
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
    
    return $out;
}
*/

/***************************************************
 * SHORTCODES
 * *************************************************/
/*
function code_user_date($atts)
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

function code_user_datediff($atts)
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
*/

function code_adp_acciones_admin()
{
    $out = '';
    
    if (isset($_GET['accion']))
        $accion = $_GET['accion'];
    else
        $accion = '';
        
    if (isset($_GET['id_alumno']))
        $id_alumno = $_GET['id_alumno'];
    else 
        $id_alumno = '';
    
    switch($accion)
    {
        case '':
            $out = 'Lista de Alumnos<br/>'
                . adp_lista (adp_Alumno::ListaAlumnos()) . '<br/>'
                . 'Pendiente de Activar</br>'
                . adp_lista (adp_Alumno::ListaPendientesActivar());
            break;
            
        case 'desactivar_alumno':
            if ($id_alumno != '')
            {   
                adp_Alumno::Desactivar($id_alumno);
            }
            break;
            
        case 'activar_alumno':
            if ($id_alumno != '')
            {
                adp_Alumno::Activar($id_alumno);
            }
            break;
            
        case 'ficha_alumno':
            //echo 'ficha_alumno';
            if ($id_alumno != '')
            {
                //echo ' ' . $id_alumno;
                $out = code_adp_ficha_alumno($id_alumno);
                
            }
            break;
            
        default:
            break;
    }
    
    return $out;
}

function code_adp_ficha_alumno($idAlumno)
{
    if ($idAlumno = "")
        $idAlumno = null;
        
    echo 'code_adp_ficha_alumno';
        
    $alumno = new adp_Alumno($idAlumno);
    
    $out = '
    <h5></h5>
    <h5>Datos Personales</h5>
    <ul>
     	<li><strong>Nombre</strong>:'.$alumno->NombreCompleto.'</li>
     	<li><strong>Dirección</strong>: '.$alumno->Direccion.' ,'.$alumno->CP.' - '.$alumno->Ciudad.' ('.$alumno->Comunidad.')</li>
     	<li><strong>Teléfono</strong>: '.$alumno->Movil.'</li>
     	<li><strong>Email</strong>: '.$alumno->Email.'</li>
     	<li><strong>Fecha de Nacimiento</strong>: '.adp_FormatDate($alumno->FechaNacimiento).'</li>
    </ul>
    <strong><em><a href="/area-alumnos/editar-alumno">Editar</a></em></strong>
    <h5>Licencia</h5>
    <ul>
     	<li>'.$alumno->LicenciaAikikan.'</li>
    </ul>
    <h5>Práctica</h5>
    <ul>
     	<li><strong>Inicio</strong>: '.adp_FormatDate($alumno->FechaIngresoDojo).' - '.adp_Alumno::TiempoEntreExamenes($alumno->FechaIngresoDojo, null).'</li>
    </ul>
    <h5>Grados Kyu</h5>
    <ul>
     	<li><strong><span style="color: #ffcc00;">5º Kyu</span></strong>: '.adp_FormatDate($alumno->Fecha5Kyu).' - '.adp_Alumno::TiempoEntreExamenes($alumno->Fecha5Kyu, $alumno->Fecha4Kyu).'</li>
     	<li><strong><span style="color: #ff6600;">4º Kyu</span></strong>: '.adp_FormatDate($alumno->Fecha4Kyu).' - '.adp_Alumno::TiempoEntreExamenes($alumno->Fecha4Kyu, $alumno->Fecha3Kyu).'</li>
     	<li><strong><span style="color: #008000;">3º Kyu</span></strong>: '.adp_FormatDate($alumno->Fecha3Kyu).' - '.adp_Alumno::TiempoEntreExamenes($alumno->Fecha3Kyu, $alumno->Fecha2Kyu).'</li>
     	<li><strong><span style="color: #0000ff;">2º Kyu</span></strong>: '.adp_FormatDate($alumno->Fecha2Kyu).' - '.adp_Alumno::TiempoEntreExamenes($alumno->Fecha2Kyu, $alumno->Fecha1Kyu).'</li>
     	<li><strong><span style="color: #800000;">1º Kyu</span></strong>: '.adp_FormatDate($alumno->Fecha1Kyu).' - '.adp_Alumno::TiempoEntreExamenes($alumno->Fecha1Kyu, $alumno->FechaShodan).'</li>
    </ul>
    <h5>Grados DAN</h5>
    <ul>
     	<li><strong><span style="color: #333333;">Shodan</span></strong>: '.adp_FormatDate($alumno->FechaShodan).' - '.adp_Alumno::TiempoEntreExamenes($alumno->FechaShodan, $alumno->FechaNidan).'</li>
     	<li><strong><span style="color: #333333;">Nidan</span></strong>: '.adp_FormatDate($alumno->FechaNidan).' - '.adp_Alumno::TiempoEntreExamenes($alumno->FechaNidan, $alumno->FechaSandan).'</li>
     	<li><span style="color: #333333;"><strong>Sandan</strong></span>: '.adp_FormatDate($alumno->FechaSandan).' - '.adp_Alumno::TiempoEntreExamenes($alumno->FechaSandan, $alumno->FechaYondan).'</li>
     	<li><span style="color: #333333;"><strong>Yondan</strong></span>: '.adp_FormatDate($alumno->FechaYondan).' - '.adp_Alumno::TiempoEntreExamenes($alumno->FechaYondan, null).'</li>
    </ul>
    ';
    return $out;
}


/***************************************************
 * ACTIONS
 * *************************************************/
function action_remove_personal_options(){
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