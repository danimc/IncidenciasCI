<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expedientes extends CI_Controller {
	
	 function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_ticket',"",TRUE);
		$this->load->model('m_expedientes', "", TRUE);
	}

	public function index()
	{
		
	}

	function archivo_muerto_usr()
	{
		$dependencia = $this->session->userdata("dependencia");
		$datos['expedientes'] = $this->m_expedientes->obt_expedientes_usr($dependencia);

		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('listas/am_expedientes_solicitados', $datos);
		$this->load->view('_footer');
	}

	function solicitar_expediente()
	{
		$dependencia = $this->session->userdata("dependencia");
		$solicitante = $this->session->userdata("codigo");

		$datos['dependencia'] = $dependencia;
		$datos['solicitante'] = $solicitante;
		$datos['ubicaciones']   = $this->m_expedientes->obt_ubicaciones();


		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('formularios/am_solicitar_exp', $datos);
		$this->load->view('_footer');
	}

	function realizar_solicitud()
	{
		$caja 		= $_POST['caja'];
		$etiqueta	= $_POST['etiqueta'];
		$ubicacion 	= $_POST['ubicacion'];
		$expediente = $_POST['expediente'];
		$notas		= $_POST['notas'];
		$usuario 	= $_POST['codigo'];
		$dependencia= $_POST['dependencia'];
		$fecha 		= $this->m_ticket->fechahora_actual();
		$estatus = 1;

		$this->m_expedientes->realizar_solicitud($caja, $etiqueta, $ubicacion, $expediente, $notas, $usuario, $dependencia, $fecha, $estatus);

		redirect('expedientes/archivo_muerto_usr');

	}

	function archivo_muerto_oficialia()
	{
		if ($this->m_seguridad->acceso_modulo(3)) {

			$dependencia = $this->session->userdata("dependencia");
	$datos['expedientes'] = $this->m_expedientes->obt_expedientes_oficialia();

			$this->load->view('_encabezado');
			$this->load->view('_menuLateral');
			$this->load->view('listas/am_expedientes_oficialia', $datos);
			$this->load->view('_footer');	
		}
		else {
			redirect('inicio/noaccess');
		}
		
	}

	function seguimiento_expediente()
	{
		$expediente = $this->uri->segment(3);
		$datos['exp'] = $this->m_expedientes->obt_seguimiento_exp($expediente);
		$datos['asignados'] = $this->m_expedientes->obt_asignados();
		$datos['historial'] = $this->m_expedientes->obt_historial($expediente);
		$datos['estatus' ] = $this->m_expedientes->etiqueta($datos['exp']->estatus);
		$datos['usuarios'] = $this->m_expedientes->obt_usuarios_dependencia($datos['exp']->id_dependencia);

		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('formularios/am_seg_oficialia', $datos);
		$this->load->view('_footer');	
	}

	function asignar_usuario()
	{
		$estatus = 2; 
		$responsable = $_POST['responsable'];
		$folio = $_POST['folio'];
		$fecha= $this->m_ticket->fecha_actual();
		$hora= $this->m_ticket->hora_actual();
		$usr = $this->m_usuario->obt_usuario();

		$this->m_expedientes->asignar_usuario($folio, $responsable, $estatus);
		$this->m_expedientes->h_asignar_usuario($folio, $responsable, $fecha, $hora, $estatus);

	    $msg = '<div class="alert alert-success"><p><i class="fa fa-check"></i>Se ha Asignado con Exito</p></div>';

 		  echo json_encode($msg);
	}
}
