<?php
//This product includes PHP software, freely available from <http://www.php.net/software/>

require_once('Connections/db.php');

// mysql_select_db($database_turnos, $turnos);
// @mysqli_query("SET collation_connection = utf8_general_ci;");
// mysqli_query ("SET NAMES 'utf8'");

$sonido = "";
$query_RsDatosBienvenida = "DELETE FROM turnos where TURNIDUS = '0'";
$RsDatosBienvenida = mysqli_query($turnos, $query_RsDatosBienvenida);

$query_RsParams = "SELECT A.PARAVALOR NODESERVER,
                           (SELECT A2.PARAVALOR 					
						  FROM params_app A2 
						WHERE A2.PARACODI = '2') NODEPORT		
						  FROM params_app A 
						WHERE A.PARACODI = '1' 
						
						";
$RsParams = mysqli_query($turnos, $query_RsParams);
$row_RsParams = mysqli_fetch_assoc($RsParams);
$nodeserver = $row_RsParams['NODESERVER'];
$nodeport = $row_RsParams['NODEPORT'];
//$urlnode = 'http://'.$nodeserver.':'.$nodeport;	

$query_RsllAMADOTV = "SELECT      MODUID  CODIGO_MODULO,
								MODUNOMB MODULO,
								(select SERVCOLO
								  FROM servicios S
								 where S.SERVID = TURNSERV) COLOR,                                 
                                (select 	SERVNOMB
								  FROM servicios S
								 where S.SERVID = TURNSERV) SERVICIO,
								TURNCOAS TURNO,
								TURNCONS CONSECUTIVO
						FROM   turnos ,
        					   modulos,
							   estados
						WHERE ESTAID =3
						AND TURNMODU = MODUID
						AND TURNIDES = ESTAID
						ORDER BY MODUID
						";
//echo($query_RsllAMADOTV);
$RsllAMADOTV = mysqli_query($turnos, $query_RsllAMADOTV);
$row_RsllAMADOTV = mysqli_fetch_assoc($RsllAMADOTV);
$totalRows_RsllAMADOTV = mysqli_num_rows($RsllAMADOTV);

// if ($totalRows_RsllAMADOTV > 0) {
// 	$sonido = 'autoplay';
// } else {
// 	$sonido = '';
// }
?>
<!DOCTYPE html>
<html>

<head>
	<title>PANTALLA TV</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script src="jquery/jquery-1.10.2.min.js"></script>
	<script src="socket/socket.io.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>

	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<script>
		var socket;
		$(document).ready(function () {

			var sound = new Howl({
				src: ['sounds/Alert.mp3'] // Cambia 'ruta/al/archivo-de-sonido.mp3' por la ubicación de tu archivo de sonido
			});

			socket = new io.connect('<?php echo ($nodeserver); ?>', {
				port: <?php echo ($nodeport); ?>
			});

			socket.on('connect', function () {
				console.log('Client has connected to the server!');
			});

			socket.on('message', function (data) {
				$('#chat').prepend('<div>' + data.usu + ': ' + data.msg + '</div>');
			});



			socket.on('PANTALLATV_LB', function (data) {
				//alert(data);
				//$('#chat').append('<div>' + data.usu + ': ' + data.msg + '</div>');
				//$('#chat').append('<div>' + data + '</div>');
				v_campos = data.split('!');
				for (var i = 0; i < v_campos.length - 1; i++) {
					var datos = v_campos[i].split('/');
					var codigo_modulo = datos[0];
					var nombre_modulo = datos[1];
					var turno = datos[2];
					var consecutivo = datos[3];
					var color = datos[4]; //alert('2)'+color);
					var nombre_servicio = datos[5];

					var nombre_div = 'div_turn_' + turno + '_' + codigo_modulo + '_' + consecutivo;
					//alert(nombre_div);
					var existe = document.getElementById(nombre_div);
					//alert(existe);
					//alert('hi');
					if (codigo_modulo != '0') {
						if (existe == null) {
							//alert('there no enter');
							//var turnosadd=$('div.contenedor_turno');
							$('.contenedor_turno').each(function (index) {
								var turnoexist = $(this).attr('id');
								var campdiv = turnoexist.split('_');
								var nombre_moduloE = campdiv[1];
								var turnoE = campdiv[2];
								var consecutivoE = campdiv[4];
								var codigo_moduloE = campdiv[3];
								// alert(codigo_modulo+' - '+codigo_moduloE);
								if (codigo_modulo == codigo_moduloE) {
									$(this).remove();
								}

							})

							sound.play();

							$("#turnero").prepend("<tr class='contenedor_turno' style='background:" + color + "' id='div_turn_" + turno + "_" + codigo_modulo + "_" + consecutivo + "'><td class='turnoA' height='319' align='center' style='background:" + color + "'>" + turno + "</td><td align='center' class='moduloA' height='319' style='border-color:" + color + "'>" + nombre_modulo + "<br>" + nombre_servicio + "</td></tr>");
							document.getElementById('peticiones_ok').value = parseInt(document.getElementById('peticiones_ok').value) + 1;
							if (parseInt(document.getElementById('peticiones_ok').value) > 0) {
								document.getElementById('peticiones_ok').value = parseInt(document.getElementById('peticiones_ok').value) + 1;
							}
							//if(parseInt(document.getElementById('peticiones_ok').value)>7){
							//alert('se recargara la pagina');
							// document.form1.submit();
							//}									 
						}
					}


				}
			});

			socket.on('disconnect', function () {
				console.log('sin conexion');
				$('#chat').html('');
			});
		});


	</script>


</head>

<body>
	<div class="container">
		<div id="div_title">
			<img src="images/logo-hospital.png" width="100" alt="">
			<h4>HOSPITAL SAN FRANCISCO</h4>
		</div>
		<div class="contentTurns">
			<div>
				<img src="images/hospital.jpg" alt="">
			</div>
			<form name="form1" method="post" action="">
				<table id="turnero">
					<thead>
						<tr>
							<td align="center" width="200" id="turno" class="turno">
								<h3>Turno</h3>
							</td>
							<td align="center" width="200" id="modulo" class="modulo">
								<h3>Modulo</h3>
							</td>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($totalRows_RsllAMADOTV > 0) { // Show if recordset not empty 
							do {
								?>

								<tr style="BACKGROUND:<?php echo ($row_RsllAMADOTV['COLOR']); ?>" class="contenedor_turno"
									id="div_turn_<?php echo ($row_RsllAMADOTV['TURNO']); ?>_<?php echo ($row_RsllAMADOTV['CODIGO_MODULO']); ?>_<?php echo ($row_RsllAMADOTV['CONSECUTIVO']); ?>">
									<td width="200" align="center" height="100" class="turnoA"
										style="BACKGROUND:<?php echo ($row_RsllAMADOTV['COLOR']); ?>">
										<?php echo ($row_RsllAMADOTV['TURNO']); ?>
									</td>
									<td width="200" align="center" height="100" class="moduloA"
										style="border-color:<?php echo ($row_RsllAMADOTV['COLOR']); ?>">
										<?php echo ($row_RsllAMADOTV['MODULO']); ?>

									</td>
								</tr>
								<?php /*</div>*/ ?>
								<?php
							} while ($row_RsllAMADOTV = mysqli_fetch_assoc($RsllAMADOTV));
						}
						?>
					</tbody>
					<input type="hidden" name="peticiones_ok" id="peticiones_ok" value="0">
				</table>
			</form>
		</div>
		<div class="footerTV">
			Copyright © 2024. Todos los Derechos Reservados.
		</div>
	</div>

</body>

</html>
<style type="text/css">
	body {
		font-family: Arial, sans-serif;
		margin: 0;
		padding: 0;
		background-color: white;
		height: 100vh;
		width: 100vw;
		overflow: hidden;
	}

	.container {
		height: 100vh;
		width: 100vw;
		padding-top: 15px;
	}

	.contentTurns {
		display: flex;
		padding-left: 30px;
		width: 100%;
		flex-direction: row;
		align-items: center;
		justify-content: space-around;
	}

	.footerTV {
		display: flex;
		flex-direction: row;
		text-align: center;
		justify-content: center;
		height: fit-content;
		padding-top: 4em;
		margin-bottom: 0;
	}

	h4 {
		color: navy;
		font-weight: bold;
		text-align: center;
		margin-bottom: 30px;
		margin-top: 30px;
	}

	table {
		width: fit-content;
		max-width: 1400px;
		margin: 0 auto;
		border-collapse: separate;
		border-left: 0;
		border-radius: 27px;
		border-spacing: 0px;
	}

	#div_title {
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-evenly;
	}

	img {
		max-width: 700px;

	}

	th,
	td {
		padding: 10px;
		text-align: center;
		border: 2px solid white;
		height: fit-content;

	}

	thead:first-child td:first-child {
		border-radius: 7px 0 0 0;
	}

	thead:last-child th:last-child {
		border-radius: 0 0 0 7px;
	}

	.turno {
		background-color: #f2f2f2;
	}

	.modulo {
		background-color: #f2f2f2;
	}

	.contenedor_turno {
		background-color: #fff;
	}

	.turnoA,
	.moduloA {
		font-size: 36px;
		font-weight: bold;
	}

	.servicio {
		font-size: 24px;
		font-weight: bold;
	}
</style>