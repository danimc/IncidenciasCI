<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uppi extends CI_Controller {
	
	 function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_ticket',"",TRUE);
		$this->load->model('m_uppi',"",TRUE);

	}

	public function index()
	{
		$datos['bouchers'] = $this->m_uppi->obt_bouchers();

		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('listas/l_vouchers', $datos);
		$this->load->view('_footer1');

	}

	public function nuevo_registro()
	{
		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('formularios/v_nuevo_boucher');
		$this->load->view('_footer1');
	}

	function registrar()
	{
		$capturista = $this->session->userdata("codigo");
		$isbn = $_POST['isbn'];
		$dependencia = $_POST['dependencia'];
		$expediente = $_POST['expediente'];
		$fecha = $_POST['fecha'];		

		$boucher = array(			
			'fecha_captura'	=> $this->m_ticket->fechahora_actual(),
			'capturista' 	=> $capturista,
			'dependencia'	=> $dependencia,
			'isbn'			=> $isbn,
			'expediente'	=> $expediente,
			'fecha'			=> $fecha			
			 );


		

		$this->m_uppi->registrar_boucher($boucher);
		$consecutivo = $this->db->insert_id();
		$this->subir_boucher($consecutivo);

		//$this->m_ticket->noti_alta($reportante, $usuarioIncidente, $idIncidente, $notificacion);
	//	redirect(base_url() . 'index.php?/ticket/seguimiento/'.$idIncidente);
		redirect('uppi');
	}

	function subir_boucher($consecutivo){

		for($i=0;$i<count($_FILES["imagen"]["name"]);$i++)
        {
        	if($_FILES['imagen']['name'][$i] != ""){

			
				$x = $i+1;
				$origen=$_FILES["imagen"]["tmp_name"][$i];
				$ext = explode('.',$_FILES['imagen']['name'][$i]);
				$ext = $ext[count($ext) - 1];
				$ruta ='att_' . $consecutivo .'_' . $x .'.' . $ext; 				
				move_uploaded_file($origen , $this->ftp_ruta . 'src/uppi/boucher/'. $ruta );

				$this->m_uppi->subir_boucher($ruta, $consecutivo);
			}
		}

	}

	
	function clima()
	{
		$respuesta = file_get_contents("https://api.openweathermap.org/data/2.5/weather?id=8133378&APPID=731ac0d3caf3cd694ce7a8df5d1c278b&units=metric&lang=es");

		$clima = json_decode($respuesta);
		$datosClima = $clima->main;
		$temperatura = $datosClima->temp;
		$tempMin	= $datosClima->temp_min;
		$tempMax	= $datosClima->temp_max;

		echo "Buen dia compañero, hoy tenemos una temperatura de ".$temperatura . "° C. con una minima de ". $tempMin. " y hasta una 
		temperatura maxima de " .$tempMax;



	}
	
}