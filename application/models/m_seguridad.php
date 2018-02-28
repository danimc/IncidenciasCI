<?php 

class m_seguridad extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	//////////////////////////////////////////////////////// VALIDAR ACCESOS

	function acceso_sistema()
    {
		$usuario = $this->session->userdata("codigo");
		
		$this->db->where("usuario",$usuario);
		$this->db->where("sistema",1);
		return $this->db->get("accesos_sistemas")->num_rows();    
    }
	
	function acceso_modulo($modulo)
    {
		$usuario = $this->session->userdata("codigo");
		
		$this->db->where("usuario",$usuario);
		$this->db->where("modulo",$modulo);
		return $this->db->get("accesos_modulos")->num_rows();    
    }
	
	/////////////////////////////////////////////////////// CONTROL DE ACCESOS A SISTEMAS 
	
	function limpiar_accesos_sistema($usuario)
	{
		$this->db->where("codigo",$usuario);
		$this->db->delete('accesos_sistemas',$this); 
	}
	
	function limpiar_accesos_modulos($usuario)
	{
		$this->db->where("codigo",$usuario);
		$this->db->delete('accesos_modulos',$this); 
	}
	
	function dar_acceso_sistema($usuario, $sistema)
	{
		$this->sistema = $sistema;			
		$this->usuario = $usuario;
        $this->db->insert("accesos_sistemas",$this);
	}
	
	function dar_acceso_modulo($usuario, $sistema, $modulo)
	{
		$this->sistema = $sistema;			
		$this->usuario = $usuario;
		$this->modulo = $modulo;			
        $this->db->insert("accesos_modulos",$this);
	}
	
	/////////////////////////////////////////////////// LOG GENERAL
	
	
	function log_general($controlador, $funcion, $objeto)
    {        

		$this->sistema = 1;
		$this->controlador = $controlador;
		$this->funcion = $funcion;
		$this->objeto = $objeto;
		$this->usuario = $this->session->userdata("codigo");
		
        $this->db->insert("log_general",$this);

        
    }
}
?>
