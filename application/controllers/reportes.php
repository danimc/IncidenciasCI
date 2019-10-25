<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	
	 function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_reportes', "", TRUE);
		$this->load->model('m_inicio', "", TRUE);

		$this->load->library('excel');


	}

	public function index()
	{
		$datos['total'] = $this->m_inicio->obt_contador_total();	//contador de los tickets reportados en total
		$datos['cerrados'] = $this->m_inicio->obt_contador_cerrados();	//contador de los tickets cerrados
		$datos['abiertos'] = $this->m_inicio->obt_contador_abiertos();	//cont tickets no cerrados
		$datos['noasig'] = $this->m_inicio->obt_contador_noAsignados(); 			
		//$datos['Sresueltos'] = $this->m_reportes->reporte_servicios_resueltos_usuarios();

		$this->load->view('_encabezado1');
		$this->load->view('_menuLateral1');
		$this->load->view('v_inicioReportes', $datos);
		$this->load->view('_footer1');
	
	}

    public function reporte_servicios_resueltos_usuarios()
    {
        if (isset($_POST['mes'])){
            
            $mes = '<b>' .$this->m_reportes->mes_filtro($_POST['mes']) . '</b>';            
            $result = $this->m_reportes->reporte_servicios_resueltos_usuarios_filtro($_POST['mes']);
            $div = '<table class="table table-bordered table-hover dataTable no-footer dtr-inline" id="datatable" role="grid" aria-describedby="datatable_info" >
                                <thead class="thead-default thead-lg">
                                    <tr role="row">
                                        <th>
                                        </th>
                                        <th>
                                            INGENIERO
                                        </th>
                                        <th>
                                            ÁREA
                                        </th>                                    
                                        <th>
                                            SERVICIOS RESUELTOS
                                        </th>                        
                                    </tr>
                                </thead>';

            foreach ($result as $ing ) {
                 $div .= '<tr>
                <td><img src="'.base_url().'src/img/usr/'. $ing->img .'"width="30px" class="user-image img-circle">
                <td>'. $ing->nombre_completo .'</td>
                <td>'. $ing->canal . ' </td>
                <td>'. $ing->cuenta . '</td>
                </tr>';
            }
            $div .= '           </tbody>
                            </table>
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate"></div>';

            $result = array('div' => $div,
                            'mes' => $mes );

            echo json_encode($result);  
        }
        else{
            $result = $this->m_reportes->reporte_servicios_resueltos_usuarios();
            $div = '<table class="table table-bordered table-hover dataTable no-footer dtr-inline" id="datatable" role="grid" aria-describedby="datatable_info" >
                                <thead class="thead-default thead-lg">
                                    <tr role="row">
                                        <th>
                                        </th>
                                        <th>
                                            INGENIERO
                                        </th>
                                        <th>
                                            ÁREA
                                        </th>                                    
                                        <th>
                                            SERVICIOS RESUELTOS
                                        </th>                        
                                    </tr>
                                </thead>';

            foreach ($result as $ing ) {
                 $div .= '<tr>
                <td><img src="'.base_url().'src/img/usr/'. $ing->img .'"width="30px" class="user-image img-circle">
                <td>'. $ing->nombre_completo .'</td>
                <td>'. $ing->canal . ' </td>
                <td>'. $ing->cuenta . '</td>
                </tr>';
            }
             $div .= '<tr>
                <td><img src="'.base_url().'src/img/usr/'. $ing->img .'"width="30px" class="user-image img-circle">
                <td>'. $ing->nombre_completo .'</td>
                <td>'. $ing->canal . ' </td>
                <td>'. $ing->cuenta . '</td>
                </tr>';

            echo json_encode($div);  
        }
      
    }

	public function reporte_years()
	{
		$result = $this->m_reportes->reporte_tickets_years();
		echo json_encode($result);
	}
//pie
	public function reporte_asignados_areas()
	{
        if (isset($_POST['mes'])){
            $mes = '<b>' .$this->m_reportes->mes_filtro($_POST['mes']) . '</b>';      
    		$result = $this->m_reportes->reporte_asignados_areas_filtro($_POST['mes']);
            echo ($result);
        }
        else{
            $result = $this->m_reportes->reporte_asignados_areas();
    		echo ($result);
        }

	}

    public function reporte_dias_semanas()
    {
         if (isset($_POST['mes'])){   
            $result = $this->m_reportes->tickets_por_dia_filtro($_POST['mes']);
            echo ($result);
        }
        else{
            $result = $this->m_reportes->tickets_por_dia();
            echo ($result);
        }
       
    }

    public function reporte_cierre_por_dia()
    {
        if (isset($_POST['mes'])){   
            $result = $this->m_reportes->tickets_cerrados_por_dia_filtro($_POST['mes']);
            echo ($result);
        }
        else{
            $result = $this->m_reportes->tickets_cerrados_por_dia();
            echo ($result);
        }
        
    }

	public function exp_tickets_excel(){
 	$encabezados = $this->m_reportes->exportar_tickets_general();
 	$i = 1;

 	//die(var_dump($encabezados));
 	 	$this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Reporte de Servicios');
        $this->excel->getActiveSheet()->setCellValue('A1', '# SERVICIO')->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('B1', 'FECHA DE REPORTE')->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('C1', 'HORA DE REPORTE')->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('D1', 'SOLICITANTE')->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('E1', 'DEPARTAMENTO')->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('F1', 'SERVICIO')->getStyle('F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('G1', 'CATEGORIA')->getStyle('G1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('H1', 'FORMA DE REPORTE')->getStyle('H1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('I1', 'ESTATUS')->getStyle('I1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('J1', 'FECHA DE ASIGNADO')->getStyle('J1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('K1', 'HORA DE ASIGNADO')->getStyle('K1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('L1', 'PRIORIDAD')->getStyle('L1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('M1', 'USUARIO ASIGNADO')->getStyle('M1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('N1', 'NUM. OFICIO')->getStyle('N1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('O1', 'NUM. FOLIADOR')->getStyle('O1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('P1', 'FECHA DE CIERRE')->getStyle('P1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('Q1', 'HORA DE CIERRE')->getStyle('Q1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->setCellValue('R1', 'CANAL DE ATENCION')->getStyle('R1')->getFont()->setBold(true);

        foreach ($encabezados as $data ) {
        	$i++;
        	$this->excel->getActiveSheet()->setCellValue("A{$i}", $data->folio);
        	$this->excel->getActiveSheet()->setCellValue("B{$i}", $data->fecha_reporte);
        	$this->excel->getActiveSheet()->setCellValue("C{$i}", $data->hora_reporte);
        	$this->excel->getActiveSheet()->setCellValue("D{$i}", $data->solicitante);
        	$this->excel->getActiveSheet()->setCellValue("E{$i}", $data->departamento);
        	$this->excel->getActiveSheet()->setCellValue("F{$i}", $data->servicio);
        	$this->excel->getActiveSheet()->setCellValue("G{$i}", $data->categoria);
        	$this->excel->getActiveSheet()->setCellValue("H{$i}", $data->forma_reporte);
        	$this->excel->getActiveSheet()->setCellValue("I{$i}", $data->estatus);
        	$this->excel->getActiveSheet()->setCellValue("J{$i}", $data->fecha_asignado);
        	$this->excel->getActiveSheet()->setCellValue("K{$i}", $data->hora_asignado);
        	$this->excel->getActiveSheet()->setCellValue("L{$i}", $data->prioridad);
        	$this->excel->getActiveSheet()->setCellValue("M{$i}", $data->asignado);
        	$this->excel->getActiveSheet()->setCellValue("N{$i}", $data->oficio);
        	$this->excel->getActiveSheet()->setCellValue("O{$i}", $data->foliador);
        	$this->excel->getActiveSheet()->setCellValue("P{$i}", $data->fecha_cierre);
        	$this->excel->getActiveSheet()->setCellValue("Q{$i}", $data->hora_cierre);
        	$this->excel->getActiveSheet()->setCellValue("R{$i}", $data->canal_atencion);

        }

        //$this->excel->getActiveSheet()->getStyle('A1','R1')->getFont()->setBold(true);
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="nombredelfichero.xls"');
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        // Forzamos a la descarga
        $objWriter->save('php://output');

    }



}
