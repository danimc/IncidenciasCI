<h2>CIERRE DE TICKET DE SERVICIO: FOLIO: <?=$ticket->folio?></h2>

<p><?=$saludo?> <?=$ticket->usuario?>, se ha cerrado el ticket de servicio para el incidente registrado a su nombre con el folio: <b><?=$ticket->folio?>.</b> </p>
<h4>Especificaciones:</h4>


<table align="center" border=".5" width="" style="background-color: #e5e8e8;  ">
<tr>
	<td><b>Folio:</b></td>
	<td><?=$ticket->folio?></td>
</tr>
<tr>
	<td><b>Incidente:</b></td>
	<td><?=$ticket->titulo?></td>
</tr>
<tr>
	<td><b>Descripción</b></td>
	<td><?=$ticket->descripcion?></td>
</tr>
<tr>
	<td><b>Resuelto por:</b></td>
	<td><?=$ticket->asignado?></td>
</tr>
<tr>
	<td><b>Fecha de cierre:</b></td>
	<td><?=$ticket->fecha_cierre?></td>
</tr>
</table>
<br><br>
<p>Para dar Seguimiento a este Ticket de servicio, habra su sistema de Incidencias OAG, o bien, de click en el siguiente boton: </p>
<a class="btn btn-info">Seguimiento de Incidente</a>
