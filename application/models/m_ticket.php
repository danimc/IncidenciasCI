<?php 

class m_ticket extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obt_lista_usuarios(){
// modificar consulta para que solo se obtengan los datons necesarios
     return $this->db->get("usuario")->result();   
    }

    function obt_categorias(){
     return $this->db->get("categoria_ticket")->result();   

    }

    function obt_asignados(){

        $this->db->where("rol", 1);
        return $this->db->get("usuario")->result();
    }

    function estatus()
    {
        $this->db->where('id !=', 2);
        $this->db->where('id !=', 5);
        $this->db->where('id !=', 7);
        return $this->db->get("situacion_ticket")->result();
    }

    function nuevo_incidente($ticket)
    {
        $this->db->insert("ticket", $ticket);
    }

    function seguimiento_ticket($folio)
    {
        $qry = "";

        $qry = "SELECT 
                folio
                ,fecha_inicio
                ,hora_inicio
                ,us.usuario
                ,us.nombre
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

    function obt_seguimiento($folio)
    {
   $qry = "SELECT 
        h_ticket.id
        ,cat.categoria
        ,situ.situacion
        ,usuario.usuario
        ,asignado.usuario asignado
        ,mensaje
        ,fecha
        ,hora
        ,h_ticket.img
        FROM h_ticket
        LEFT JOIN categoria_ticket cat ON cat.id_cat = h_ticket.categoria
        LEFT JOIN situacion_ticket situ ON situ.id = h_ticket.estatus
        LEFT JOIN usuario ON usuario.codigo = h_ticket.usr
        LEFT JOIN usuario asignado ON asignado.codigo = h_ticket.asignado
        WHERE folio = '$folio'";

        return $this->db->query($qry)->result();
    }

      function obtAdjunto($folio)
    {
        $this->db->where('id_ticket', $folio);
        $this->db->where('tipo', 3);

        return $this->db->get('Tb_Adjuntos')->result();
    }

        function obt_imagenesChat($folio)
    {
        $this->db->where('img !=', '');
        $this->db->where('folio', $folio);

        return $this->db->get('h_ticket')->num_rows();
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

    function cambiar_estatus($folio, $estatus)
    {
        $this->db->set('estatus', $estatus);
        $this->db->where('folio', $folio);
        $this->db->update('ticket');
    }

    function cerrar_ticket($folio, $fecha, $hora)
    {
        $this->db->set('estatus', 5);
        $this->db->set('fecha_cierre', $fecha);
        $this->db->set('hora_cierre', $hora);
        $this->db->where('folio', $folio);
        $this->db->update('ticket');
    }

    function h_asignar_usuario($folio, $ingeniero, $fecha, $hora, $estatus)
    {
        $this->folio = $folio;
        $this->usr = $this->session->userdata("codigo");
        $this->estatus = $estatus;
        $this->asignado = $ingeniero;
        $this->fecha = $fecha;
        $this->hora = $hora;

        $this->db->insert('h_ticket', $this);
    }

    function subir_pdf($nuevoPdf)
    {
        $this->db->insert('Tb_Adjuntos', $nuevoPdf); 
    }

    function h_cambiar_categoria($folio, $categoria, $fecha, $hora)
    {
        $this->folio = $folio;
        $this->usr = $this->session->userdata("codigo");
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->categoria = $categoria;

        $this->db->insert('h_ticket', $this);
    }

    function h_cambiar_estatus($folio, $estatus, $fecha, $hora)
    {
        $this->folio = $folio;
        $this->usr = $this->session->userdata("codigo");
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->estatus = $estatus;

        $this->db->insert('h_ticket', $this);
    }

    function h_cerrar_ticket($folio, $usr, $fecha, $hora)
    {
        $this->folio = $folio;
        $this->usr = $usr;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->estatus = 5;

        $this->db->insert('h_ticket', $this);
    }

    function notificacion()
    {
        
    }

    function mensaje($folio, $mensaje, $fecha, $hora, $nImg)
    {
        $this->folio = $folio;
        $this->usr = $this->session->userdata("codigo");
        $this->mensaje = $mensaje;
        $this->fecha = $fecha;
        $this->hora =  $hora;
        $this->img = $nImg;

        $this->db->insert('h_ticket', $this);
    }

   /* function noti_alta($reportante, $usuarioIncidente, $idIncidente, $notificacion)
    {
        $this->generador = $reportante;
        $this->ticket = $idIncidente;
        $this->receptor = $usuarioIncidente;
        $this->tipo = $notificacion;
        $this->vistoR = 1;

        $this->db->insert('crm.notificaciones', $this);

    }*/

    //***********************TABLAS **********************

    function lista_tickets_administrador()
    {
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

        function lista_tickets_administrador_cerrados()
    {
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
                WHERE est.id = 5
                ORDER BY folio DESC";
               
                return $this->db->query($qry)->result();
    }

            function lista_tickets_administrador_abiertos()
    {
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
                ,prioridad
                ,asignado.usuario usr_asignado
                ,ticket.estatus
                from ticket
                LEFT JOIN  usuario us on us.codigo = ticket.usr_incidente
                LEFT JOIN categoria_ticket on categoria_ticket.id_cat = ticket.categoria
                LEFT JOIN situacion_ticket est on est.id = ticket.estatus
                LEFT JOIN usuario asignado on ticket.usr_asignado = asignado.codigo
                WHERE est.id != 5
                ORDER BY folio DESC";
               
                return $this->db->query($qry)->result();
    }

    function lista_tickets_usuario($codigo)
    {
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
                WHERE usr_incidente = '$codigo'
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
        date_default_timezone_set("America/Mexico_City");
        $fecha = date("Y-m-d");
        return $fecha;
    }
    
      function hora_actual(){
        date_default_timezone_set("America/Mexico_City");
        $hora = date("H:i:s");
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
            $esta = ' <span data-toggle="modal" data-target="#modalStatus" class="btn badge btn-primary badge-pill mb-2"><i class="fa fa-ticket"></i> Abierto</span>';
            return $esta;
        }
        if($estatus == 2){
            $esta = ' <span data-toggle="modal" data-target="#modalStatus" class="btn badge btn-pink badge-pill mb-2"><i class="fa fa-user-plus"></i> Asignado</span>';
            return $esta;
        }
          if($estatus == 3){
            $esta = ' <span data-toggle="modal" data-target="#modalStatus" class="btn badge btn-info badge-pill mb-2"><i class="fa fa-spinner"></i> En Proceso</span>';
            return $esta;
        }
          if($estatus == 4){
            $esta = ' <span data-toggle="modal" data-target="#modalStatus" class="btn badge btn-success badge-pill mb-2"><i class="fa fa-check-circle"></i> Resuelto</span>';
            return $esta;
        }
            if($estatus == 5){
            $esta = ' <span data-toggle="modal" data-target="#modalStatus" class="btn badge btn-danger badge-pill mb-2"><i class="fa fa-lock"></i> Cerrado</span>';
            return $esta;
        }
           if($estatus == 6){
            $esta = ' <span data-toggle="modal" data-target="#modalStatus" class="btn badge btn-secondary badge-pill mb-2"><i class="fa  fa-hourglass-2" ></i> Pendiente</span>';
            return $esta;
        }
           if($estatus == 7){
            $esta = ' <span data-toggle="modal" data-target="#modalStatus" class="btn badge btn-warning badge-pill mb-2"><i class="fa  fa-random"></i> Reasignado</span>';
            return $esta;
        }
    }

     function ext($ext)
    {
        if ($ext == "pdf" OR $ext == "PDF") {
            $src = '<img width="" src="src/img/pdf.png">';
            return $src;
        }
        if ($ext == "jpg" OR $ext == "JPG") {
            $src = '<img width="" src="src/img/jpg.png">';
            return $src;
        }
        if ($ext == "doc" OR $ext == "DOC" OR $ext == "docx" OR $ext == "DOCX") {
            $src = '<img width="" src="src/img/doc.png">';
            return $src;
        }
        if ($ext == "xls" OR $ext == "XLS" OR $ext == "xlsx" OR $ext == "XLSX") {
            $src = '<img width="" src="src/img/xls.png">';
            return $src;
        }
        if ($ext == 'ppt'OR $ext == "PPT" OR $ext == 'pptx' or $ext == "PPTX") {
           $src = '<img width="" src="src/img/ppt.png">';
            return $src; 
        }


    }

    function asignados($id)
    {
        if ($id == '') {
            $asig = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Asignar</button>';
        }
        else{
            $asig = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal" title="Reasignar Ingeniero"><i class="fa fa-exchange "></i> </button>';
        }
        
        return $asig;
    }

      function timeline($mensaje, $fecha)
    {
        if ($fecha != 1) {
            $fecha = $this->m_ticket->hora_fecha_text($mensaje->fecha); ?>
            
            <li class="time-label">
                <span class="bg-red">
                    <?=$fecha?>
                </span>
            </li> <?   
        }
        else{} 
        if (isset($mensaje->categoria)) { ?>
            <li>
                <i class="fa fa-tags bg-orange"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?=$mensaje->hora?></span>
                    <h3 class="timeline-header"><a href="#">Cambio de Categoria:</a> <b> <?=$mensaje->usuario?></b> Cambio la categoria a <b><?=$mensaje->categoria?> </b>
                </div>
            </li> <?
        }

        if (isset($mensaje->situacion)) {
            if (isset($mensaje->asignado)) {
                if ($mensaje->situacion != 'Resuelto') { ?>
                    <li>
                        <i class="fa fa-user bg-pink"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o">    </i> <?=$mensaje->hora?></span>
                            <h3 class="timeline-header"><a href="#">El ticket ha sido Asignado a: <?=$mensaje->asignado?> </a></h3>          
                        </div>
                    </li><?
                }
            }
            if ($mensaje->situacion == 'Cerrado') { ?>
                <li>
                    <i class="fa fa-lock bg-red"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> <?=$mensaje->hora?></span>
                        <h3 class="timeline-header"><a href="#"></a> <b> <?=$mensaje->usuario?></b> Cerró el ticket<b>mensaje: </b> </h3>
                        <div class="timeline-body bg-gray ">
                            <?=$mensaje->mensaje?>                
                        </div>
                    </div>
                </li> <?
            }
            if ($mensaje->situacion == 'Canalizado') { ?>
                <li>
                    <i class="fa fa-map-signs bg-green"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> <?=$mensaje->hora?></span>
                        <h3 class="timeline-header"><a href="#"></a> <b> <?=$mensaje->usuario?></b> Canalizo el incidente a <b> <?=$mensaje->nombre_canal?> </b> </h3>
                        <div class="timeline-body bg-gray ">
                            <?=$mensaje->mensaje?>                
                        </div>
                    </div>
                </li> <?
            }
            if ($mensaje->situacion == 'Resuelto') { ?>
                    <li>
                        <i class="fa fa-check-circle bg-success"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?=$mensaje->hora?></span>
                            <h3 class="timeline-header"><a href="#">Cambio de Estatus</a> <b> <?=$mensaje->usuario?></b> Cambio es estatus del incidente a <b> <?=$mensaje->situacion?> </b> </h3>
                        </div>
                    </li> <?
                }
            if ($mensaje->situacion == 'En Proceso') { ?>
                    <li>
                        <i class="fa fa-spinner bg-info"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?=$mensaje->hora?></span>
                            <h3 class="timeline-header"><a href="#">Cambio de Estatus</a> <b> <?=$mensaje->usuario?></b> Cambio es estatus del incidente a <b> <?=$mensaje->situacion?> </b> </h3>
                        </div>
                    </li> <?
                }
            if ($mensaje->situacion == 'Pendiente') { ?>
                    <li>
                        <i class="fa fa-hourglass-2 bg-grey"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?=$mensaje->hora?></span>
                            <h3 class="timeline-header"><a href="#"></a> <b> <?=$mensaje->usuario?></b> marcó <b> <?=$mensaje->situacion?> </b> el servicio </h3>
                        </div>
                    </li> <?
                }
            if ($mensaje->situacion == 'Cancelado') { ?>
                    <li>
                        <i class="fa fa-close bg-red"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?=$mensaje->hora?></span>
                            <h3 class="timeline-header"><a href="#"></a> <b> <?=$mensaje->usuario?></b> <b>Canceló </b> el servicio </h3>
                        </div>
                    </li> <?
                }
            else {

            }
        }
        else {
            if (isset($mensaje->mensaje)) { ?>
                <li>
                    <i class="fa fa-comment bg-purple"></i>
                    <div class="timeline-item bg-default ">
                        <span class="time"><i class="fa fa-clock-o"></i> <?=$mensaje->hora?></span>
                        <h3 class="timeline-header btn-default"><a href="">Mensaje:</a> <b> <?=$mensaje->usuario?></b> Dice: </h3>
                        <div class="timeline-body bg-gray ">
                            <? if($mensaje->img != '') {
                                    $ext = explode('.',$mensaje->img);
                                    $ext = $ext[count($ext) - 1];
                                    if(strtolower($ext) != 'jpg' AND strtolower($ext) != 'png' AND strtolower($ext) != 'jpeg') {
                                        $loguito = $this->m_ticket->ext($ext); 
                                    ?> <b>Archivos Adjuntos:</b>  <a target="_blank" href="src/att/<?=$mensaje->img?>" data-toggle="tooltip" title="ver archivo"><?=$loguito?></a><hr>
                                <?  } else{ 
                                      ?>
                                    <a target="_blank" href="src/att/<?=$mensaje->img?>" data-toggle="tooltip" title="ver imagen">
                                     <img width="200px" src="src/att/<?=$mensaje->img?>"></a> <hr> 
                                    <?}
                                 }?>
                            <?=$mensaje->mensaje?>                
                        </div>
                    </div>
                </li> <?
            }
        }
    }

      public function SendTelegram($ticket, $idIncidente)
    {
        //Roland IA
        $apiToken = "867232459:AAGRKQwjqdeXFENj_b0okBwI9-ai1WeMGqY";
        $horario = $this->m_ticket->hora_actual();
        $fechaHora = $ticket['fecha_inicio']. ' ' . $ticket['hora_inicio'];
        $fecha = $this->m_ticket->fecha_text($fechaHora);
        $escribiente = $this->session->userdata("usuario");
        $prioridad = '';

        if ($ticket['prioridad'] == 4) {
            $prioridad = "<b> SE PRECISA URGENTE! </b>";
        }
        if ($ticket['prioridad'] == 3) {
            $prioridad = "<b> DE IMPORTANCIA ALTA! </b>";
        }

        $saludo = '';
        if($horario <= '11:59:59'){
            $saludo = 'Buenos días.';
        }
        elseif ($horario <= '19:59:59') {
            $saludo = 'Buenas tardes.';
        }
        elseif ($horario <= '23:59:59') {
            $saludo = 'Buenas noches.';
        }
        $mensaje = $saludo .'
Se ha levantado un nuevo servicio con la siguiente información:

<b>FOLIO:</b> ' . $idIncidente . '
<b>ASUNTO:</b> ' . $ticket['titulo'] . '
<b>DESCRIPCION:</b> ' . strip_tags($ticket['descripcion']) . '
<b>FECHA DE REPORTE: </b>' . $fecha .'
<b>CAPTURADO POR: </b>' . $escribiente .'

'. $prioridad .'

Se Agradece su atención.';
        $data = [
            'chat_id' => '-373978603',  
            //'chat_id' => '591531437_6135385119973428661',
            'text' => $mensaje,
            'parse_mode' => 'HTML'
        ];
        $response = file_get_contents("https://api.telegram.org/bot".$apiToken."/sendMessage?" . http_build_query($data) );
    }

          public function SendTelegram1()
    {
        $clima = json_decode(file_get_contents("https://api.openweathermap.org/data/2.5/weather?id=8133378&APPID=731ac0d3caf3cd694ce7a8df5d1c278b&units=metric&lang=es"));

        //$clima = json_decode($respuesta);
        $datosClima = $clima->main; 
        $datosGen   = $clima->weather;
        $temperatura = $datosClima->temp;
       // $descripcion    = $datosGen->description;

        $despertador = "Buen dia compañero.
        La temperatura al momento es de ".$temperatura . "° C.";





        //Roland IA
        $apiToken = "867232459:AAGRKQwjqdeXFENj_b0okBwI9-ai1WeMGqY";
        
      
        $mensaje = $despertador;
        $data = [
            'chat_id' => '913700',  
            //'chat_id' => '591531437_6135385119973428661',
            'text' => $mensaje,
            'parse_mode' => 'HTML'
        ];
        $response = file_get_contents("https://api.telegram.org/bot".$apiToken."/sendMessage?" . http_build_query($data) );
    }

    public function sendTelegram_asignado($tg, $folio) //-----//
    {

        //Roland IA
        $apiToken = "867232459:AAGRKQwjqdeXFENj_b0okBwI9-ai1WeMGqY";
        $horario = $this->m_ticket->hora_actual();    
        $id_tg = $tg->tg_user;  
        $ticket = $this->m_ticket->seguimiento_ticket($folio);
        $saludo = '';
        if($horario <= '11:59:59'){
            $saludo = 'Buenos días.';
        }
        elseif ($horario <= '19:59:59') {
            $saludo = 'Buenas tardes.';
        }
        elseif ($horario <= '23:59:59') {
            $saludo = 'Buenas noches.';
        }

        $mensaje = $saludo .'
Se te ha asignado el ticket de servicio <b> #' . $folio . ' </b>:
    
<b>SOLICITA: </b>' . $ticket->usuario .'
<b>ÁREA: </b> '. $ticket->nombre_dependencia .'
<b>EXTENSIÓN: </b>' .$ticket->extension .'

-------------------------------
Datos de Servicio:

<b>ASUNTO: </b> '. $ticket->titulo . '
<b>DESCRIPCIÓN: </b> '.  strip_tags($ticket->descripcion) .' 

Saludos :)';


        $data = [
            'chat_id' => $id_tg,  
            //'chat_id' => '591531437_6135385119973428661',
            'text' => $mensaje,
            'parse_mode' => 'HTML'
        ];

        $response = file_get_contents("https://api.telegram.org/bot".$apiToken."/sendMessage?" . http_build_query($data) );
    }

}