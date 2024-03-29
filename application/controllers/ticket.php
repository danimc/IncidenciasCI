<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {
	
	 function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_ticket',"",TRUE);
		$this->load->model('m_correos',"",TRUE);

		$ci = get_instance();	
		$this->ftp_ruta = $ci->config->item("f_ruta");
		$this->dir = $ci->config->item("oficios");

	}

	public function index()
	{
		$this->load->view('_encabezado');

	}

	/**
	 * Front end para levantar un nuevo ticket.
	 * @version 1.0
	 */
	function nuevo_ticket()
	{
		$codigo = $this->session->userdata("codigo");	
		$datos['usuario'] = $this->m_usuario->obt_usuario($codigo);
		$datos['reportantes'] = $this->m_ticket->obt_lista_usuarios();
		$datos['categorias'] = $this->m_ticket->obt_categorias();
		
		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('formularios/v_nuevo_ticket', $datos);
		$this->load->view('_footer1');
	}

	/**
	 *Registro de los datos del ticket.

	 */
	function levantar_incidente()
	{
		if ($_POST['usrIncidente'] == 0) {
			redirect(base_url().'ticket/nuevo_ticket/e');			
		}

		$reportante = $this->session->userdata("codigo");
		$usuarioIncidente = $_POST['usrIncidente'];
	    $notificacion = 1;
		$titulo = $_POST['incidente'];
		$descripcion = $_POST['descripcion'];
		$categoria = $_POST['categoria'];
		$prioridad = $_POST['prioridad'];
		$dependencia = $this->m_usuario->obt_dependencia_usuario($usuarioIncidente);
		$estatus = '1';	

		

		$ticket = array(			
			'fecha_inicio'		=> $this->m_ticket->fecha_actual(),
			'hora_inicio'		=> $this->m_ticket->hora_actual(),
			'usr_reportante' 	=> $reportante,
			'usr_incidente'		=> $usuarioIncidente,
			'dependencia'		=> $dependencia->dependencia,
			'categoria'			=> $categoria,
			'titulo'			=> $titulo,
			'descripcion'		=> $descripcion,
			'estatus'			=> $estatus,
			'prioridad'			=> $prioridad,			
			 );


		

		$this->m_ticket->nuevo_incidente($ticket);
		$idIncidente = $this->db->insert_id();
		$this->m_ticket->SendTelegram($ticket, $idIncidente);
		$this->subir_adjuntos($idIncidente);

		//$this->m_ticket->noti_alta($reportante, $usuarioIncidente, $idIncidente, $notificacion);
	//	redirect(base_url() . 'ticket/seguimiento/'.$idIncidente);
		redirect('ticket/correo_ticket_levantado/'. $idIncidente);
	}
		/**
		 * Funcion que sube los adjuntos al servidor.
		 */
		function subir_adjuntos($idIncidente){

		for($i=0;$i<count($_FILES["imagen"]["name"]);$i++)
        {
        	if($_FILES['imagen']['name'][$i] != ""){

			
				$x = $i+1;
				$origen=$_FILES["imagen"]["tmp_name"][$i];
				$ext = explode('.',$_FILES['imagen']['name'][$i]);
				$ext = $ext[count($ext) - 1];
				$ruta ='att_' . $idIncidente .'_' . $x .'.' . $ext; 				
				move_uploaded_file($origen , $this->ftp_ruta . 'src/att/'. $ruta );

				$attach = array('id_ticket' 	=> $idIncidente,
								'tipo'			=> 3,
								'ruta'			=> $ruta,
								'ext'			=> $ext
								 );

				$this->m_ticket->subir_pdf($attach);
			}
		}

	}


	function lista_tickets_cerrados()
	{
		$codigo = $this->session->userdata("codigo");
		$rol = $this->session->userdata("rol");
		$folio = $this->uri->segment(3);
		$datos['usuario'] = $this->m_usuario->obt_usuario($codigo);
		$datos['folio'] = $folio;
		$datos['titulo'] = "CERRADOS";

				$datos['tickets'] = $this->m_ticket->lista_tickets_administrador_cerrados();
				$this->load->view('_encabezado1');
				$this->load->view('_menuLateral1');
				$this->load->view('listas/l_tickets_admin', $datos);
				$this->load->view('_footer1');

				
	}

		function lista_tickets_abiertos()
	{
		$codigo = $this->session->userdata("codigo");
		$rol = $this->session->userdata("rol");
		$folio = $this->uri->segment(3);
		$datos['usuario'] = $this->m_usuario->obt_usuario($codigo);
		$datos['folio'] = $folio;
		$datos['titulo'] = "ATENDIENDO";

				$datos['tickets'] = $this->m_ticket->lista_tickets_administrador_abiertos();
				$this->load->view('_encabezado1');
				$this->load->view('_menuLateral1');
				$this->load->view('listas/l_tickets_admin', $datos);
				$this->load->view('_footer1');
				
	}

	function lista_tickets()
	{	
		
		$codigo = $this->session->userdata("codigo");
		$rol = $this->session->userdata("rol");
		$folio = $this->uri->segment(3);
		$datos['usuario'] = $this->m_usuario->obt_usuario($codigo);
		$datos['folio'] = $folio;
		$datos['titulo'] = "COMPLETA";

		switch ($rol) {
			case 1:
				
				$datos['tickets'] = $this->m_ticket->lista_tickets_administrador();
				$this->load->view('_encabezado1');
				$this->load->view('_menuLateral1');
				$this->load->view('listas/l_tickets_admin', $datos);
				$this->load->view('_footer1');

				break;
			case 2:
				$datos['tickets'] = $this->m_ticket->lista_tickets_usuario($codigo);
				$this->load->view('_encabezado1');
				$this->load->view('_menuLateral1');
				$this->load->view('listas/l_tickets_usuarios', $datos);
				$this->load->view('_footer1');
				break;
		}		
	}

	function seguimiento()
	{
		$folio = $this->uri->segment(3);
		$rol = $this->session->userdata("rol");
		$datos['folio'] = $folio;
		$datos['ticket'] = $this->m_ticket->seguimiento_ticket($folio);
		$datos['asignados'] = $this->m_ticket->obt_asignados();
		$datos['categorias'] = $this->m_ticket->obt_categorias();
		$datos['seguimiento'] = $this->m_ticket->obt_seguimiento($folio);
		$datos['attach'] = $this->m_ticket->obtAdjunto($folio);

		if ($rol == 1) {
			
				$this->load->view('_encabezado1');
				$this->load->view('_menuLateral1');
				$this->load->view('formularios/v_seguimiento_admin', $datos);
				$this->load->view('_footer1');
				}
		else{
				$this->load->view('_encabezado1');
				$this->load->view('_menuLateral1');
				$this->load->view('formularios/v_seguimiento_usuario', $datos);
				$this->load->view('_footer1');
				}
		


	}

	function asignar_usuario()
	{

		if ($_POST['antAsignado'] == $_POST['ingeniero']) {
			$msg = '<div class="alert alert-danger"><p><i class="fa fa-close"></i>El usuario seleccionado ya esta asignado e este ticket de servicio </p></div>';
		}else{

		if($_POST['antAsignado'] == '' or $_POST['antAsignado'] == '0'){
			$estatus = 2; 
		}else{
			$estatus = 7;
		}


		  $notificacion = 2;
		  $codigo = $this->session->userdata("codigo");	
		  $ingeniero = $_POST['ingeniero'];
		  $folio = $_POST['folio'];
		  $fecha= $this->m_ticket->fecha_actual();
		  $hora= $this->m_ticket->hora_actual();
		  $usr = $this->m_usuario->obt_usuario($codigo);
		  $tg = $this->m_usuario->obt_telegramID($ingeniero);//-------//
		  $this->m_ticket->asignar_usuario($folio, $ingeniero, $fecha, $hora, $estatus);
		  $this->m_ticket->h_asignar_usuario($folio, $ingeniero, $fecha, $hora, $estatus);
			
		if ($tg != null) {
		  	$response = $this->m_ticket->sendTelegram_asignado($tg, $folio); //-------//
		  }	
		
	    $msg = '<div class="alert alert-success"><p><i class="fa fa-check"></i>Se ha Asignado con Exito</p></div>';

 		  echo json_encode($msg);
		}
	}

	function cambiar_categoria()
	{
		$categoria = $_POST['categoria'];
		$folio = $_POST['folio'];
		$antCategoria = $_POST['antCategoria'];
		$fecha= $this->m_ticket->fecha_actual();
		$hora= $this->m_ticket->hora_actual();

		$msg = new \stdClass();

		if ($categoria != $antCategoria) {
			$this->m_ticket->cambiar_categoria($folio, $categoria);
			$this->m_ticket->h_cambiar_categoria($folio, $categoria, $fecha, $hora);

			 $msg->id = 1;
			 $msg->mensaje = '<div class="alert alert-success"><p><i class="fa fa-check"></i> Se cambio la categoría</p></div>';
		}else{

			$msg->id = 2;
			$msg->mensaje = '<div class="alert alert-danger"><p><i class="fa fa-close"></i> Seleccionaste la categoría actual</p></div>';
			
		}

		echo json_encode($msg);
	}

	function cambiar_estatus()
	{
		$estatus = $_POST['estado'];
		$folio = $_POST['folio'];
		$antStatus = $_POST['antStatus'];
		$fecha= $this->m_ticket->fecha_actual();
		$hora= $this->m_ticket->hora_actual();

		$msg = new \stdClass();

		if ($estatus != $antStatus) {
			$this->m_ticket->cambiar_estatus($folio, $estatus);
			$this->m_ticket->h_cambiar_estatus($folio, $estatus, $fecha, $hora);

			 $msg->id = 1;
			 $msg->mensaje = '<div class="alert alert-success"><p><i class="fa fa-check"></i> Se cambio es estatus</p></div>';
		}else{

			$msg->id = 2;
			$msg->mensaje = '<div class="alert alert-danger"><p><i class="fa fa-close"></i> Ha seleccionado el mismo estado del Ticket</p></div>';
			
		}

		echo json_encode($msg);

	}

	function cerrar_ticket()
	{
		$folio = $_POST['folio'];
		$usr = $this->session->userdata("codigo");
		$fecha = $this->m_ticket->fecha_actual();
		$hora = $this->m_ticket->hora_actual();			

			$this->m_ticket->cerrar_ticket($folio, $fecha, $hora);
			$this->m_ticket->h_cerrar_ticket($folio, $usr, $fecha, $hora);			
			$this->m_correos->correo_ticket_cerrado($folio, $fecha, $hora);	

		$msg = new \stdClass();
		$msg->id = 1;
		$msg->mensaje = '<div class="alert alert-success"><p><i class="fa fa-check"></i>Ticket Cerrado Satisfactoriamente :)</p></div>';
 		echo json_encode($msg);

	    

		
	}

	function mensaje()
	{
		$folio = $_POST['folio'];
		$mensaje = $_POST['chat'];
		$fecha= $this->m_ticket->fecha_actual();
		$hora= $this->m_ticket->hora_actual();
		$x = $this->m_ticket->obt_imagenesChat($folio);

		if($_FILES['imgComentario']['name'] != ""){			
			$ext = explode('.',$_FILES['imgComentario']['name']);
			$ext = $ext[count($ext) - 1];
			$x = $x+1;
			$pdf = 'c' . $folio . '_'. $x;			
			move_uploaded_file($_FILES['imgComentario']['tmp_name'], $this->ftp_ruta . 'src/att/' . $pdf .'.' . $ext);
			$nImg = $pdf .'.' . $ext;
			$this->resize($nImg);

		}else {
			$nImg = null;
		} 

		//die(var_dump($this->ftp_ruta . 'src/att/' . $pdf .'.' . $ext));

		$this->m_ticket->mensaje($folio, $mensaje, $fecha, $hora, $nImg);
		//$this->m_ticket->sendTelegram_chat($folio, $mensaje);

		redirect(base_url() . 'ticket/seguimiento/'.$folio);
	}

	function resize($nImg)
	{
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'src/oficios/att/'. $nImg;
		$config['new_image'] = 'src/oficios/att/'. $nImg;
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;

		$this->image_lib->initialize($config);

if (!$this->image_lib->resize()) {
	echo $this->image_lib->display_errors('', '');
}
	}

	public function correo()
	{
	 
	  $receiver_email = 'daniel_k310a@hotmail.com';
	  $username = 'daniel';
	  $subject = 'prueba';
	  $message = 'aiuuuuda';

	
	  $this->load->library('email');
	  $this->email->set_newline("rn");

	  $this->email->from($recie, $username);
	   // Receiver email address 
	  $this->email->to($receiver_email); 
	  // Subject of email 
	  $this->email->subject($subject); 
	  // Message in email 
	  $this->email->message($message); 
	  $this->email->send();
	  $this->email->print_debugger();

	   
	}


	function correo_ticket_levantado()
	{
		$incidente = $this->uri->segment(3);
		$infoCorreo = $this->m_ticket->seguimiento_ticket($incidente);
		$horario = $this->m_ticket->hora_actual();
		$saludo = '';

		if($horario <= '11:59:59'){
			$saludo = 'Buenos días';
		}
		elseif ($horario <= '19:59:59') {
			$saludo = 'Buenas tardes';
		}
		elseif ($horario <= '23:59:59') {
			$saludo = 'Buenas noches';
		}
		
		$datos['ticket'] = $infoCorreo;
		$datos['saludo'] = $saludo;		
	  //  $this->load->view('_head');
		$msg = $this->load->view('correos/c_nuevoTicket', $datos, true);

		$this->load->library('email');
		$this->email->from('incidenciasoag@gmail.com', 'HelpDesk OAG');
		$this->email->to($infoCorreo->correo);
		$this->email->bcc('luis.mora@redudg.udg.mx');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject('Registro de Incidente | incidenciasOAG');
		$this->email->message($msg);
		$this->email->set_mailtype('html');
		$this->email->send();

		redirect(base_url() . 'ticket/seguimiento/'.$incidente);
		

	//	echo $this->email->print_debugger();

	}

	function correo_prueba()
	{

		$this->load->library('email');
		$this->email->from('incidenciasoag@gmail.com', 'FE');
		$this->email->to('daniel_k310a@hotmail.com');
		$this->email->cc('incidenciasoag@gmail.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject('Registro de Incidente | incidenciasOAG');
		$this->email->message("prueba");
		$this->email->set_mailtype('html');
		$this->email->send();

		//redirect('ticket/seguimiento/'. $incidente);

		echo $this->email->print_debugger();
	}


	function sendTelegram1()
	{
		$this->m_ticket->sendTelegram1();
	}

	
} 