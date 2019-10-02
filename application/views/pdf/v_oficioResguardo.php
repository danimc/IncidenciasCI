<?
$fecha = $this->m_ticket->fecha_text_f($oficio->fecha_realizado);
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Black+Han+Sans" rel="stylesheet"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<link href="https://fonts.googleapis.com/css?family=Black+Han+Sans" rel="stylesheet"> 

<style type="text/css">
	body {
		font-family: sans-serif;
		
	}
	p {
		font-size: 14px;
	}
	
	h2 {
		color: #999;
	}
	.texto
	{
		font-size: 12px;
	}
	hr {
		page-break-after: always;
		border: 0;
		margin: 0;
		padding: 0;
}
	.portada {
		padding-top: 70px;
		padding-left: 40px;		
	}
	.page {
		padding-top: 20px;
		background: #eee;
	}


#footer {
  position: fixed;
  	left: 0;
	right: 0;
	color: #aaa;
	
}

#header {
  position: absolute;
  top: 43px;
  left: -45px;
}

#logoFisca {
	top: 43px;
  	left: -45px;
}

#footer {
  bottom: 177px; 
  font-size: 12px;
  color: #000; 
}


#oficioAsunto {
  top: 60px;
  position: absolute;
  padding-left: 450px;
  padding-right: 85px;
 
}

 #cuerpo {
 	padding-top: 170px;
 	padding-left: 150px;
 	padding-right: 85px;

 }
 #fecha {
 	padding-top: 20px;
 	text-align: right;
 }

 #mensaje {
 	text-align: justify !important;

 }

 #despedida {
 	padding-top: 50px;

 }

 table {
 	border-collapse: collapse;
 	text-align: center !important;
 	font-size: 11px;
 	width: 100%;
 	border: black 1px solid;
 }
 th {
 	
 	background-color: #b7b7b7;
 	border: black 1px solid;
 }
 td{
 	border: black 1px solid;
 }


.page-number {
  text-align: right;
  font-size: 12px;
  color: #000;
  position: fixed;
  bottom: 10;

}

.page-number:after {
	
  content:  counter(page) ;
}
</style>
</head>
<body>
	<div id="header">
		<img src="src/img/logooficio.jpg" width="300px">
	</div>
	<div id="oficioAsunto">
		<p align="right">
			OFICIO: <b><?=$oficio->oficio?></b><br>
			<b>ASUNTO:</b> Contestación oficio
		</p>		
	</div>

	<div id="cuerpo">
		<p><b><?=strtoupper($oficio->destinatario)?></b><br>
		<?=strtoupper($oficio->cargo)?> <br>
		<b>P R E S E N T E</b>

		<div id="fecha">
			<p>Guadalajara, Jal. <?=$fecha?>
		</div>
		<div id="mensaje">
			<?=$oficio->redaccion?>
			<p>Sin otro particular por el momento, con la más alta consideración y estima, quedo de usted. </p>
		</div>
		<div id="despedida">
			<p><b>A T E N T A M E N T E</b>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<b>ING. RAFAEL RUÍZ VALLADOLID</b><br>
				<span style="font-size: 12px">DIRECTOR DE TECNOLOGÍAS DE LA INFORMACIÓN DE LA FISCALÍA ESTATAL</span> </p>
		</div>	
		
	</div>


	
	

	<div id="footer">
  		<img src="src/img/isologo.svg" width="100px">
	</div>
	
</body>
</html>