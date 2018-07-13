<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_inicio',"",TRUE);
	}

	public function index()
	{
		$codigo = $this->session->userdata("codigo");	
		$datos['usuario'] = $this->m_usuario->obt_usuario($codigo);
		$datos['tPendientes'] = $this->m_inicio->tickets_pendientes_sis($codigo);

		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('v_inicio', $datos);
		$this->load->view('_footer');
	
	}


	public function noaccess()
	{
		$this->load->view('_head');
		$this->load->view('errors/_noaccess');
	}

}
