<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mj extends CI_Controller {
	
	 function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_ticket',"",TRUE);
		$this->load->model('m_mj',"",TRUE);

	}

	public function index()
	{
		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('formularios/v_busqueda_mj');
		$this->load->view('_footer1');

	}

	function buscar()
	{
		$busquedas = $_POST['busqueda'];
		$claves = explode(" ", $busquedas);	
		$num = count($claves);
		$criterio = '';

		for($i=0; $i < $num; $i++){
        $criterio = ' +' . $claves[$i] . $criterio;
    	} 
		$resultado = $this->m_mj->busqueda($criterio);	

		//echo json_encode("RESULTADO" . $resultado);


        $div = ' <table class="table">
                                    <thead class="thead-default">
                                        <tr>
                        
                        <th width="">id</th>
                        <th width="">Articulo</th>
                        <th></th>
                    </tr>
                                    </thead>
                                    <tbody>';
           	foreach ($resultado as $mensaje) {
        $div .=   ' <tr class="">
                    		<td>
                    	   	' .$mensaje->seccion . '
                    	 	</td>
                    	 	<td>
                    	 	' .$mensaje->articulo . '
                    	 	</td>
                    	 	<td>
                    	  
                    		</td>
                        </tr>';
           	}
                                       
        $div .= 	                '</tbody>
                                </table>';

		echo json_encode($div);

      
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