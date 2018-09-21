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

	}

	function nuevo_usuario()
	{

	}

	function perfil()
	{	
		$editar = $this->uri->segment(3);

		if($editar != ''){
			$codigo = $editar;
		}
		else{
			$codigo = $this->session->userdata("codigo");
		}
		
		$datos['ticketR'] = $this->m_usuario->obt_tickets_reportados($codigo);
		$datos['rol'] = $this->session->userdata("rol");
		$datos['usuario'] = $this->m_usuario->obt_usuario($codigo);	
		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('v_perfil', $datos);
		$this->load->view('_footer');
	}

	function cambiar_contra()
	{
		$usuario 	= $_POST['usuario'];
		$contra 	= htmlentities($_POST['contraNueva']);
		$contraMd5	= md5($contra);

		$this->m_usuario->cambiar_contra($usuario, $contraMd5);

		redirect('usuario/index/e');

	}

	function editar()
	{
		$editar = $this->uri->segment(3);

		if($editar != ''){
			$codigo = $editar;
		}
		else{
			$codigo = $this->session->userdata("codigo");
		}

		
		$datos['usuario'] = $this->m_usuario->obt_usuario($codigo);
		$datos['dependencias'] = $this->m_usuario->obt_dependencias();	
		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('formularios/v_perfil_edit', $datos);
		$this->load->view('_footer');
	}

	function editar_info_personal()
	{
		$editar = $this->uri->segment(3);

		if($editar != ''){
			$codigo = $editar;
		}
		else{
			$codigo = $this->session->userdata("codigo");
		}

		
		$datos['usuario'] = $this->m_usuario->obt_usuario($codigo);
		$datos['situaciones'] = $this->m_usuario->obt_situacion_usuarios();
		$datos['plazas'] = $this->m_usuario->obt_plazas();
		$datos['roles'] = $this->m_usuario->obt_roles();
		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('formularios/v_perfil_editPersonal', $datos);
		$this->load->view('_footer');
	}

	function editar_datos_personal()
	{
		$codigo			= $_POST['codigo'];
		$situacion	= $_POST['situacion'];	  
		$plaza		= $_POST['plaza'];
		$rol		= $_POST['rol'];

		$this->m_usuario->editar_datos_personal($situacion, $plaza, $rol, $codigo);

		redirect('usuario/perfil/'. $codigo);
	}

	function editar_usuario()
	{
		$codigo			= $_POST['codigo'];
		$nombre 		= $_POST['nombre'];
		$apellido		= $_POST['apellido'];
		$dependencia 	= $_POST['dependencia'];
		$extension 		= $_POST['extension'];
		$correo			= $_POST['correo'];

		$this->m_usuario->editar_usuario($nombre, $apellido, $dependencia, $extension, $correo, $codigo);

		redirect('usuario/editar/'. $codigo);

	}

	function lista_usuarios()
	{ 
		$datos['usuario'] = $this->m_usuario->obt_usuarios();

		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('listas/l_listaUsuarios', $datos);
		$this->load->view('_footer');
	}
}

?>