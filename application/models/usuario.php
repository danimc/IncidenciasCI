<?php
    class Usuario extends CI_Model{
		

        function __construct(){

            parent::__construct();
        }
        
        function validar()
        {
            if($this->simplelogin->login($_REQUEST['user'],$_REQUEST['password'])){

					redirect("/Inicio");
				 
            }
            else{
                redirect("acceso/index/e");
            }
        }    
        
}
?>