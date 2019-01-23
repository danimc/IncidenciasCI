<?php 

class m_mj extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function busqueda($criterio)
	{
		$qry = "";
		
		$qry = "SELECT 
				id_articulo,
				t.titulo,
				c.capitulo,
				s.seccion,
				a.articulo
				FROM 
				mj_cat_articulo a
				LEFT JOIN mj_cat_titulos t ON t.id = a.titulo
				LEFT JOIN mj_cat_seccion s ON s.id_seccion = a.seccion
				LEFT JOIN mj_cat_capitulos c ON c.id_capitulo = a.capitulo
				WHERE MATCH (a.articulo) AGAINST ('$criterio' IN BOOLEAN MODE )";

		return $this->db->query($qry)->result();	
	}

	function resaltar($texto, $criterio)
	{
	$claves = explode(" ",$criterio); 
    $clave = array_unique($claves);
    $num = count($clave); 
    for($i=0; $i < $num; $i++){
        $texto = preg_replace("/(".trim($clave[$i]).")/i","<span style='color: #000000;
	background: #55FF2A;
	font-weight: bold;'>\\1</span>",$texto);
    }
    return $texto;
	}
}