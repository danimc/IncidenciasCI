<?php 

class m_ticket extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obt_lista_usuarios(){

     return $this->db->get("usuario")->result();   
    }

    function obt_categorias(){
     return $this->db->get("categoria_ticket")->result();   

    }

    function obt_asignados(){

        $this->db->where("rol", 1);
        return $this->db->get("usuario")->result();
    }

    function nuevo_incidente($reportante, $usuarioIncidente, $titulo, $descripcion, $categoria, $estatus)
    {
        $fecha = $this->fecha_actual();
        $hora = $this->hora_actual();

        $this->fecha_inicio = $fecha;
        $this->hora_inicio = $hora;
        $this->usr_reportante = $reportante;
        $this->usr_incidente = $usuarioIncidente;
        $this->categoria = $categoria;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->estatus = $estatus;
        $this->prioridad = 3;

        $this->db->insert("ticket", $this);

       

    }

    function seguimiento_ticket($folio)
    {
        $qry = "";

        $qry = "SELECT 
folio
,fecha_inicio
,hora_inicio
,us.usuario
,dependencias.nombre_dependencia
,us.extension
,us.correo
,titulo
,categoria_ticket.categoria
,ticket.categoria as id_categoria
,ticket.descripcion
,asignado.usuario as asignado
,est.id as situacion
,fecha_cierre
,hora_cierre
from ticket
LEFT JOIN  usuario us on us.codigo = ticket.usr_incidente
LEFT JOIN usuario asignado on asignado.codigo = ticket.usr_asignado
LEFT JOIN categoria_ticket on categoria_ticket.id_cat = ticket.categoria
LEFT JOIN situacion_ticket est on est.id = ticket.estatus
LEFT JOIN dependencias on  us.dependencia = dependencias.id_dependencia
WHERE ticket.folio = '$folio'";

return $this->db->query($qry)->row();
    }

    function asignar_usuario($folio, $ingeniero, $fecha, $hora, $estatus)
    {
        $this->db->set('usr_asignado', $ingeniero);
        $this->db->set('fecha_asignado', $fecha);
        $this->db->set('hora_asignado', $hora);
        $this->db->set('estatus', $estatus);
        $this->db->where('folio', $folio);
        $this->db->update('ticket');      

    }

    function cambiar_categoria($folio, $categoria)
    {
        $this->db->set('categoria', $categoria);
        $this->db->where('folio', $folio);
        $this->db->update('ticket');
    }

    //***********************TABLAS **********************

    function tabla_admon(){
        $qry = '';
        $qry = "SELECT 
                folio
                ,fecha_inicio
                ,hora_inicio
                ,us.usuario
                ,titulo
                ,categoria_ticket.categoria
                ,est.id as id_situacion
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
                ORDER BY folio DESC";

   return $this->db->query($qry)->result();
    }

    //******************************** FECHAS **********************************************/   
        
    function fecha_a_sql($date){
        $fecha = explode("/",$date);
        $fecha_sql = $fecha['2']."-".$fecha['0']."-".$fecha['1'];
        return $fecha_sql;
    }
    
    function fecha_a_form($date){
        $fecha = explode("-",$date);
        $fecha_sql = $fecha['1']."/".$fecha['2']."/".$fecha['0'];
        return $fecha_sql;
    }
    
    function fecha_actual(){
        date_default_timezone_get("America/Mexico_City");
        $fecha = date("Y-m-d");
        return $fecha;
    }
    
      function hora_actual(){
        date_default_timezone_set("America/Mexico_City");
        $hora = date("h:i:s");
        return $hora;
    }
    function fechahora_actual(){
        date_default_timezone_get("America/Mexico_City");
        $fecha = date("Y-m-d h:i:s");
        return $fecha;
    }
    
    function fecha_text($datetime)
    {
        if($datetime == "0000-00-00 00:00:00"){
            return "Fecha indefinida";
        }else{
            
        $dia = explode(" ",$datetime);
        $fecha = explode("-",$dia[0]);
            if($fecha[1] == 1){
                $mes = 'enero';
            }else if($fecha[1] == 2){
                $mes = 'febrero';
            }else if($fecha[1] == 3){
                $mes = 'marzo';
            }else if($fecha[1] == 4){
                $mes = 'abril';
            }else if($fecha[1] == 5){
                $mes = 'mayo';
            }else if($fecha[1] == 6){
                $mes = 'junio';
            }else if($fecha[1] == 7){
                $mes = 'julio';
            }else if($fecha[1] == 8){
                $mes = 'agosto';
            }else if($fecha[1] == 9){
                $mes = 'septiembre';
            }else if($fecha[1] == 10){
                $mes = 'octubre';
            }else if($fecha[1] == 11){
                $mes = 'noviembre';
            }else if($fecha[1] == 12){
                $mes = 'diciembre';
            }
            
            $hora = explode(":",$dia[1]);
            
            $time = $hora[0].":".$hora[1]." Hrs";
            
            $fecha2 = $fecha[2]." ".$mes." ".$fecha[0];
            return $fecha2." a las ".$time ;
        }
    }
    
    function fecha_text_f($datetime)
    {
        if($datetime == "0000-00-00"){
            return "Fecha indefinida";
        }else{
            
        $fecha = explode("-",$datetime);
            if($fecha[1] == 1){
                $mes = 'enero';
            }else if($fecha[1] == 2){
                $mes = 'febrero';
            }else if($fecha[1] == 3){
                $mes = 'marzo';
            }else if($fecha[1] == 4){
                $mes = 'abril';
            }else if($fecha[1] == 5){
                $mes = 'mayo';
            }else if($fecha[1] == 6){
                $mes = 'junio';
            }else if($fecha[1] == 7){
                $mes = 'julio';
            }else if($fecha[1] == 8){
                $mes = 'agosto';
            }else if($fecha[1] == 9){
                $mes = 'septiembre';
            }else if($fecha[1] == 10){
                $mes = 'octubre';
            }else if($fecha[1] == 11){
                $mes = 'noviembre';
            }else if($fecha[1] == 12){
                $mes = 'diciembre';
            }
            
            
            $fecha2 = $fecha[2]." ".$mes." ".$fecha[0];
            return $fecha2 ;
        }
    }
    
    function hora_fecha_text($dia)
    {
        $dia2 = explode(" ",$dia);
        
        if($dia2[0] == "0000-00-00"){
            $fecha2 = "Termino indefinido";
        }else{
            $fecha = explode("-",$dia2[0]);
            if($fecha[1] == 1){
                $mes = 'enero';
            }else if($fecha[1] == 2){
                $mes = 'febrero';
            }else if($fecha[1] == 3){
                $mes = 'marzo';
            }else if($fecha[1] == 4){
                $mes = 'abril';
            }else if($fecha[1] == 5){
                $mes = 'mayo';
            }else if($fecha[1] == 6){
                $mes = 'junio';
            }else if($fecha[1] == 7){
                $mes = 'julio';
            }else if($fecha[1] == 8){
                $mes = 'agosto';
            }else if($fecha[1] == 9){
                $mes = 'septiembre';
            }else if($fecha[1] == 10){
                $mes = 'octubre';
            }else if($fecha[1] == 11){
                $mes = 'noviembre';
            }else if($fecha[1] == 12){
                $mes = 'diciembre';
            }
            
            $fecha2 = $fecha[2]." de ".$mes." del ".$fecha[0];
        }
        return $fecha2;
    }

        function etiqueta($estatus)
    {
        if($estatus == 1){
            $esta = '<p align="center">
                        <small class="label label-primary">
                            <i class="fa fa-ticket"></i> Abierto
                        </small>
                    </p>';
            return $esta;
        }
        if($estatus == 2){
            $esta = '<p align="center">
                        <small class="label bg-maroon">
                            <i class="fa fa-user-plus"></i> Asigando
                        </small>
                    </p>';
            return $esta;
        }
          if($estatus == 3){
            $esta = '<p align="center">
                        <small class="label label-warning">
                            <i class="fa fa-spinner"></i> En Proceso
                        </small>
                    </p>';
            return $esta;
        }
          if($estatus == 4){
            $esta = '<p align="center">
                        <small class="label label-danger">
                            <i class="fa fa-check-circle"></i> Resuelto
                        </small>
                    </p>';
            return $esta;
        }
            if($estatus == 5){
            $esta = '<p align="center">
                        <small class="label label-success">
                            <i class="fa fa-lock"></i> Resuelto
                        </small>
                    </p>';
            return $esta;
        }
           if($estatus == 6){
            $esta = '<p align="center">
                        <small class="label bg-black">
                            <i class="fa  fa-hourglass-2"></i> Pendiente
                        </small>
                    </p>';
            return $esta;
        }
           if($estatus == 7){
            $esta = '<p align="center">
                        <small class="label bg-orange">
                            <i class="fa  fa-random"></i> Reasignado
                        </small>
                    </p>';
            return $esta;
        }
    }

    function asignados($id)
    {
        if ($id == '') {
            $asig = '<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Asignar</button>';
        }
        else{
            $asig = '<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#myModal" title="Reasignar Ingeniero"><i class="fa fa-exchange "></i> </button>';
        }
        
        return $asig;
    }

}