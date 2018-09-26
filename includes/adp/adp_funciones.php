<?php



class adp_Alumno
{
    private $wpUser;
    
    public $ID;
    public $Nombre;
    public $Apellido;
    public $Direccion;
    public $Ciudad;
    public $Comunidad;
    public $CP;
    public $Email;
    public $Movil;
    public $FechaNacimiento;
    public $DNI;
    
    public $FechaIngresoDojo;
    public $Fecha5Kyu;
    public $Fecha4Kyu;
    public $Fecha3Kyu;
    public $Fecha2Kyu;
    public $Fecha1Kyu;
    public $FechaShodan;
    public $FechaNidan;
    public $FechaSandan;
    public $FechaYondan;
    
    public function NombreCompleto()
    {
         return $this->Nombre.' '.$this->Apellido;
    }

/*
    public function ID( $value = "" )
    
    {
    
        if( empty( $value ) )
    
            return $this->ID;
    
        else
    
            $this->ID = $value;
    
    }
*/   

    private function FechaAlumno($date)
    {
        
        $d_date = date_create($date);
        if ($d_date->format('Ymd') != date('Ymd'))
            return $d_date;
        else
            return null;
    }
    
    // ********** CONSTRUCTORES **********
    function __construct()
    {
        //obtengo un array con los parámetros enviados a la función
		$params = func_get_args();
		//saco el número de parámetros que estoy recibiendo
		$num_params = func_num_args();
		//cada constructor de un número dado de parámtros tendrá un nombre de función
		//atendiendo al siguiente modelo __construct1() __construct2()...
		$funcion_constructor ='__construct'.$num_params;
		//compruebo si hay un constructor con ese número de parámetros
		if (method_exists($this,$funcion_constructor)) {
			//si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
			call_user_func_array(array($this,$funcion_constructor),$params);
		}
    }

    private function __construct0() 
    {
        $wpUser = wp_get_current_user();
        $this->__construct1($wpUser->id);
    }
    
    private function __construct1($idAlumno) 
    {
        if ($idAlumno == null)
            $wpUser = wp_get_current_user();
        else
            $wpUser = new WP_User($idAlumno);
        
        $this->ID = $wpUser->ID;
        $this->Nombre = $wpUser->first_name;
        $this->Apellido = $wpUser->last_name;
        $this->Direccion = $wpUser->addr1;
        $this->Ciudad = $wpUser->city;
        $this->Comunidad = $wpUser->thestate;
        $this->CP = $wpUser->zip;
        $this->Email = $wpUser->user_email;
        $this->Movil = $wpUser->phone1;
        $this->DNI = $wpUser->DNI;
        
        $this->LicenciaAikikan = (!($wpUser->licencia_aikikan)) ? null : wp_get_attachment_url($wpUser->licencia_aikikan);
        
        $this->FechaNacimiento = $this->FechaAlumno($wpUser->birthdate);
        $this->FechaIngresoDojo = $this->FechaAlumno($wpUser->fecha_ingreso_dojo);
        $this->Fecha5Kyu = $this->FechaAlumno($wpUser->fecha_5kyu);
        $this->Fecha4Kyu = $this->FechaAlumno($wpUser->fecha_4kyu);
        $this->Fecha3Kyu = $this->FechaAlumno($wpUser->fecha_3kyu);
        $this->Fecha2Kyu = $this->FechaAlumno($wpUser->fecha_2kyu);
        $this->Fecha1Kyu = $this->FechaAlumno($wpUser->fecha_1kyu);
        $this->FechaShodan = $this->FechaAlumno($wpUser->fecha_shodan);
        $this->FechaNidan = $this->FechaAlumno($wpUser->fecha_nidan);
        $this->FechaSandan = $this->FechaAlumno($wpUser->fecha_sandan);
        $this->FechaYondan = $this->FechaAlumno($wpUser->fecha_yondan);
        
    }
        
    
    // ********** CONSTRUCTORES **********
    
    //private function ObtenerFecha
    
    public static function UsuarioWP ($idAlumno)
    {
        return get_userdata($idAlumno);
    }
    
    public static function Desactivar($idAlumno)
    {
        $user = get_userdata($idAlumno);
	    $user->set_role( 'pendiente_activar' );
    }
    
    public static function Activar($idAlumno)
    {
        $user = get_userdata($idAlumno);
	    $user->set_role( 'alumno' );
    }
    
    public static function CrearBlog($idAlumno)
    {
        $user = get_userdata($idAlumno);
        $alumno = new adp_Alumno($user->ID);
        adp_crear_blog_de_alumno($alumno);
    }
    
    public static function ListaAlumnos()
    {
        return get_users( 'role=alumno&orderby=first_name' );
    }
    
    public static function ListaPendientesActivar()
    {
        return get_users( 'role=pendiente_activar&orderby=first_name' );
    }
    
    /*public function ConDatosPersonales()
    {
        return (
            $this->Nombre!=null &&
            $this->Apellido!=null &&
            $this->Direccion!=null && 
            $this->Ciudad!=null && 
            $this->Comunidad!=null && 
            $this->CP!=null && 
            $this->Movil!=null &&
            $this->FechaNacimiento!=null
            );
    }
    public function ConLicencia()
    {
        return ($this->LicenciaAikikan != null);
    }
    public function ConFechaInicio()
    {
        return ($this->FechaIngresoDojo != null);
    }*/
}


function TiempoEntreFechas($examen1, $examen2)
{
    $out = '';
    
    if ($examen1 != null && $examen1!='' && !empty($examen1) && isset($examen1))
    {
        if ($examen2 == null || $examen2=='' || empty($examen2) || !isset($examen2))
            $examen2 = date_create();
    
        $date_diff = date_diff($examen1, $examen2);
    
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
    }
    return $out;
}

function adp_FormatDate($date)
{
    $out = '';
    if ($date != null)
    {
        if ($date->format('Ymd') != date('Ymd'))
        {
            $dias = array("Dom","Lun","Mar","Mie","Jue","Vie","Sab");
            $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
    
            $out = $dias[$date->format('w')] . ' ' . $date->format('j') . "-" . $meses[$date->format('n')-1] . "-" . $date->format('Y') ;
        }
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



function adp_lista($usuarios, $message)
{
    if( $usuarios )
    {
        $out.='<ul style="list-style-type: none">';
    	foreach ( $usuarios as $usuario )
    	{	
    	    $alumno = new adp_Alumno($usuario->id); 
    	    
    		$out.= '<li><a href="/admin-dojo/?accion=ficha_alumno&id_alumno=' . $alumno->ID . '">'
    		. esc_html( $alumno->NombreCompleto() )
    		. '</a> (<a href="/admin-dojo/?accion=activar_alumno&id_alumno=' . $alumno->ID . '">Activar</a> ' 
    		. '- <a href="/admin-dojo/?accion=desactivar_alumno&id_alumno=' . $alumno->ID . '">Desactivar</a> '
    		. '- <a href="/wp-admin/user-edit.php?user_id=' . $alumno->ID . '&wp_http_referer=%2Fadmin%2">Editar</a>)';
    		
    		if ($alumno->LicenciaAikikan==null) 
    		    $out.= '&nbsp;<img src="http://aikidojopozuelo.com/wp-content/uploads/2018/07/red_icon.png" style="width:20px; height:20px" title="SIN LICENCIA" alt="SIN LICENCIA">';
    		
    	}
    	$out.='</ul>';
    } 
    else
    	$out.= 'No hay "' . $message . '"';
    
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

function adp_crear_blog_de_alumno($alumno)
{
    //echo 'dentro';
    
    $leadTitle = 'Aiki-Blog Personal de ' . $alumno->NombreCompleto() . ' (' . $alumno->DNI . ')';

    if (get_page_by_title($leadTitle, OBJECT, 'post') != null)
        return;

	/*******************************************************
	** POST VARIABLES
	*******************************************************/

	$postType = 'post'; // set to post or page
	$userID = $alumno->ID; // set to user id
	$categoryID = '24'; // set to category id.
	$postStatus = 'publish';  // set to future, draft, or publish

	$leadContent = '<p>Hola ' . $alumno->Nombre . '!</p><p>En este blog intercambiaremos la información sobre tu evolución.</p><p>Puedes escribirme o preguntarme lo que quieras. Yo lo utilizaré para dejarte notas, comentarios o cualquier cosa que pueda ayudarte de cara a tu evolución. Nadie más que tú y yo veremos este blog.</p>';

	/*******************************************************
	** TIME VARIABLES / CALCULATIONS
	*******************************************************/
	// VARIABLES
	$timeStamp = $minuteCounter = 0;  // set all timers to 0;
	$iCounter = 1; // number use to multiply by minute increment;
	$minuteIncrement = 1; // increment which to increase each post time for future schedule
	$adjustClockMinutes = 0; // add 1 hour or 60 minutes - daylight savings

	// CALCULATIONS
	$minuteCounter = $iCounter * $minuteIncrement; // setting how far out in time to post if future.
	$minuteCounter = $minuteCounter + $adjustClockMinutes; // adjusting for server timezone

	$timeStamp = date('Y-m-d H:i:s');//, strtotime("+$minuteCounter min")); // format needed for WordPress

	/*******************************************************
	** WordPress Array and Variables for posting
	*******************************************************/

	$new_post = array(
		'post_title' => $leadTitle,
		'post_content' => $leadContent,
		'post_status' => $postStatus,
		'post_date' => $timeStamp,
		'post_author' => $userID,
		'post_type' => $postType,
		'post_category' => array($categoryID)
		);

	/*******************************************************
	** WordPress Post Function
	*******************************************************/

	$post_id = wp_insert_post($new_post);

	/*******************************************************
	** SIMPLE ERROR CHECKING
	*******************************************************/
/*
	$finaltext = '';

	if($post_id){
	
		$finaltext .= 'Yay, I made a new post.<br>';

	} else{

		$finaltext .= 'Something went wrong and I didn\'t insert a new post.<br>';

	}

	echo $finaltext;
*/
}

function code_adp_ficha_alumno($idAlumno)
{
    $iAdmin = false;
    ($idAlumno == '')? $idAlumno = null : $isAdmin=true;
        
    $alumno = new adp_Alumno($idAlumno);

    $out = '
    <h5>'.get_avatar($alumno->Email).'</h5>
    <h5>Datos Personales</h5>
    <ul style="list-style-type: none">
     	<li><strong>Nombre</strong>: '.$alumno->NombreCompleto().'</li>
     	<li><strong>Dirección</strong>: '.$alumno->Direccion.', '.$alumno->CP.' - '.$alumno->Ciudad.' ('.$alumno->Comunidad.')</li>
     	<li><strong>Teléfono</strong>: '.$alumno->Movil.'</li>
     	<li><strong>Email</strong>: '.$alumno->Email.'</li>
     	<li><strong>Fecha de Nacimiento</strong>: '.adp_FormatDate($alumno->FechaNacimiento).' - '.TiempoEntreFechas($alumno->FechaNacimiento, null).'</li>
     	<li><strong>DNI</strong>: '.$alumno->DNI.'</li>
     	<li><em><a href="'.
     	(($isAdmin==true) ?
     	    'http://aikidojopozuelo.com/wp-admin/user-edit.php?user_id='.$alumno->ID.'&wp_http_referer='.urlencode("/admin-dojo/?accion=ficha_alumno&id_alumno=".$alumno->ID)
     	    :'/area-alumnos/editar-alumno/')
     	.'">>>Editar</a></em></li>
    </ul>
    <h5>Licencia</h5>
    <ul style="list-style-type: none">';
     
    $out.= ($alumno->LicenciaAikikan==null) ? ('<li class="blink" style="text-decoration: blink;color:red">SIN LICENCIA</li>') : ('<li><a href="'.$alumno->LicenciaAikikan.'" target="_blank">Ver Licencia</a></li>');
     	
    $out.=
    '</ul>
    <h5>Práctica</h5>
    <ul style="list-style-type: none">
     	<li><strong>Inicio</strong>: '.adp_FormatDate($alumno->FechaIngresoDojo).' - '.TiempoEntreFechas($alumno->FechaIngresoDojo, null).'</li>
    </ul>
    <h5>Grados Kyu</h5>
    <ul style="list-style-type: none">
     	<li><strong><span style="color: #ffcc00;">5º Kyu</span></strong>: '.adp_FormatDate($alumno->Fecha5Kyu).' - '.TiempoEntreFechas($alumno->Fecha5Kyu, $alumno->Fecha4Kyu).'</li>
     	<li><strong><span style="color: #ff6600;">4º Kyu</span></strong>: '.adp_FormatDate($alumno->Fecha4Kyu).' - '.TiempoEntreFechas($alumno->Fecha4Kyu, $alumno->Fecha3Kyu).'</li>
     	<li><strong><span style="color: #008000;">3º Kyu</span></strong>: '.adp_FormatDate($alumno->Fecha3Kyu).' - '.TiempoEntreFechas($alumno->Fecha3Kyu, $alumno->Fecha2Kyu).'</li>
     	<li><strong><span style="color: #0000ff;">2º Kyu</span></strong>: '.adp_FormatDate($alumno->Fecha2Kyu).' - '.TiempoEntreFechas($alumno->Fecha2Kyu, $alumno->Fecha1Kyu).'</li>
     	<li><strong><span style="color: #800000;">1º Kyu</span></strong>: '.adp_FormatDate($alumno->Fecha1Kyu).' - '.TiempoEntreFechas($alumno->Fecha1Kyu, $alumno->FechaShodan).'</li>
    </ul>
    <h5>Grados DAN</h5>
    <ul style="list-style-type: none">
     	<li><strong><span style="color: #333333;">Shodan</span></strong>: '.adp_FormatDate($alumno->FechaShodan).' - '.TiempoEntreFechas($alumno->FechaShodan, $alumno->FechaNidan).'</li>
     	<li><strong><span style="color: #333333;">Nidan</span></strong>: '.adp_FormatDate($alumno->FechaNidan).' - '.TiempoEntreFechas($alumno->FechaNidan, $alumno->FechaSandan).'</li>
     	<li><span style="color: #333333;"><strong>Sandan</strong></span>: '.adp_FormatDate($alumno->FechaSandan).' - '.TiempoEntreFechas($alumno->FechaSandan, $alumno->FechaYondan).'</li>
     	<li><span style="color: #333333;"><strong>Yondan</strong></span>: '.adp_FormatDate($alumno->FechaYondan).' - '.TiempoEntreFechas($alumno->FechaYondan, null).'</li>
    </ul>
    ';
    return $out;
}

function adp_ListaAlumnos()
{
    return '<h5>Lista de Alumnos</h5>'
        . adp_lista (adp_Alumno::ListaAlumnos(), 'Alumnos Activos') . '<br/>'
        . '<h5>Pendiente de Activar</h5>'
        . adp_lista (adp_Alumno::ListaPendientesActivar(), 'Alumnos Pendientes de Activar');
}

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
            $out = adp_ListaAlumnos();
            break;
            
        case 'desactivar_alumno':
            if ($id_alumno != '')
            {   
                adp_Alumno::Desactivar($id_alumno);
            }
            $out = adp_ListaAlumnos();
            break;
            
        case 'activar_alumno':
            if ($id_alumno != '')
            {
                adp_Alumno::Activar($id_alumno);
                adp_Alumno::CrearBlog($id_alumno);
            }
            $out = adp_ListaAlumnos();
            break;
            
        case 'ficha_alumno':
            if ($id_alumno != '')
            {
                $out = code_adp_ficha_alumno($id_alumno);
            }
            break;
            
        default:
            break;
    }
    
    return $out;
}

function code_adp_asistencia_mensual()
{
    if (isset($_GET['month']))
        $month = $_GET['month'];
    else
        $month = date("Y") . '-' . date("m");
    
    return do_shortcode('[dbview name=\'dbview_asistencia_count_año_mes\' arg1=\''
        . $month
        . '\']');
        
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