<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	
	 function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_ticket',"",TRUE);

	}

	public function index()
	{	

		$datos['usuario'] = $this->m_usuario->obt_usuario();	
		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('v_perfil', $datos);
		$this->load->view('_footer');


	}
}
?>