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
		$datos['rol'] = $this->session->userdata("rol");
		$datos['dependencias'] = $this->m_usuario->obt_dependencias();
		$datos['estatus'] = $this->m_usuario->obt_situacion_usuarios(); 
		$datos['plazas'] = $this->m_usuario->obt_plazas();
		$datos['roles'] = $this->m_usuario->obt_roles();
		
		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('formularios/v_nuevo_usuario', $datos);
		$this->load->view('_footer1');
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
		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('v_perfil', $datos);
		$this->load->view('_footer1');
	}

	function obt_usuario()
	{
		$codigo = $_POST['busqueda'];
		$tipo   = $_POST['tipo'];
		if ($tipo == 1) {
			$usuario = $this->m_usuario->obt_usuario_ticket($codigo);
		}
		if ($tipo == 2) {
			$usuario = $this->m_usuario->obt_usuario_ticket_nombre($codigo);
		}
		
		echo json_encode($usuario);
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
		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('formularios/v_perfil_edit', $datos);
		$this->load->view('_footer1');
	}

	function editar_perfil()
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
		$datos['rol'] = $this->session->userdata("rol");
		$datos['dependencias'] = $this->m_usuario->obt_dependencias();
		$datos['estatus'] = $this->m_usuario->obt_situacion_usuarios(); 
		$datos['plazas'] = $this->m_usuario->obt_plazas();
		$datos['roles'] = $this->m_usuario->obt_roles();
		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('formularios/v_perfil_edit', $datos);
		$this->load->view('_footer1');
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

	function alta_usuario()
	{
		$codigo = $this->input->post('codigo');
		
		$usuario = array(
						'codigo' 			=> intval($this->input->post('codigo')),
						'nombre' 			=> $this->input->post('nombre'),
						'apellido'			=> $this->input->post('apellido'),
						'usuario'			=> $this->input->post('userid'),
						'nombre_completo'	=> $this->input->post('apellido'). 
											   ' '. $this->input->post('nombre'),
						'password'			=> md5($this->input->post('password')),
						'dependencia'		=> $this->input->post('dependencia'),
						'extension'			=> $this->input->post('extension'),
						'correo'			=> $this->input->post('email'),
						'estatus'			=> $this->input->post('estatus'),
						'puesto'			=> $this->input->post('plaza'),
						'rol'				=> $this->input->post('rol'),
						'fecha_alta'		=> $this->m_ticket->fecha_actual()
					);
		
		$this->m_usuario->alta_usuario($usuario);

		$sistema = array(
			'sistema' 	=> 1,
			'usuario'	=> $codigo,
			'fecha'		=> $this->m_ticket->fecha_actual(), 
		);

		$this->m_usuario->acceso_sistemas($sistema);

	}

	
	function modificar_perfil()
	{
		$codigo			= $_POST['codigo'];
		$usuario = array(
						'nombre' 			=> $this->input->post('nombres'),
						'apellido'			=> $this->input->post('apellido'),
						'nombre_completo'	=> $this->input->post('apellido'). 
											   ' '. $this->input->post('nombres'),
						'dependencia'		=> $this->input->post('dependencia'),
						'extension'			=> $this->input->post('extension'),
						'correo'			=> $this->input->post('email'),
						'estatus'			=> $this->input->post('estatus'),
						'puesto'			=> $this->input->post('plaza'),
						'rol'				=> $this->input->post('rol')
					);

		$this->m_usuario->editar_usuario($codigo, $usuario);

		redirect('usuario/editar_perfil/'. $codigo);

	}

	function cambiar_img()
    {
        $img = $_FILES['img'];
        $ext = explode('.', $img['name']);
        $ext = strtolower($ext[count($ext) - 1]);
        if ($img['error'] == 0) {
            if ($ext != 'jpg' AND $ext != 'png' AND $ext != 'jpeg') {
                redirect('usuario/perfil/i1');
            }else {
                //$usr = md5($_POST['usuario']);
                $usr = $_POST['usuario'];
                move_uploaded_file($img['tmp_name'], $this->ftp_ruta . 'src/img/usr/us_'.$usr.'.' . $ext);
                $ruta = 'us_'.$usr.'.' . $ext;
                $this->m_usuario->cambiar_img($ruta, $usr);
                redirect('usuario/perfil');
            }
        }else {
            redirect('usuario/perfil/i2');
        }
    }
        


	function lista_usuarios()
	{ 
		$datos['usuario'] = $this->m_usuario->obt_usuarios();

		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('listas/l_listaUsuarios', $datos);
		$this->load->view('_footer1');
	}
}

?>