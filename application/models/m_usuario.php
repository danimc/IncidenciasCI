<?php 

class m_usuario extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obt_usuarios()
    {
        $qry = '';

        $qry = "SELECT codigo,
         nombre, 
         apellido, 
         usuario, 
         abreviatura, 
         nombre_dependencia, 
         p.puesto, 
         extension, 
         estatus
         FROM crm.usuario
         INNER JOIN crm.dependencias
         INNER JOIN crm.puesto_usr p
         WHERE dependencia = id_dependencia
         AND usuario.puesto = p.id";

         return $this->db->query($qry)->result();
    }

    function obt_usuario($codigo) 
    {
    	$usr = $codigo;

    	$qry = "SELECT 
                codigo
                ,usuario
                ,nombre as nombres
                ,apellido
                , CONCAT(nombre, ' ', apellido) as nombre
                ,dependencias.id_dependencia as depId
                , dependencias.abreviatura as dependencia
                , dependencias.nombre_dependencia as nom_dependencia
                , foto
                , usuario.rol as id_rol
                , rol.rol
                , p.puesto
                , e.situacion
                , estatus
                , extension
                , correo
                , password
                FROM crm.usuario
                INNER JOIN dependencias
                INNER JOIN crm.puesto_usr p
                INNER JOIN situacion_usuarios e
                INNER JOIN rol
                WHERE usuario.dependencia = dependencias.id_dependencia
                AND usuario.puesto = p.id
                AND usuario.estatus = e.id
                AND rol.id_rol = usuario.rol
                AND codigo = '$usr'";
    	
    	return $this->db->query($qry)->row();
    }
    function obt_usuario_ticket($id)
    {
        $this->db->where('codigo',$id);
        return $this->db->get('usuario')->row();
    }

    function obt_dependencias()
    {
        return $this->db->get('dependencias')->result();
    }

    function obt_situacion_usuarios()
    {
        return $this->db->get('situacion_usuarios')->result();
    }

    function obt_plazas()
    {
        return $this->db->get('puesto_usr')->result();
    }

    function obt_roles()
    {
        return $this->db->get('rol')->result();
    }

    function cambiar_contra($usuario, $contraMd5)
    {
        $this->db->set('password', $contraMd5);
        $this->db->where('codigo', $usuario);
        $this->db->update('usuario');

    }

    function editar_usuario($nombre, $apellido, $dependencia, $extension, $correo, $codigo)
    {
        $this->db->set('nombre', $nombre);
        $this->db->set('apellido', $apellido);
        $this->db->set('dependencia', $dependencia);
        $this->db->set('extension', $extension);
        $this->db->set('correo', $correo);
        $this->db->where('codigo', $codigo);

        $this->db->update('usuario');
    }

    function obt_tickets_reportados($codigo)
    {
        $this->db->where('usr_incidente', $codigo);

       return $this->db->get('ticket')->num_rows();
    }

    function editar_datos_personal($situacion, $plaza, $rol, $codigo)
    {
        $this->db->set('puesto', $plaza);
        $this->db->set('estatus', $situacion);
        $this->db->set('rol', $rol);

        $this->db->where('codigo', $codigo);

        $this->db->update('usuario');
    }
}