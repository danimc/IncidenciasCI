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
		$this->load->model('m_correos',"",TRUE);
	}

	public function index()
	{
		$codigo = $this->session->userdata("codigo");
		if($this->session->userdata("codigo") == null){
			redirect('/acceso/logout');
		}


		$fecha = $this->m_ticket->fecha_actual();
		$comprobador =	$this->m_inicio->obt_diaHoy($fecha);

		if($comprobador == 0) {
			$this->m_ticket->SendTelegram1();
		}

		
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
		$datos['usr'] = $this->m_usuario->obt_usuario($codigo);
		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('v_descargaFormatos', $datos);
		$this->load->view('_footer1');	
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

	public function pruebaEmail()
	{
		$this->m_correos->correo();
	}

	
		
	public function info()
	{
		$info = file_get_contents('https://148.202.169.15/hp/device/MessageCenter/Summary?_=1569607557085');
		echo $info;

		$this->load->view('_footer1');

	}
	

 


}
