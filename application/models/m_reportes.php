<?php 

class m_reportes extends CI_Model {

    function __construct()
    {
        parent::__construct(); 
    }

     function exportar_tickets_general()
    {
        $qry = '';

        $qry = "SELECT 
                distinct folio              
                ,fecha_inicio as fecha_reporte
                ,hora_inicio as hora_reporte
                ,nombre_usr as solicitante
                ,dep.nombre_dependencia as departamento
                ,titulo as servicio
                ,Tb_CatTipoCategoria.nombre_tipoCat as categoria
                ,m.forma as forma_reporte   
                ,est.situacion as estatus
                ,fecha_asignado
                ,hora_asignado
                ,prioridad
                ,asignado.usuario as asignado
                ,f.oficio
                ,f.foliador
                ,fecha_cierre
                ,hora_cierre
                ,c.nombrePuesto as canal_atencion              
                from ticket
                LEFT JOIN  dependencias dep on dep.id_dependencia = ticket.departamento
                LEFT JOIN Tb_CatTipoCategoria on Tb_CatTipoCategoria.id_tipoCat = ticket.categoria
                LEFT JOIN  usuario us on us.codigo = ticket.usr_incidente
                LEFT JOIN situacion_ticket est on est.id = ticket.estatus
                LEFT JOIN usuario asignado on ticket.usr_asignado = asignado.codigo
                LEFT JOIN Tb_Oficios_HelpDesk f on f.id_ticket = folio 
                LEFT JOIN tb_Cat_FormaReporte m ON m.id = ticket.tSolicitud
                LEFT JOIN tb_Cat_puestos c ON c.id_puesto = ticket.canal_atencion 
                ORDER BY folio DESC";

            return $this->db->query($qry)->result();
    }

    function reporte_tickets_years()
    {
        $qry = "";

        $qry = "SELECT year(fecha_inicio) as year,
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 1 THEN 1 ELSE 0 END) AS '1',
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 2 THEN 1 ELSE 0 END) AS '2',
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 3 THEN 1 ELSE 0 END) AS '3',
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 4 THEN 1 ELSE 0 END) AS '4',
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 5 THEN 1 ELSE 0 END) AS '5',
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 6 THEN 1 ELSE 0 END) AS '6',
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 7 THEN 1 ELSE 0 END) AS '7',
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 8 THEN 1 ELSE 0 END) AS '8',
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 9 THEN 1 ELSE 0 END) AS '9', 
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 10 THEN 1 ELSE 0 END) AS '10',
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 11 THEN 1 ELSE 0 END) AS '11',
                    SUM(CASE WHEN MONTH(ticket.fecha_inicio) = 12 THEN 1 ELSE 0 END) AS '12'
                    FROM ticket
                    WHERE ticket.fecha_inicio BETWEEN '2018-01-01' AND '2021-12-31'
                    GROUP BY year
                    ORDER BY year DESC";

        return $this->db->query($qry)->result();
    }

    function reporte_asignados_areas()
    {
        $qry = '';

        $qry = "SELECT 
                p.categoria as canal,
                count(folio) as cuenta
                FROM ticket
                LEFT JOIN categoria_ticket p ON p.id_cat = ticket.categoria
                WHERE ticket.categoria != 0
                GROUP BY p.categoria
                ORDER BY cuenta DESC
                LIMIT 4";

        $result = $this->db->query($qry)->result();

        $array = array();
        foreach ($result as $r) {
            $array[] = $r->cuenta;
           
        }

        return json_encode($array); 
    }

    function reporte_asignados_areas_filtro($mes)
    {
        $qry = '';

        $qry = "SELECT
                p.categoria as canal,
                count(folio) as cuenta
                FROM ticket
                LEFT JOIN categoria_ticket p ON p.id_cat = ticket.categoria
                where month(fecha_inicio) = 9
                GROUP BY p.categoria
                ORDER BY cuenta DESC
                LIMIT 4";

        $result = $this->db->query($qry)->result();

        $array = array();
        foreach ($result as $r) {
            $array['canal'] = $r->canal;
            $array['cuenta'] = $r->cuenta;
        }

        return json_encode($array); 
    }

    function tickets_por_dia()
    {
        $qry = "";
        $qry1 = "SET lc_time_names = 'es_ES'";

        $qry .= "SELECT 
                weekday(fecha_inicio) as numero,
                dayname(fecha_inicio) as dia,
                count(dayname(fecha_inicio)) as contador
                FROM crm.ticket
                group by numero";

        $this->db->query($qry1);

        $result = $this->db->query($qry)->result();
        $array = array();
        $i = 0;
        foreach ($result as $r) {
            $direccion[] = $r->contador;
          
            $etiquetas[] = $r->dia;
        }
        $array['etiquetas'] = $etiquetas;
        $array['direccion'] = $direccion;
       
        return json_encode($array); 
    }

        function tickets_por_dia_filtro($mes)
    {
        $qry = "";
        $qry1 = "SET lc_time_names = 'es_ES'";

        $qry .= "SELECT 
                weekday(fecha_inicio) as numero,
                dayname(fecha_inicio) as dia,
                count(dayname(fecha_inicio)) as contador
                
                 FROM crm.ticket
                 where month(fecha_inicio) = '$mes'
                 group by NUMERO";

        $this->db->query($qry1);

        $result = $this->db->query($qry)->result();
        $array = array();
        $i = 0;
        foreach ($result as $r) {
            $direccion[] = $r->Direccion;
            $desarrollo[] = $r->Desarrollo;
            $cot[] = $r->COT;
            $soporte[] = $r->Soporte; 
            $etiquetas[] = $r->dia;
        }
        $array['etiquetas'] = $etiquetas;
        $array['direccion'] = $direccion;
        $array['desarrollo'] = $desarrollo;
        $array['cot'] = $cot;
        $array['soporte'] = $soporte; 
        return json_encode($array); 
    }

    function tickets_cerrados_por_dia()
    {
        $qry = "";
        $qry1 = "SET lc_time_names = 'es_ES'";

        $qry = "SELECT 
                weekday(fecha_inicio) as numero,
                dayname(fecha_inicio) as d,
                count(dayname(fecha_cierre)) as dia_cierre
                FROM crm.ticket
                where estatus = 5
                group by NUMERO";

        $this->db->query($qry1);

        $result = $this->db->query($qry)->result();
        $array = array();
        $i = 0;
        foreach ($result as $r) {
            $etiquetas[] = $r->d;
            $direccion[] = $r->dia_cierre;
           
        }
        $array['etiquetas'] = $etiquetas;
        $array['direccion'] = $direccion;
      
        return json_encode($array); 

    }

     function tickets_cerrados_por_dia_filtro($mes)
    {
        $qry = "";
        $qry1 = "SET lc_time_names = 'es_ES'";

        $qry = "SELECT 
                weekday(fecha_inicio) as numero,
                dayname(fecha_inicio) as d,
                count(dayname(fecha_cierre)) as dia_cierre,
                ( SELECT    
                    count(dayname(t.fecha_cierre)) 
                    FROM ticket t
                    WHERE t.canal_atencion = 1
                    and month(fecha_inicio) = '$mes'
                    and weekday(t.fecha_cierre) = numero) as Direccion,
                ( SELECT    
                    count(dayname(t.fecha_cierre)) 
                    FROM ticket t
                    WHERE t.canal_atencion = 2
                    and month(fecha_inicio) = '$mes'
                    and weekday(t.fecha_cierre) = numero) as Desarrollo,
                ( SELECT    
                    count(dayname(t.fecha_cierre)) 
                    FROM ticket t
                    WHERE t.canal_atencion = 3
                    and month(fecha_inicio) = '$mes'
                    and weekday(t.fecha_cierre) = numero) as COT,
                ( SELECT    
                    count(dayname(t.fecha_cierre)) 
                    FROM ticket t
                    WHERE t.canal_atencion = 4
                    and month(fecha_inicio) = '$mes'
                    and weekday(t.fecha_cierre) = numero) as Soporte
                 FROM crm.ticket
                 where estatus = 5
                 and month(fecha_inicio) = '$mes'
                 group by NUMERO";

        $this->db->query($qry1);

        $result = $this->db->query($qry)->result();
        $array = array();
        $i = 0;
        foreach ($result as $r) {
            $etiquetas[] = $r->d;
            $direccion[] = $r->Direccion;
            $desarrollo[] = $r->Desarrollo;
            $cot[] = $r->COT;
            $soporte[] = $r->Soporte; 
        }
        $array['etiquetas'] = $etiquetas;
        $array['direccion'] = $direccion;
        $array['desarrollo'] = $desarrollo;
        $array['cot'] = $cot;
        $array['soporte'] = $soporte; 
        return json_encode($array); 

    }

    function reporte_servicios_resueltos_usuarios()
    {
        $qry = "";

        $qry = "SELECT
                usr.codigo,
                usr.nombre_completo,                
                count(distinct t.folio) as cuenta,
                if(usr.foto != '' , usr.foto, 'team.png') as img
                from ticket t
                INNER JOIN situacion_ticket s
                left join h_ticket h ON h.estatus = s.id
                left join usuario usr ON usr.codigo = h.asignado 
               
                where usr > 1
                and h.folio = t.folio
                AND h.estatus = 4
                group by usr.nombre_completo
                order by cuenta desc";

        return $this->db->query($qry)->result();
    }

        function reporte_servicios_resueltos_usuarios_filtro($mes)
    {
        $qry = "";

        $qry = "SELECT
                usr.codigo,
                usr.nombre_completo,
                p.nombrePuesto as canal,
                count(distinct t.folio) as cuenta,
                if(usr.foto != '' , usr.foto, 'team.png') as img
                from ticket t
                INNER JOIN situacion_ticket s
                left join h_ticket h ON h.estatus = s.id
                left join usuario usr ON usr.codigo = h.asignado 
                LEFT JOIN tb_Cat_puestos p ON p.id_puesto = usr.puesto
                where usr > 1
                and h.folio = t.folio
                AND h.estatus = 4
                AND month(h.fecha) = '$mes'
                group by usr.nombre_completo
                order by cuenta desc";

        return $this->db->query($qry)->result();
    }

    function mes_filtro($mes)
    {
        $fecha = $mes;
        if($fecha == 1){
            $mes = 'enero';
        }else if($fecha == 2){
            $mes = 'febrero';
        }else if($fecha == 3){
            $mes = 'marzo';
        }else if($fecha == 4){
            $mes = 'abril';
        }else if($fecha == 5){
            $mes = 'mayo';
        }else if($fecha == 6){
            $mes = 'junio';
        }else if($fecha == 7){
            $mes = 'julio';
        }else if($fecha == 8){
            $mes = 'agosto';
        }else if($fecha == 9){
            $mes = 'septiembre';
        }else if($fecha == 10){
            $mes = 'octubre';
        }else if($fecha == 11){
            $mes = 'noviembre';
        }else if($fecha == 12){
            $mes = 'diciembre';
        }

        return $mes;
    }

}
?>