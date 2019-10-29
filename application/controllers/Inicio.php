<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_inicio',"",TRUE);
		$this->load->model('m_ticket',"",TRUE);
	}

	public function index()
	{
		$fecha = $this->m_ticket->fecha_actual();
		$comprobador =	$this->m_inicio->obt_diaHoy($fecha);

		if($comprobador == 0) {
			$this->m_ticket->SendTelegram1();
		}

		$codigo = $this->session->userdata("codigo");
		$usuario = $this->m_usuario->obt_usuario($codigo);	
		$datos['usuario'] = $usuario;
		$datos['total'] = $this->m_inicio->obt_contador_total();
		$datos['cerrados'] = $this->m_inicio->obt_contador_cerrados();
		$datos['abiertos'] = $this->m_inicio->obt_contador_abiertos();
		$datos['noasig'] = $this->m_inicio->obt_contador_noAsignados();  
		$datos['tGeneral'] = $this->m_inicio->tickets_pendientes_general();

		if ( $usuario->id_rol == 1) {
			$datos['tPendientes'] = $this->m_inicio->tickets_pendientes_sis($codigo);
		}
		else {
			$datos['tPendientes'] = $this->m_inicio->tickets_pendientes_usr($codigo);
		}	

		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('v_inicio', $datos);
		$this->load->view('_footer1');


	
	}

	function descargar_formatos()
	{
		$codigo = $this->session->userdata("codigo");	
		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('v_descargaFormatos');
		$this->load->view('_footer');	
	}

	function ftp()
	{
		$this->load->helper('file');
		$file = read_file('//148.202.169.71/Convenios/2005-2135.pdf');
		force_download($file);
		var_dump($file);
	}


	public function noaccess()
	{
		$this->load->view('_head');
		$this->load->view('errors/_noaccess');
	}

	public function correo2()
	{
		//Nuestro usuario
        $config["smtp_user"] = 'incidenciasoag@gmail.com';
         
       //Nuestra contraseña
        $config["smtp_pass"] = 'abogral90';   
		 $from = 'incidenciasoag@gmail.com'; $to = 'incidenciasoag@gmail.com'; $subject = 'your subject'; $message = 'your message'; $this->load->library('email');  $config['smtp_port']='465'; $config['smtp_timeout']='30'; $config['charset']='utf-8'; $config['protocol'] = 'smtp'; $ $config['wordwrap'] = TRUE; $this->email->initialize($config); $this->email->from($from); $this->email->to($to); $this->email->subject($subject); $this->email->message($message); // Sending Email $this->email->send();

		 if($this->email->send()){
           $respuesta = 'Email enviado correctamente';
        }else{
           $respuesta =  'No se a enviado el email';
        }

        echo "respuesta:". $respuesta ."<br>";

        echo $this->email->print_debugger();
	}
		
	public function info()
	{
		$info = file_get_contents('https://148.202.169.15/hp/device/MessageCenter/Summary?_=1569607557085');
		echo $info;

		$this->load->view('_footer1');

	}
	

	public function correo()
	{

		//
       
       //Cargamos la librería email
       $this->load->library('email');
        
       /*
        * Configuramos los parámetros para enviar el email,
        * las siguientes configuraciones es recomendable
        * hacerlas en el fichero email.php dentro del directorio config,
        * en este caso para hacer un ejemplo rápido lo hacemos
        * en el propio controlador
        */
        
       //Indicamos el protocolo a utilizar
        $config['protocol'] = 'smtp';
         
       //El servidor de correo que utilizaremos
        $config["smtp_host"] = 'smtp.gmail.com';
         
       //Nuestro usuario
        $config["smtp_user"] = 'incidenciasoag@gmail.com';
         
       //Nuestra contraseña
        $config["smtp_pass"] = 'abogral90';   
         
       //El puerto que utilizará el servidor smtp
        $config["smtp_port"] = '465';
        
       //El juego de caracteres a utilizar
        $config['charset'] = 'utf-8';
 
       //Permitimos que se puedan cortar palabras
        $config['wordwrap'] = TRUE;
         
       //El email debe ser valido 
       $config['validate'] = true;

       $config['mailtype'] = 'html';

       $config['smtp_timeout']='30';

       $config['mailpath'] = '/usr/sbin/sendmail'; 

       $config['charset'] = 'iso-8859-1';


       
        
      //Establecemos esta configuración
        $this->email->initialize($config);
 
      //Ponemos la dirección de correo que enviará el email y un nombre
        $this->email->from('incidenciasoag@gmail.com', 'Daniel Mora');

        $this->email->set_newline("\r\n");  
         
      /*
       * Ponemos el o los destinatarios para los que va el email
       * en este caso al ser un formulario de contacto te lo enviarás a ti
       * mismo
       */
        $this->email->to('daniel_k310a@hotmail.com');
         
      //Definimos el asunto del mensaje
        $this->email->subject("hola");
         
      //Definimos el mensaje a enviar
        $this->email->message("hola como estan todos ");
    
      
        //Enviamos el email y si se produce bien o mal que avise con una flasdata
        if($this->email->send()){
           $respuesta = 'Email enviado correctamente';
        }else{
           $respuesta =  'No se a enviado el email';
        }

        echo "respuesta:". $respuesta ."<br>";

        echo $this->email->print_debugger();

         
       // redirect(base_url("contacto"));
   }   


}
