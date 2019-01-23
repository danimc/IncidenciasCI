<?php 

class m_inicio extends CI_Model {

    function __construct()
    {
        parent::__construct();
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
            $esta = '<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalStatus" title="Cambiar Status"> <i class="fa fa-ticket"></i> Abierto
                        </button>';
            return $esta;
        }
        if($estatus == 2){
            $esta = '<button class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#modalStatus" title="Cambiar Status">
                            <i class="fa fa-user-plus"></i> Asigando
                      </button>';
            return $esta;
        }
          if($estatus == 3){
            $esta = '<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalStatus" title="Cambiar Status"> <i class="fa fa-spinner"></i> En Proceso
                        </button>';
            return $esta;
        }
          if($estatus == 4){
            $esta = '<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalStatus" title="Cambiar Status"> 
                            <i class="fa fa-check-circle"></i> Resuelto
                        </button>';
            return $esta;
        }
            if($estatus == 5){
            $esta = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalStatus" title="Cambiar Status">
                <i class="fa fa-lock"></i> Cerrado
                </button>';
            return $esta;
        }
           if($estatus == 6){
            $esta = '<button class="btn btn-xs bg-black" data-toggle="modal" data-target="#modalStatus" title="Cambiar Status"> 
                            <i class="fa  fa-hourglass-2"></i> Pendiente
                        </button>';
            return $esta;
        }
           if($estatus == 7){
            $esta = '<button class="btn btn-xs bg-orange" data-toggle="modal" data-target="#modalStatus" title="Cambiar Status">
                            <i class="fa  fa-random"></i> Reasignado
                        </button>';
            return $esta;
        }
    }
}
?>