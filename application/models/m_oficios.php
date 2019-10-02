<?php 

class m_oficios extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function capturar_oficio($oficio)
    {
    	$this->db->insert("Tb_Oficios", $oficio);
    }

    function obt_datosOficio($idIncidente)
    {
    	$this->db->where('id', $idIncidente);
    	return $this->db->get('Tb_Oficios')->row();
    }

    function obt_maxConsecutivo()
    {
    	$year = date('Y');
    	$qry = "";

    	$qry = "
    		SELECT max(consecutivo) as cons
    		FROM crm.Tb_Oficios
			where oficio like '%/$year'";

		return $this->db->query($qry)->row();
    }

    function verifica_nuevoOficio($oficio)
    {
    	$this->db->where('oficio', $oficio);

    	return $this->db->get('Tb_Oficios')->num_rows();
    }

    function obt_oficios()
    {
    	$qry = "";

    	$qry = "SELECT 
				Tb_Oficios.id,
				oficio,
				destinatario,
				cargo,
				fecha_realizado,
				estatus,
				t.tipoOficio as tipo
				 FROM crm.Tb_Oficios
				 LEFT JOIN Tb_Cat_TipoOficio t ON t.id = Tb_Oficios.tipo";

		return $this->db->query($qry)->result();
    }

    function capturar_consecutivo()
    {
    	
    	$this->db->insert('Tb_Oficios',$this);
    }

    function obt_tipoOficios()
    {
    	return $this->db->get('Tb_Cat_TipoOficio')->result();
    }

    function estatus($estatus)
    {
    	if($estatus == 1){
            $esta = ' <span data-toggle="modal" data-target="#modalStatus" class="btn badge btn-info badge-pill mb-2"><i class="fa fa-file"></i> Capturado</span>';
            return $esta;
        }
        if($estatus == 2){
            $esta = ' <span data-toggle="modal" data-target="#modalStatus" class="btn badge btn-pink badge-pill mb-2"><i class="fa fa-paper-plane"></i> Enviado</span>';
            return $esta;
        }
          if($estatus == 3){
            $esta = ' <span data-toggle="modal" data-target="#modalStatus" class="btn badge btn-success badge-pill mb-2"><i class="fa fa-check"></i> Entregado</span>';
            return $esta;
        }
    }

    function correo_ticket_cerrado($folio, $fecha, $hora)
	{
	
	}
}