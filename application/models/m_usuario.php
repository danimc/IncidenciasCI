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
                , dependencias.nombre_dependencia as nom_dependencia
				, foto
                , rol
                , extension
                , correo
                , password
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

    function cambiar_contra($usuario, $contraMd5)
    {
        $this->db->set('password', $contraMd5);
        $this->db->where('codigo', $usuario);
        $this->db->update('usuario');

    }
}