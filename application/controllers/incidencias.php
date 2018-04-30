<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidencias extends CI_Controller {
	
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

		redirect('incidencias/lista_tickets/'. $this->db->insert_id());

		//echo $this->db->insert_id() ;
	}

	function lista_tickets()
	{
		$folio = $this->uri->segment(3);
		
		$datos['usuario'] = $this->m_usuario->obt_usuario();
		$datos['folio'] = $folio;

		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('_lTickets', $datos);
		$this->load->view('_footer');
	}




}