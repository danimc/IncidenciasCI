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
		$this->load->view('_encabezado');
		$this->load->view('_menuLateral');
		$this->load->view('formularios/v_busqueda_mj');
		$this->load->view('_footer');

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

	    $msg = $criterio . '

				<table id="example1" class="table table-hover table-striped">
                <thead>
                    <tr>
                        
                        <th width="">id</th>
                        <th width="">Articulo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';

              	foreach ($resultado as $mensaje){

              //	$texto = $this->m_mj->resaltar($mensaje->articulo, $criterio);          

                  		$msg .=' <tr class="">
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
        $msg .= '</tbody> </table>';

       $respuesta = new \stdClass();
		$respuesta->id = 1;
		$respuesta->mensaje = $msg;

	echo json_encode($respuesta);
	}
	
}