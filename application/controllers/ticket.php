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

	}

	public function index()
	{
		$this->load->view('_encabezado');

	}

	function nuevo_ticket()
	{
		 $codigo = $this->session->userdata("codigo");	
		$datos['usuario'] = $this->m_usuario->obt_usuario($codigo);
		$datos['reportante'] = $this->m_ticket->obt_lista_usuarios();
		$datos['categorias'] = $this->m_ticket->obt_categorias();

		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('formularios/v_nuevo_ticket', $datos);
		$this->load->view('_footer1');
	}

		function levantar_incidente()
	{
		$reportante = $_POST['codigo'];
		$usuarioIncidente = $_POST['usrIncidente'];
	    $notificacion = 1;
		$titulo = $_POST['incidente'];
		$descripcion = $_POST['descripcion'];
		$categoria = $_POST['categoria'];
		$prioridad = $_POST['prioridad'];
		$estatus = '1';	

		$this->m_ticket->nuevo_incidente($reportante, $usuarioIncidente, $titulo, $descripcion, $categoria, $estatus, $prioridad);
		$idIncidente = $this->db->insert_id();

		//$this->m_ticket->noti_alta($reportante, $usuarioIncidente, $idIncidente, $notificacion);

		redirect('ticket/correo_ticket_levantado/'. $idIncidente);
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

		if ($rol == 1) {
			
				$this->load->view('_encabezado');
				$this->load->view('_menuLateral');
				$this->load->view('formularios/v_seguimiento_admin', $datos);
				$this->load->view('_footer');
				}
		else{
				$this->load->view('_encabezado');
				$this->load->view('_menuLateral');
				$this->load->view('formularios/v_seguimiento_usuario', $datos);
				$this->load->view('_footer');
				}
		


	}

	function asignar_usuario()
	{

		if($_POST['antAsignado'] == ''){
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

		  $this->m_ticket->asignar_usuario($folio, $ingeniero, $fecha, $hora, $estatus);
		  $this->m_ticket->h_asignar_usuario($folio, $ingeniero, $fecha, $hora, $estatus);
		

	    $msg = '<div class="alert alert-success"><p><i class="fa fa-check"></i>Se ha Asignado con Exito</p></div>';

 		  echo json_encode($msg);
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

		$this->m_ticket->mensaje($folio, $mensaje, $fecha, $hora);

		redirect('ticket/seguimiento/'. $folio .'/#chat');
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
		$this->email->from('incidenciasoag@gmail.com', 'incidenciasOAG');
		$this->email->to($infoCorreo->correo);
		$this->email->cc('incidenciasoag@gmail.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject('Registro de Incidente | incidenciasOAG');
		$this->email->message($msg);
		$this->email->set_mailtype('html');
		$this->email->send();

		redirect('ticket/seguimiento/'. $incidente);

	//	echo $this->email->print_debugger();

	}

	
}