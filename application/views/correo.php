<?
$dia = $this->m_ticket->fecha_text($fechaReporte);
?>
<h2>REGISTRO DEl INCIDENTE FOLIO: <?=$idIncidente?></h2>

<p><?=$saludo?> <?=$usuario->nombre?> Se ha levantado un Incidente a su nombre con el folio: <b><?=$idIncidente?>.</b> </p>
<h4>Especificaciones:</h4>


<table align="center" border=".5" width="" style="background-color: #e5e8e8;  ">
<tr>
	<td><b>Folio:</b></td>
	<td><?=$idIncidente?></td>
</tr>
<tr>
	<td><b>Descripción</b></td>
	<td><?=$descripcion?></td>
</tr>
<tr>
	<td><b>Fecha de alta:</b></td>
	<td><?=$dia?></td>
</tr>
</table>
<br><br>
<p>Para dar Seguimiento a este Ticket de servicio, habra su sistema de Incidencias OAG, o bien, de click en el siguiente boton: </p>
<a class="btn btn-info">Seguimiento de Incidente</a>
