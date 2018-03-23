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
}
