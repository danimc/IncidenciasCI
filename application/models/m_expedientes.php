<?php 

class m_expedientes extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obt_expedientes_usr($dependencia)
    {
    	$qry = '';

    	$qry = "SELECT 
				am.id
				,usr.usuario
				,caja
				,etiqueta
				,expediente
				,ubi.nombre as ubicacion
				,e.usuario as entregado
				,am.estatus
				,fecha_solicitud
				FROM crm.am_expedientes_solicitados am
				LEFT JOIN usuario usr ON usr.codigo = am.solicitante
				LEFT JOIN usuario e ON e.codigo = am.entregado_a
				LEFT JOIN am_ubicacion ubi ON ubi.id = am.ubicacion
				WHERE am.dependencia = '$dependencia'";
    	
    	return $this->db->query($qry)->result();
    }

    function obt_ubicaciones()
    {
    	return $this->db->get("am_ubicacion")->result();
    }

    function realizar_solicitud($caja, $etiqueta, $ubicacion, $expediente, $notas, $usuario, $dependencia, $fecha, $estatus)
    {
    	$this->caja = $caja;
    	$this->etiqueta = $etiqueta;
    	$this->ubicacion = $ubicacion;
    	$this->expediente = $expediente;
    	$this->notas = $notas;
    	$this->solicitante = $usuario;
    	$this->dependencia = $dependencia;
    	$this->fecha_solicitud = $fecha;
    	$this->estatus = $estatus;

    	$this->db->insert('am_expedientes_solicitados', $this);
    }
}
