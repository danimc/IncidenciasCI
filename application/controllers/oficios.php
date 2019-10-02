<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficios extends CI_Controller {
	
	 function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_reportes', "", TRUE);
		$this->load->model('m_ticket', "", TRUE);
        $this->load->model('m_oficios', "", TRUE);
		$this->load->library('excel');


	}

	public function index()
	{
		$codigo = $this->session->userdata("codigo");
		$usuario = $this->m_usuario->obt_usuario($codigo);	
		$datos['usuario'] = $usuario;
		$datos['oficios'] = $this->m_oficios->obt_oficios();

		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('v_inicioOficios', $datos);
		$this->load->view('_footer1');	
	}

    function nuevo_oficio()
    {
        $codigo = $this->session->userdata("codigo"); 
        $datos['usuario'] = $this->m_usuario->obt_usuario($codigo);
        $datos['dependencias'] = $this->m_ticket->obt_dependencias();
        $datos['reportante'] = $this->m_usuario->obt_usuarios_like();
        $datos['titulos'] = $this->m_ticket->obt_titulos();
        $datos['tipos'] = $this->m_oficios->obt_tipoOficios();
        $consecutivo = $this->m_oficios->obt_maxConsecutivo();
        $datos['consecutivo'] = $consecutivo->cons + 1;

        $this->load->view('_encabezado1');
        $this->load->view('_menuLateral1');
        $this->load->view('formularios/v_nuevo_oficio', $datos);
        $this->load->view('_footer1');  
    }

    function vista_previa_resguardo()
    {
        $data = json_decode($_POST['datos']);
        $i = count($data);
        $oficio = $data[$i-1];
        $cargo = '';
        $escrito = '';
        $c = 0;

        while ($c < $i-1) {
            if ($data[$c]->cargo != '') {
                $cargo = $data[$c]->cargo;
            }else {
                $cargo = "adscrito al ". $data[$c]->adscripcion;
            }

            $resguardos = $data[$c]->resguardo;

            if ($c == 0) {
                

                $escrito = "<p>Aunado a un cordial saludo, informo que el siguiente equipo pasará a resguardo del 
                ".$data[$c]->resguardante .", ". $cargo. ", con número de extensión ". $data[$c]->ext . ". </p>

                <table class='tbl'>
                <tr>
                <th>EQUIPO</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>SERIE</th>
                <th>PESA</th>
                </tr>";

                foreach ($resguardos as $resguardo) {
                    $escrito .= "<tr>
                                    <td>". $resguardo->equipo . "</td>
                                    <td>". $resguardo->marca . "</td>
                                    <td>". $resguardo->modelo. "</td>
                                    <td>". $resguardo->serie . "</td>
                                    <td>". $resguardo->pesa . "</td>
                                </tr>";
                }
                $escrito .= "</table>";
            }
            if ($c == 1) {
                $escrito .= "<p>Así mismo, el siguiente equipo pasará a resguardo de ".$data[$c]->resguardante.", ". $cargo. ", con número de extensión ". $data[$c]->ext . ".</p>

                <table class='tbl'>
                <tr>
                <th>EQUIPO</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>SERIE</th>
                <th>PESA</th>
                </tr>";

                foreach ($resguardos as $resguardo) {
                    $escrito .= "<tr>
                                    <td>". $resguardo->equipo . "</td>
                                    <td>". $resguardo->marca . "</td>
                                    <td>". $resguardo->modelo. "</td>
                                    <td>". $resguardo->serie . "</td>
                                    <td>". $resguardo->pesa . "</td>
                                </tr>";
                }

                $escrito .= "</table>";
            }
            if ($c ==2) {
                $escrito .= "<p>Finalmente, el siguiente equipo pasará a resguardo de ".$data[$c]->resguardante.", ". $cargo. ", con número de extensión ". $data[$c]->ext . ".</p>

                <table class='tbl'>
                <tr>
                    <th>EQUIPO</th>
                    <th>MARCA</th>
                    <th>MODELO</th>
                    <th>SERIE</th>
                    <th>PESA</th>
                </tr>";

                foreach ($resguardos as $resguardo) {
                    $escrito .= "<tr>
                                    <td>". $resguardo->equipo . "</td>
                                    <td>". $resguardo->marca . "</td>
                                    <td>". $resguardo->modelo. "</td>
                                    <td>". $resguardo->serie . "</td>
                                    <td>". $resguardo->pesa . "</td>
                                </tr>";
                }
                $escrito .= "</table>";
            }
            $c++;       
        }

         $nOficio = 'DTI/'.$oficio.'/2019';

         $oficioSend = array(
                        'consecutivo'       => $oficio,
                        'oficio'            => $nOficio,
                        'destinatario'      => "LIC. ROBERTO EDUARDO DUARTE URIBE",
                        'cargo'             => 'ENCARGADO DE LA COORDINACIÓN DE CONTROL DE BIENES DE LA FISCALÍA ESTATAL',
                        'redaccion'         => $escrito,
                        'fecha_realizado'   => $this->m_ticket->fecha_actual(),
                        'hora_realizado'    => $this->m_ticket->hora_actual(),
                        'estatus'           => 1,
                        'capturista'        => $this->session->userdata("codigo"),
                        'tipo'              => 2
                    );

        $this->m_oficios->capturar_oficio($oficioSend);
        $idIncidente = $this->db->insert_id();
        if ($idIncidente != '') {
           echo $idIncidente;
        }
    }


    function capturar_oficio()
    {
        $nOficio = 'DTI/'.$_POST['consecutivo'].'/2019';
        $oficio = array(
                        'consecutivo'       => $_POST['consecutivo'],
                        'oficio'            => $nOficio,
                        'folio'             => $_POST['folio'],
                        'oficioRecibido'    => $_POST['oficioRecibido'],
                        'destinatario'      => $_POST['destinatario'],
                        'cargo'             => $_POST['cargo'],
                        'ccp'               => $_POST['ccp'],
                        'redaccion'         => $_POST['redaccion'],
                        'fecha_realizado'   => $this->m_ticket->fecha_actual(),
                        'hora_realizado'    => $this->m_ticket->hora_actual(),
                        'estatus'           => 1,
                        'tipo'              => 1,
                        'capturista'        => $this->session->userdata("codigo")
                    );
        $verificador = $this->m_oficios->verifica_nuevoOficio($nOficio);
        if ($verificador == 0) {
            $this->m_oficios->capturar_oficio($oficio);
            $idIncidente = $this->db->insert_id();
            if ($idIncidente != '') {
                echo $idIncidente;
            }
        }
        else
        {
            $mensaje = 0;
            echo $mensaje;
        }
        
    
    }

    function genera_PDF()
    {
        $this->load->library('mydompdf');
        $idOficio = $this->uri->segment(3);
        $data['oficio'] = $this->m_oficios->obt_datosOficio($idOficio);

        $html = $this->load->view('pdf/v_oficioPDF',$data,true);

        /*
         * load_html carga en dompdf la vista
         * render genera el pdf
         * stream ("nombreDelDocumento.pdf", Attachment: true | false)
         * true = forza a descargar el pdf
         * false = genera el pdf dentro del navegador
         */
         $this->mydompdf->load_html($html);
         $this->mydompdf->setPaper("Letter","potrait");
         $this->mydompdf->render();
         $this->mydompdf->stream("ficha", array("Attachment" => false));
    }




}
