<?php

  include (ABSPATH.'wp-includes/class-wp-user.php');
  
class adp_Alumno
{
    private $wpUser;
    
    public $Nombre;
    public $Apellido;
    public $Direccion;
    public $Ciudad;
    public $Comunidad;
    public $CP;
    public $Email;
    public $Movil;
    public $FechaNacimiento;
    
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
        $wpUser = new WP_User($id_alumno );
        
        $this->Nombre = $wpUser->first_name;
        
        $this->Apellido = $wpUser->last_name;
        $this->Direccion = $wpUser->addr1;
        $this->Ciudad = $wpUser->city;
        $this->Comunidad = $wpUser->thestate;
        $this->CP = $wpUser->zip;
        $this->Email = $wpUser->user_email;
        $this->Movil = $wpUser->phone1;
        $this->LicenciaAikikan = $wpUser->licencia_aikikan;
        
        $this->FechaNacimiento = $this->FechaAlumno($wpUser->birthdate);
        $this->FechaIngresoDojo = $this->FechaAlumno($wpUser->fecha_ingreso_dojo);
        $this->Fecha5Kyu = $this->FechaAlumno($wpUser->fecha_5kyu);
        $this->Fecha5Kyu = $this->FechaAlumno($wpUser->fecha_4kyu);
        $this->Fecha5Kyu = $this->FechaAlumno($wpUser->fecha_3kyu);
        $this->Fecha5Kyu = $this->FechaAlumno($wpUser->fecha_2kyu);
        $this->Fecha5Kyu = $this->FechaAlumno($wpUser->fecha_1kyu);
        $this->FechaShodan = $this->FechaAlumno($wpUser->fecha_shodan);
        $this->FechaNidan = $this->FechaAlumno($wpUser->fecha_nidan);
        $this->FechaSandan = $this->FechaAlumno($wpUser->fecha_sandan);
        $this->FechaYondan = $this->FechaAlumno($wpUser->fecha_yondan);
    }
        
    
    // ********** CONSTRUCTORES **********
    
    //private function ObtenerFecha
    
    public static function Desactivar($idAlumno)
    {
        $user = new \WP_User( $id_alumno );
	    $user->set_role( 'pendiente_activar' );
    }
    
    public static function Activar($idAlumno)
    {
        $user = new \WP_User( $id_alumno );
	    $user->set_role( 'alumno' );
    }
    
    public static function ListaAlumnos()
    {
        return get_users( 'role=alumno&orderby=first_name' );
    }
    
    public static function ListaPendientesActivar()
    {
        return get_users( 'role=pendiente_activar&orderby=first_name' );
    }
    
    public static function TiempoEntreExamenes($examen1, $examen2)
    {
        $out = '';
        
        if ($examen1 != null)
        {
            if ($examen2 == null)
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
    
}