<?php 

class m_inicio extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obt_contador_total()
    {
        return $this->db->get('ticket')->num_rows();
    }
    function obt_contador_cerrados()
    {
        $this->db->where('estatus', 5);
        return $this->db->get('ticket')->num_rows();
    }
        function obt_contador_abiertos()
    {
        $this->db->where('estatus !=', 5);
        return $this->db->get('ticket')->num_rows();
    }

    function tickets_pendientes_sis($usr)
    {
    	$qry = "";

    	$qry = "SELECT 
				folio
				,fecha_inicio
				,hora_inicio
				,us.usuario
				,titulo
				,categoria_ticket.categoria
				,est.situacion
				,fecha_asignado
				,hora_asignado
				,asignado.usuario usr_asignado
				,ticket.estatus
                ,ticket.descripcion
				from ticket
				LEFT JOIN  usuario us on us.codigo = ticket.usr_incidente
				LEFT JOIN categoria_ticket on categoria_ticket.id_cat = ticket.categoria
				LEFT JOIN situacion_ticket est on est.id = ticket.estatus
				LEFT JOIN usuario asignado on ticket.usr_asignado = asignado.codigo
				where usr_asignado = '$usr'
				and est.id != 5
				LIMIT 10";

		return $this->db->query($qry)->result();
    }

    function tickets_pendientes_usr($usr)
    {
        $qry = "";

        $qry = "SELECT 
                folio
                ,fecha_inicio
                ,hora_inicio
                ,us.usuario
                ,titulo
                ,categoria_ticket.categoria
                ,est.situacion
                ,fecha_asignado
                ,hora_asignado
                ,asignado.usuario usr_asignado
                ,ticket.estatus
                from ticket
                LEFT JOIN  usuario us on us.codigo = ticket.usr_incidente
                LEFT JOIN categoria_ticket on categoria_ticket.id_cat = ticket.categoria
                LEFT JOIN situacion_ticket est on est.id = ticket.estatus
                LEFT JOIN usuario asignado on ticket.usr_asignado = asignado.codigo
                where usr_incidente = '$usr'
                and est.id != 5
                LIMIT 10";

        return $this->db->query($qry)->result();
    }


       function tickets_pendientes_general()
    {
        $qry = "";

        $qry = "SELECT 
                folio
                ,fecha_inicio
                ,hora_inicio
                ,us.usuario
                ,titulo
                ,categoria_ticket.categoria
                ,est.situacion
                ,fecha_asignado
                ,hora_asignado
                ,asignado.usuario usr_asignado
                ,ticket.estatus
                from ticket
                LEFT JOIN  usuario us on us.codigo = ticket.usr_incidente
                LEFT JOIN categoria_ticket on categoria_ticket.id_cat = ticket.categoria
                LEFT JOIN situacion_ticket est on est.id = ticket.estatus
                LEFT JOIN usuario asignado on ticket.usr_asignado = asignado.codigo
                where est.id != 5
                ORDER BY folio DESC
                LIMIT 10";

        return $this->db->query($qry)->result();
    }

      function etiqueta($estatus)
    {
        if($estatus == 1){
            $esta = ' <span class="badge badge-primary badge-pill mb-2"><i class="fa fa-ticket"></i> Abierto</span>';
            return $esta;
        }
        if($estatus == 2){
            $esta = ' <span class="badge badge-pink badge-pill mb-2"><i class="fa fa-user-plus"></i> Asignado</span>';
            return $esta;
        }
          if($estatus == 3){
            $esta = ' <span class="badge badge-info badge-pill mb-2"><i class="fa fa-spinner"></i> En Proceso</span>';
            return $esta;
        }
          if($estatus == 4){
            $esta = ' <span class="badge badge-success badge-pill mb-2"><i class="fa fa-check-circle"></i> Resuelto</span>';
            return $esta;
        }
            if($estatus == 5){
            $esta = ' <span class="badge badge-danger badge-pill mb-2"><i class="fa fa-lock"></i> Cerrado</span>';
            return $esta;
        }
           if($estatus == 6){
            $esta = ' <span class="badge badge-secondary badge-pill mb-2"><i class="fa  fa-hourglass-2"></i> Pendiente</span>';
            return $esta;
        }
           if($estatus == 7){
            $esta = ' <span class="badge badge-warning badge-pill mb-2"><i class="fa  fa-random"></i> Reasignado</span>';
            return $esta;
        }
    }
}
?>