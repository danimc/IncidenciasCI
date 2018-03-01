<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {
	
	 function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_ticket',"",TRUE);

	}

	public function index()
	{
		$this->load->view('_encabezado');

	}

	function nuevo_ticket()
	{
		$datos['usuario'] = $this->m_usuario->obt_usuario();
		$datos['reportante'] = $this->m_ticket->obt_lista_usuarios();
		$datos['categorias'] = $this->m_ticket->obt_categorias();

		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('formularios/v_nuevo_ticket', $datos);
		$this->load->view('_footer');
	}

	function levantar_incidente()
	{
		$reportante = $_POST['codigo'];
		$usuarioIncidente = $_POST['usrIncidente'];
	
		$titulo = $_POST['incidente'];
		$descripcion = $_POST['descripcion'];
		$categoria = $_POST['categoria'];
		$estatus = '1';
	

		$this->m_ticket->nuevo_incidente($reportante, $usuarioIncidente, $titulo, $descripcion, $categoria, $estatus);

		$idIncidente = $this->db->insert_id();

		$this->correo_ticket_levantado($idIncidente,  $usuarioIncidente, $titulo, $descripcion, $categoria, $reportante);

		redirect('ticket/lista_tickets/'. $this->db->insert_id());

		//echo $this->db->insert_id() ;
	}

	function lista_tickets()
	{
		$folio = $this->uri->segment(3);
		
		$datos['usuario'] = $this->m_usuario->obt_usuario();
		$datos['folio'] = $folio;
		$datos['tickets'] = $this->m_ticket->tabla_admon();
		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('l_tickets', $datos);
		$this->load->view('_footer');
	}

	function seguimiento()
	{
		$folio = $this->uri->segment(3);
		$datos['folio'] = $folio;
		$datos['ticket'] = $this->m_ticket->seguimiento_ticket($folio);
		$datos['asignados'] = $this->m_ticket->obt_asignados();
		$datos['categorias'] = $this->m_ticket->obt_categorias();

		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('formularios/v_seguimiento', $datos);
		$this->load->view('_footer');


	}

	function asignar_usuario()
	{

		if($_POST['antAsignado'] == ''){
			$estatus = 2; 
		}else{
			$estatus = 7;
		}

		  $ingeniero = $_POST['ingeniero'];
		  $folio = $_POST['folio'];
		  $fecha= date('Y-m-d');
		  $hora= date('H:i:s');
		  $usr = $this->m_usuario->obt_usuario();

		  $this->m_ticket->asignar_usuario($folio, $ingeniero, $fecha, $hora, $estatus);

	    $msg = '<div class="alert alert-success"><p><i class="fa fa-check"></i>Se ha Asignado con Exito</p></div>';

 		  echo json_encode($msg);
	}

	function cambiar_categoria()
	{
		$categoria = $_POST['categoria'];
		$folio = $_POST['folio'];
		$antCategoria = $_POST['antCategoria'];

		$msg = new \stdClass();

		if ($categoria != $antCategoria) {
			$this->m_ticket->cambiar_categoria($folio, $categoria);

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

		$msg = new \stdClass();

		if ($estatus != $antStatus) {
			$this->m_ticket->cambiar_estatus($folio, $estatus);

			 $msg->id = 1;
			 $msg->mensaje = '<div class="alert alert-success"><p><i class="fa fa-check"></i> Se cambio es estatus</p></div>';
		}else{

			$msg->id = 2;
			$msg->mensaje = '<div class="alert alert-danger"><p><i class="fa fa-close"></i> Ha seleccionado el mismo estado del Ticket</p></div>';
			
		}

		echo json_encode($msg);

	}

	function correo_ticket_levantado($idIncidente, $usuarioIncidente, $titulo, $descripcion, $categoria, $reportante)
	{

		$usuario = $this->m_usuario->obt_usuario_ticket($usuarioIncidente);
		$horario = $this->m_ticket->hora_actual();
		$fechaReporte = $this->m_ticket->fechahora_actual();
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
		$datos['fechaReporte'] = $fechaReporte;
		$datos['idIncidente'] = $idIncidente;
		$datos['saludo'] = $saludo;
		$datos['usuario'] = $usuario;
		$datos['descripcion'] = $descripcion;
	    $this->load->view('_head');
		$msg = $this->load->view('correo', $datos, true);

		$this->load->library('email');
		$this->email->from('incidenciasoag@gmail.com', 'incidenciasOAG');
		$this->email->to($usuario->correo);
		$this->email->cc('incidenciasoag@gmail.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject('Registro de Incidente | incidenciasOAG');
		$this->email->message($msg);
		$this->email->set_mailtype('html');
		$this->email->send();

	//	echo $this->email->print_debugger();

	}
}