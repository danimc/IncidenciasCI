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
				and est.id != 5";

		return $this->db->query($qry)->result();
    }
}
?>