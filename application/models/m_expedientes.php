<?php 

class m_expedientes extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obt_expedientes_usr($dependencia)
    {
    	$qry = '';

    	$qry = "SELECT 
				am.id
				,usr.usuario
				,caja
				,etiqueta
				,expediente
				,ubi.nombre as ubicacion
				,e.usuario as entregado
				,am.estatus
				,fecha_solicitud
				FROM crm.am_expedientes_solicitados am
				LEFT JOIN usuario usr ON usr.codigo = am.solicitante
				LEFT JOIN usuario e ON e.codigo = am.entregado_a
				LEFT JOIN am_ubicacion ubi ON ubi.id = am.ubicacion
				WHERE am.dependencia = '$dependencia'";
    	
    	return $this->db->query($qry)->result();
    }

    function obt_expedientes_oficialia()
    {
    	$qry = '';

    	$qry =	"SELECT 
				 am.id
				,usr.usuario
                ,dependencias.nombre_dependencia
                ,dependencias.id_dependencia
                ,dependencias.abreviatura
				,caja
				,etiqueta
				,expediente
				,ubi.nombre as ubicacion
				,e.usuario as entregado
				,am.estatus
				,fecha_solicitud
				FROM crm.am_expedientes_solicitados am
				LEFT JOIN usuario usr ON usr.codigo = am.solicitante
				LEFT JOIN usuario e ON e.codigo = am.entregado_a
				LEFT JOIN am_ubicacion ubi ON ubi.id = am.ubicacion
                LEFT JOIN dependencias ON dependencias.id_dependencia = am.dependencia";

                return $this->db->query($qry)->result();
    }

    function obt_ubicaciones()
    {
    	return $this->db->get("am_ubicacion")->result();
    }

    function realizar_solicitud($caja, $etiqueta, $ubicacion, $expediente, $notas, $usuario, $dependencia, $fecha, $estatus)
    {
    	$this->caja = $caja;
    	$this->etiqueta = $etiqueta;
    	$this->ubicacion = $ubicacion;
    	$this->expediente = $expediente;
    	$this->notas = $notas;
    	$this->solicitante = $usuario;
    	$this->dependencia = $dependencia;
    	$this->fecha_solicitud = $fecha;
    	$this->estatus = $estatus;

    	$this->db->insert('am_expedientes_solicitados', $this);
    }

    function obt_seguimiento_exp($expediente)
    {
        $qry = '';

        $qry = "SELECT 
                 am.id
                ,usr.usuario
                ,usr.extension
                ,usr.correo
                ,dependencias.nombre_dependencia
                ,dependencias.id_dependencia
                ,dependencias.abreviatura
                ,caja
                ,etiqueta
                ,expediente
                ,ubi.nombre as ubicacion
                ,e.usuario as entregado
                ,am.estatus
                ,asig.usuario as asignado
                ,am.notas
                ,fecha_solicitud
                FROM crm.am_expedientes_solicitados am
                LEFT JOIN usuario usr ON usr.codigo = am.solicitante
                LEFT JOIN usuario asig ON asig.codigo = am.asignado
                LEFT JOIN usuario e ON e.codigo = am.entregado_a
                LEFT JOIN am_ubicacion ubi ON ubi.id = am.ubicacion
                LEFT JOIN dependencias ON dependencias.id_dependencia = am.dependencia
                WHERE am.id = '$expediente'";

        return $this->db->query($qry)->row();

    }

    function obt_historial($expediente)
    {
        $qry = '';

        $qry = "SELECT 
        h.id
        ,situ.situacion
        ,usuario.usuario
        ,asignado.usuario asignado
        ,fecha
        ,hora
        FROM am_h_expediente h
        LEFT JOIN situacion_ticket situ ON situ.id = h.estatus
        LEFT JOIN usuario ON usuario.codigo = h.usr
        LEFT JOIN usuario asignado ON asignado.codigo = h.asignado
        WHERE expediente = '$expediente'";

        return $this->db->query($qry)->result();
    }

     function obt_asignados(){

        $this->db->where("rol", 4);
        return $this->db->get("usuario")->result();
    }

    function obt_usuarios_dependencia($dependencia)
    {
        $this->db->where('dependencia', $dependencia);
        return $this->db->get('usuario')->result();
    }

    function asignar_usuario($folio, $responsable, $estatus)
    {
        $this->db->set('asignado', $responsable);
        $this->db->set('estatus', $estatus);
        $this->db->where('id', $folio);
        $this->db->update('am_expedientes_solicitados');
    }

     function h_asignar_usuario($folio, $responsable, $fecha, $hora, $estatus)
    {
        $this->expediente = $folio;
        $this->usr = $this->session->userdata("codigo");
        $this->estatus = $estatus;
        $this->asignado = $responsable;
        $this->fecha = $fecha;
        $this->hora = $hora;

        $this->db->insert('am_h_expediente', $this);
    }

    function timeline($mensaje)
    {
        $contadorfecha = 0;
        if ($contadorfecha != $mensaje->fecha)
            {
                $fecha = $this->m_ticket->hora_fecha_text($mensaje->fecha);
              ?>
                    <li class="time-label">
                    <span class="bg-red">
                    <?=$fecha?>
                    </span>
                    </li>
<?   
        
            }
            else{
               
            
            } 
    if (isset($mensaje->mensaje)){
?>
    <li>
        <i class="fa fa-comment bg-purple"></i>
        <div class="timeline-item bg-default ">
            <span class="time"><i class="fa fa-clock-o"></i> <?=$mensaje->hora?></span>
            <h3 class="timeline-header btn-default"><a href="">Mensaje:</a> <b> <?=$mensaje->usuario?></b> Dice: </h3>
            <div class="timeline-body bg-gray ">
                <?=$mensaje->mensaje?>                
            </div>
        </div>
    </li>
        <?}

        if (isset($mensaje->situacion)) {
            if (isset($mensaje->asignado)) {
?>
        <li>
            <i class="fa fa-user bg-blue"></i>
            <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o">    </i> <?=$mensaje->hora?></span>
            <h3 class="timeline-header"><a href="#">La solicitud sera atendida por: <?=$mensaje->asignado?> </a></h3>          
            </div>
        </li>
           <? }
           else{
?>
        <li>
        <!-- timeline icon -->
        <i class="fa fa-info-circle bg-green"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> <?=$mensaje->hora?></span>

            <h3 class="timeline-header"><a href="#">Cambio de Estatus</a> <b> <?=$mensaje->usuario?></b> Cambio es estatus del incidente a <b> <?=$mensaje->situacion?> </b> </h3>
        </div>
    </li>
    <?      }
        }
    }

    function etiqueta_dependencia($dependencia)
    {
        $etiqueta=''; 

    	if($dependencia == 3){
    		$etiqueta = 'bg-white';                		
    	}
        if($dependencia == 4){
            $etiqueta = 'bg-maroon';
        }
        if($dependencia == 5){
            $etiqueta = 'bg-orange';
        }        
        if($dependencia == 9){
            $etiqueta = 'bg-purple disabled color-palette';
        }
        if($dependencia == 11){
            $etiqueta = 'bg-green disabled color-palette'; //buscando verde Limon 
        }

        return $etiqueta;
    }


        function etiqueta($estatus)
    {
        if($estatus == 1){
            $esta = '<button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal" title="Cambiar Status"> <i class="fa fa-ticket"></i> Solicitado
                        </button>';
            return $esta;
        }
        if($estatus == 2){
            $esta = '<button class="btn btn-xs bg-maroon" data-toggle="modal" data-target="#modalRecibido" title="Cambiar Status">
                            <i class="fa fa-user-plus"></i> Asigando
                      </button>';
            return $esta;
        }
          if($estatus == 3){
            $esta = '<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalStatus" title="Cambiar Status"> <i class="fa fa-spinner"></i> Entregado
                        </button>';
            return $esta;
        }
          if($estatus == 4){
            $esta = '<button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalStatus" title="Cambiar Status"> 
                            <i class="fa fa-check-circle"></i> Devuelto
                        </small>
                    </p>';
            return $esta;
        }
            if($estatus == 5){
            $esta = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalStatus" title="Cambiar Status">
                <i class="fa fa-lock"></i> Finalizado
                </button>';
            return $esta;
        }       
    }

}
