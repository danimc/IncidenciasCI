<?php 

class m_usuario extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obt_usuario() 
    {
    	$usr = $this->session->userdata("codigo");

    	$qry = "SELECT 
				codigo
				,usuario
				, CONCAT(nombre, ' ', apellido) as nombre
				, dependencias.abreviatura as dependencia
				, foto
                , rol
                , extension
                , correo
				FROM crm.usuario
				INNER JOIN dependencias
				WHERE usuario.dependencia = dependencias.id_dependencia
				AND codigo = '$usr'";
    	
    	return $this->db->query($qry)->row();
    }
    function obt_usuario_ticket($id)
    {
        $this->db->where('codigo',$id);
        return $this->db->get('usuario')->row();
    }


}