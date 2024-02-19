<?php
header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header( "Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . " GMT" );
header( "Cache-Control: no-cache, must-revalidate" );
header( "Pragma: no-cache" );

//require_once('seguridad.php');
require_once('Connections/db.php');
if (!isset($_SESSION)) {
  		session_start();
	}
	
// mysql_select_db($database_turnos, $turnos);
// @mysqli_query("SET collation_connection = utf8_general_ci;");
// mysqli_query ("SET NAMES 'utf8'");

$tipoguardar='';
if(isset($_GET['tipoguardar']) && $_GET['tipoguardar']!=''){
$tipoguardar=$_GET['tipoguardar'];
}

		$rango_inicial = 0;
		$rango_final   = 99;
		$letra_turno   = '';
        $indice_letra  = '';
		$ARRAY_LETRAS[0] = 'A';
		$ARRAY_LETRAS[1] = 'B';
		$ARRAY_LETRAS[2] = 'C';
		$ARRAY_LETRAS[3] = 'D';
		$ARRAY_LETRAS[4] = 'E';
		$ARRAY_LETRAS[5] = 'F';
		$ARRAY_LETRAS[6] = 'G';
		$ARRAY_LETRAS[7] = 'H';
		$ARRAY_LETRAS[8] = 'I';
		$ARRAY_LETRAS[9] = 'J';
		$ARRAY_LETRAS[10] = 'K';
		$ARRAY_LETRAS[11] = 'L';
		$ARRAY_LETRAS[12] = 'M';
		$ARRAY_LETRAS[13] = 'N';
		$ARRAY_LETRAS[14] = 'O';
		$ARRAY_LETRAS[15] = 'P';
		$ARRAY_LETRAS[16] = 'Q';
		$ARRAY_LETRAS[17] = 'R';
		$ARRAY_LETRAS[18] = 'S';
		$ARRAY_LETRAS[19] = 'T';
		$ARRAY_LETRAS[20] = 'U';
		$ARRAY_LETRAS[21] = 'V';
		$ARRAY_LETRAS[22] = 'W';
		$ARRAY_LETRAS[23] = 'X';
		$ARRAY_LETRAS[24] = 'Y';
		$ARRAY_LETRAS[25] = 'Z';		


if($tipoguardar=='consultar_turnosver31')
{
$turnosExs=array();
$turnos_pantallatv='';
if(isset($_GET['turnos_pantalla']) && $_GET['turnos_pantalla']!=''){
		$turnos_pantallatv=$_GET['turnos_pantalla'];
}

							
		$query_RsllAMADOTV="SELECT  TURNMODU  CODIGO_MODULO,
									TURNCOAS TURNO,
									TURNCONS CONSECUTIVO
							FROM   turnos						
							WHERE TURNIDES = 3
							
							";		
        if($turnos_pantallatv==''){
		 echo('vacio');
		 exit();
		}
        		
		$query_RsllAMADOTV=$query_RsllAMADOTV." ORDER BY TURNCONS asc";
		$RsllAMADOTV = mysqli_query($turnos, $query_RsllAMADOTV) ;
		$row_RsllAMADOTV = mysqli_fetch_assoc($RsllAMADOTV);	
		$totalRows_RsllAMADOTV = mysqli_num_rows($RsllAMADOTV);
		
		if($totalRows_RsllAMADOTV==0){
		
		echo('');
		}
		
		$query_RsllAMADOTV2="SELECT  TURNCONS CONSECUTIVO
							FROM   turnos						
							WHERE TURNIDES = 3
							 and TURNCONS NOT IN (".$turnos_pantallatv.")";
							 //echo($query_RsllAMADOTV2);
         $RsllAMADOTV2 = mysqli_query($turnos, $query_RsllAMADOTV2) ;							 
		 $totalRows_RsllAMADOTV2 = mysqli_num_rows($RsllAMADOTV2);
		 if($totalRows_RsllAMADOTV2>0){
		   echo('nuevo');
		   exit();
		   
		 }		
							
}

if($tipoguardar=='consultar_turnosreload')
{
$turnosExs=array();
$turnos_pantallatv='';
if(isset($_GET['turnos_pantalla']) && $_GET['turnos_pantalla']!=''){
		$turnos_pantallatv=$_GET['turnos_pantalla'];
}

							
		$query_RsllAMADOTV="SELECT  TURNMODU  CODIGO_MODULO,
									TURNCOAS TURNO,
									TURNCONS CONSECUTIVO
							FROM   turnos						
							WHERE TURNIDES = 3
							
							";		
        if($turnos_pantallatv==''){
		 echo('vacio');
		 exit();
		}
        		
		$query_RsllAMADOTV=$query_RsllAMADOTV." ORDER BY TURNCONS asc";
		$RsllAMADOTV = mysqli_query($turnos, $query_RsllAMADOTV) ;
		$row_RsllAMADOTV = mysqli_fetch_assoc($RsllAMADOTV);	
		$totalRows_RsllAMADOTV = mysqli_num_rows($RsllAMADOTV);
		if($totalRows_RsllAMADOTV>0){
	 	 $k=0;
		  do{
		    $turnosExs[$k]=$row_RsllAMADOTV['CONSECUTIVO'];
		    
			}while($row_RsllAMADOTV = mysqli_fetch_assoc($RsllAMADOTV));
		}else{
		 echo('count0');
		 exit();
		}
		
		//$tamano_turnostv=strlen($turnos_pantallatv);
         //if(count($turnosExs) >0){
		 /*$turpart_tv=explode(',',$turnos_pantallatv);
		 //print_r($turpart_tv);
		  $result=array_diff($turnosExs,$turpart_tv);
		  if(count($result) >0 ){
		  echo('nuevo');
		  exit();
		  }
		  if(count($result) >0){
		  echo('nuevo');
		  exit();
		  }
		  */
		$query_RsllAMADOTV2="SELECT  TURNCONS CONSECUTIVO
							FROM   turnos						
							WHERE TURNIDES = 3
							 and TURNCONS NOT IN (".$turnos_pantallatv.")";
							 //echo($query_RsllAMADOTV2);
         $RsllAMADOTV2 = mysqli_query($turnos, $query_RsllAMADOTV2) ;							 
		 $totalRows_RsllAMADOTV2 = mysqli_num_rows($RsllAMADOTV2);
		 if($totalRows_RsllAMADOTV2>0){
		   echo('nuevo');
		   exit();
		   
		 }else{
		 
		 echo('reiniciar');
		 exit();
		 }
		/*}
		 else
		 {
		  $turpart_tv=explode(',',$turnos_pantallatv);
		  $result=array_diff($turpart_tv,$turnosExs);
		  if(count($result) >0){
		   echo('cambiado');
		   exit();
		   break;
		  }
		 }*/
		 echo('reiniciar');
		 exit();
		 
		 
}
if($tipoguardar=='ComprobarTurnoPendiente')
{
 		$query_RsConsultaTurno="SELECT 
										TURNCONS CONSECUTIVO ,
										TURNCOAS NUMERO_TURNO,
										TURNTURN JORNADA,
										TURNPARA PARAMETRO
										
								 FROM turnos
							   WHERE TURNIDUS = '".$_SESSION["IDUSU"]."'
                                 AND TURNIDES in ('3','6')							
 								 ";								 
		$RsConsultaTurno = mysqli_query($turnos, $query_RsConsultaTurno) ;
		//$row_RsConsultaTurno = mysqli_fetch_assoc($RsConsultaTurno);	
		$totalRows_RsConsultaTurno = mysqli_num_rows($RsConsultaTurno);
		if($totalRows_RsConsultaTurno>0){
		  echo('si');
		}else{
		 echo('no');
		}
}

if($tipoguardar=='ComprobarTurnoPendienteAyuda')
{
 		$query_RsConsultaTurno="SELECT 
										TURNCONS CONSECUTIVO ,
										TURNCOAS NUMERO_TURNO,
										TURNTURN JORNADA,
										TURNPARA PARAMETRO
										
								 FROM turnos
							   WHERE TURNIDAP = '".$_SESSION["IDUSU"]."'
                                 AND TURNIDES in ('3','6')							
 								 ";								 
		$RsConsultaTurno = mysqli_query($turnos, $query_RsConsultaTurno) ;
		//$row_RsConsultaTurno = mysqli_fetch_assoc($RsConsultaTurno);	
		$totalRows_RsConsultaTurno = mysqli_num_rows($RsConsultaTurno);
		if($totalRows_RsConsultaTurno>0){
		  echo('si');
		}else{
		 echo('no');
		}
}


if($tipoguardar=='consultar_turnos')
{
$query_RsllAMADOTV="SELECT      MODUID  CODIGO_MODULO,
								MODUNOMB MODULO,
								(select SERVCOLO
								  FROM servicios S
								 where S.SERVID = TURNSERV) COLOR,
								TURNCOAS TURNO,
								TURNCONS CONSECUTIVO,
								TURNSERV SERVICIO,
								SERVNOMB SERVICIO_DES
						FROM   turnos ,
        					   modulos,
							   estados,
							   servicios
						WHERE ESTAID =3
						AND TURNMODU = MODUID
						AND TURNSERV = SERVID
						AND TURNIDES = ESTAID
						ORDER BY TURNCONS
						";
	$RsllAMADOTV = mysqli_query($turnos, $query_RsllAMADOTV) ;
	$row_RsllAMADOTV = mysqli_fetch_assoc($RsllAMADOTV);	
	$totalRows_RsllAMADOTV = mysqli_num_rows($RsllAMADOTV);
    if($totalRows_RsllAMADOTV>0){
	  do{
	  echo($row_RsllAMADOTV['CODIGO_MODULO'].'/'.$row_RsllAMADOTV['MODULO'].'/'.$row_RsllAMADOTV['TURNO'].'/'.$row_RsllAMADOTV['CONSECUTIVO'].'/'.$row_RsllAMADOTV['COLOR'].'/'.$row_RsllAMADOTV['SERVICIO_DES'].'!');
	    }while($row_RsllAMADOTV = mysqli_fetch_assoc($RsllAMADOTV));
	}
}


if($tipoguardar=='Sincronizar_Turno')
{
 $_SESSION["SINCRONIZADO"]=$_GET['modulo'];
        $query_RsInsert=" INSERT INTO PARAMETROS (
                                          PARACONS ,
										  PARANOMB ,
										  PARAVALO ,
										  PARAFECH ,
										  PARAIDUS ,
										  PARAIDMO ,
										  PARASERV
										  )
								  VALUES (
										  NULL ,
										  'sincronizar',
										  '".$_GET['numero_sincronizado']."',
										  sysdate(),
										  '".$_SESSION["IDUSU"]."',
										  '".$_GET['modulo']."',
										  '".$_GET['servicio_sincronizado']."'
										  )";													   
		//echo($query_RsInsert);											   
		$RsInsert = mysqli_query($turnos, $query_RsInsert);
		
	$query_RsUltInsert = "SELECT LAST_INSERT_ID() DATO";
	$RsUltInsert = mysqli_query($turnos,$query_RsUltInsert) ;
	$row_RsUltInsert = mysqli_fetch_assoc($RsUltInsert);
	$parametro=$row_RsUltInsert['DATO'];
    
	//echo($parametro);
				$query_RsParametro="SELECT 
											PARACONS,
											PARANOMB,
											PARAVALO,
											PARAFECH,
											PARAIDUS,
											PARAIDMO,
                                            PARASERV											
									  FROM parametros
									  WHERE PARACONS='".$parametro."'";
						$RsParametro = mysqli_query($turnos, $query_RsParametro);
						$row_RsParametro = mysqli_fetch_assoc($RsParametro);	
						$paravalor=$row_RsParametro['PARAVALO'];
	//echo($paravalor);
	if($_GET['modulo']!=''){
	    $query_RsUpdate=" update turnos set TURNIDES = '4' where TURNMODU = '".$_GET['modulo']."' and TURNIDES in ('3','6') ";
		$RsUpdate = mysqli_query($turnos,$query_RsUpdate) ;
	    
		$query_RsUpdate=" update turnos set TURNIDES = '4' where TURNIDUS = '".$_SESSION["IDUSU"]."' and TURNIDES in ('3','6') ";
		$RsUpdate = mysqli_query($turnos,$query_RsUpdate) ;
		
	    $query_RsUpdate=" update turnos set TURNIDES = '4' where TURNIDAP= '".$_SESSION["IDUSU"]."' and TURNIDES in ('3','6') ";
		$RsUpdate = mysqli_query($turnos,$query_RsUpdate) ;		
	 }
	$query_RsInsert="INSERT INTO turnos (
									 TURNCONS ,
									 TURNCOAS ,
									 TURNLETR ,
									 TURNMODU ,
									 TURNIDUS ,
									 
									 TURNTURN ,
									 TURNIDES ,
									 TURNPARA ,
									 TURNSERV
									)
							VALUES (
									NULL ,
									'".$paravalor."',
									'".$_GET['letra_sincronizada']."',
									'".$_GET['modulo']."',
									'".$_SESSION["IDUSU"]."',
									
									'".$_GET['turnojornada']."',
									'5',
									'".$parametro."',
									'".$_GET['servicio_sincronizado']."'
									)";
//echo($query_RsInsert);        
		$RsInsert = mysqli_query($turnos, $query_RsInsert);
$_SESSION["PARAMETRO"]=	$parametro;	

$retorno=$parametro;
echo($retorno);
}

if($tipoguardar=='Crear_TurnoAyuda')
{ 
	$query_RsConsultaTurno="SELECT 
										TURNCONS CONSECUTIVO ,
										(TURNCOAS+1) NUMERO_TURNO,
										TURNTURN JORNADA,
										TURNPARA PARAMETRO,
										TURNSERV SERVICIO
										
								FROM turnos
								WHERE TURNIDUS = '".$_GET['user_ayudar']."'
								  AND TURNCONS = (SELECT MAX(T2.TURNCONS)
								                   FROM TURNOS T2
												  WHERE  T2.TURNIDUS = '".$_GET['user_ayudar']."'
												   )
 								 ";								 
		$RsConsultaTurno = mysqli_query($turnos, $query_RsConsultaTurno) ;
		$row_RsConsultaTurno = mysqli_fetch_assoc($RsConsultaTurno);	
		$totalRows_RsConsultaTurno = mysqli_num_rows($RsConsultaTurno);
		if($totalRows_RsConsultaTurno>0){
		  $query_RsInsert="INSERT INTO turnos (
										 TURNCONS ,
										 TURNCOAS ,
										 TURNMODU ,
										 TURNIDUS ,
										 
										 TURNTURN ,
										 TURNIDES ,
										 TURNPARA,
										 TURNFELL,
										 TURNAPOY,
										 TURNIDAP,
										 TURNSERV
										)
								VALUES (
										NULL ,
										'".$row_RsConsultaTurno['NUMERO_TURNO']."',
										'".$_SESSION["MODULO"]."',
										'".$_GET["user_ayudar"]."',
										
										'".$row_RsConsultaTurno['JORNADA']."',
										'3',
										'".$row_RsConsultaTurno['PARAMETRO']."',
										SYSDATE(),
										'1',
										'".$_SESSION["IDUSU"]."',
										'".$row_RsConsultaTurno['SERVICIO']."'
										)";
			 //echo($query_RsInsert);        
			$RsInsert = mysqli_query($turnos, $query_RsInsert);
		$query_RsUltInsert = "SELECT LAST_INSERT_ID() DATO";
		$RsUltInsert = mysqli_query($turnos,$query_RsUltInsert) ;
		$row_RsUltInsert = mysqli_fetch_assoc($RsUltInsert);
		$consecutivo=$row_RsUltInsert['DATO'];			
		$retorno=$row_RsConsultaTurno['NUMERO_TURNO'].'/'.$row_RsConsultaTurno['PARAMETRO'].'/'.$consecutivo;		
	    echo($retorno);			
		}
}

if($tipoguardar=='Crear_turno')
{   
		$secuencia='';
		if(isset($_GET['C_secuencia']) && $_GET['C_secuencia']!=''){
		$secuencia=$_GET['C_secuencia'];
		}
	    
		$parametro_C=$_GET['parametro_G'];
	
	if($secuencia=='uno')
	{
	 	
		$query_RsConsultaTurno="SELECT 
										TURNCONS CONSECUTIVO ,
										TURNCOAS NUMERO_TURNO,
										TURNLETR LETRA,
										TURNPARA PARAMETRO,
										TURNSERV SERVICIO,
										(select SERVCOLO
								  FROM servicios S
								 where S.SERVID = TURNSERV) COLOR
								FROM turnos
								WHERE TURNPARA ='".$parametro_C."'
								 and  TURNCONS = (SELECT MAX(T2.TURNCONS)
								                   FROM turnos T2
												  WHERE T2.TURNPARA = '".$parametro_C."')";
		$RsConsultaTurno = mysqli_query($turnos, $query_RsConsultaTurno) ;
		$row_RsConsultaTurno = mysqli_fetch_assoc($RsConsultaTurno);	
		$totalRows_RsConsultaTurno = mysqli_num_rows($RsConsultaTurno);
			
		if (isset($totalRows_RsConsultaTurno) && $totalRows_RsConsultaTurno > 0)
		{
			$query_RsLLamarTurno="UPDATE turnos SET TURNIDES = '3' WHERE TURNCONS ='".$row_RsConsultaTurno['CONSECUTIVO']."'";
			$RsLLamarTurno = mysqli_query($turnos,$query_RsLLamarTurno) ;

			$query_RsLLamarTurno2="UPDATE turnos SET TURNFELL = SYSDATE() WHERE TURNCONS ='".$row_RsConsultaTurno['CONSECUTIVO']."'";
			$RsLLamarTurno2 = mysqli_query($turnos,$query_RsLLamarTurno2 );
			
			$query_RsRangosTurno="SELECT S.SERVRAFI RANGO_FINAL,
			                             S.SERVRAIN RANGO_INICIAL
								   FROM servicios S
								  WHERE S.SERVID = '".$row_RsConsultaTurno['SERVICIO']."'";
			$RsRangosTurno = mysqli_query($turnos,$query_RsRangosTurno) ;
			$row_RsRangosTurno = mysqli_fetch_assoc($RsRangosTurno);	
			$totalRows_RsRangosTurno = mysqli_num_rows($RsRangosTurno);			
			$numero_turno = $row_RsConsultaTurno['NUMERO_TURNO'];
			$no_enter=0;
			if($totalRows_RsRangosTurno>0){
			  $rango_inicial = $row_RsRangosTurno['RANGO_INICIAL'];
			  $rango_final   = $row_RsRangosTurno['RANGO_FINAL'];
			  $letra_turno  = $_GET['letra_sincronizada'];
			   if($numero_turno > $rango_final){
			      $numero_turno = $rango_inicial;
				  $TAMANO_ARR_LETRAS=count($ARRAY_LETRAS);
				   if($_GET['letra_sincronizada']!=''){
					  for($s=0; $s<$TAMANO_ARR_LETRAS; $s++){
					   if($ARRAY_LETRAS[$s]==$letra_turno){ 
					    $indice_letra=$s;
					   }
					  }
					  if($indice_letra < ($TAMANO_ARR_LETRAS-1)){
						 $letra_turno=$ARRAY_LETRAS[$indice_letra+1];
						}

					  if($indice_letra==($TAMANO_ARR_LETRAS-1)){
						$letra_turno=$ARRAY_LETRAS[0];
					  }					 
                   }					  
			    }
			}			
		}
				
		$retorno=$numero_turno.'/'.$row_RsConsultaTurno['PARAMETRO'].'/'.$row_RsConsultaTurno['CONSECUTIVO'].'/'.$letra_turno;	
	    echo($retorno);
		
$query_RsllAMADOTV="SELECT      MODUID  CODIGO_MODULO,
								MODUNOMB MODULO,
								(select SERVCOLO
								  FROM servicios S
								 where S.SERVID = TURNSERV) COLOR,
								CONCAT(TURNLETR,'',TURNCOAS) TURNO,
								TURNCONS CONSECUTIVO,
								TURNSERV SERVICIO,
								SERVNOMB SERVICIO_DES
						FROM   turnos ,
        					   modulos,
							   estados,
							   servicios
						WHERE ESTAID =3
						AND TURNMODU = MODUID
						AND TURNSERV = SERVID
						AND TURNIDES = ESTAID
					    and TURNCONS = '".$row_RsConsultaTurno['CONSECUTIVO']."'";
						
	$RsllAMADOTV = mysqli_query($turnos, $query_RsllAMADOTV) ;
	$row_RsllAMADOTV = mysqli_fetch_assoc($RsllAMADOTV);	
	$totalRows_RsllAMADOTV = mysqli_num_rows($RsllAMADOTV);
	$turnoactual='0/0/0/0/0/0!';
    if($totalRows_RsllAMADOTV>0){
	  $turnoactual=$row_RsllAMADOTV['CODIGO_MODULO'].'/'.$row_RsllAMADOTV['MODULO'].'/'.$row_RsllAMADOTV['TURNO'].'/'.$row_RsllAMADOTV['CONSECUTIVO'].'/'.$row_RsllAMADOTV['COLOR'].'/'.$row_RsllAMADOTV['SERVICIO_DES'].'!';
		//require('elephantio/lib/ElephantIO/Client.php');
        include('llamarnode.php');
	  
	}
		
	}
	
	if($secuencia=='dos')
	{
	
		$query_RsConsultaTurno="SELECT 
										TURNCONS CONSECUTIVO ,
										(TURNCOAS+1) NUMERO_TURNO,
										TURNLETR LETRA,
										TURNPARA PARAMETRO,
										TURNSERV SERVICIO,
										(select SERVCOLO
										  FROM servicios S
										 where S.SERVID = TURNSERV) COLOR
								FROM turnos
								WHERE TURNPARA ='".$parametro_C."'
								 and  TURNCONS = (SELECT MAX(T2.TURNCONS)
								                   FROM turnos T2
												  WHERE T2.TURNPARA = '".$parametro_C."')";
		$RsConsultaTurno = mysqli_query($turnos, $query_RsConsultaTurno) ;
		$row_RsConsultaTurno = mysqli_fetch_assoc($RsConsultaTurno);	
		$totalRows_RsConsultaTurno = mysqli_num_rows($RsConsultaTurno);	
		$numero_turno = $_GET['numero_turno'];
		if($totalRows_RsConsultaTurno>0){
		  $numero_turno = $row_RsConsultaTurno['NUMERO_TURNO'];
			$query_RsRangosTurno="SELECT S.SERVRAFI RANGO_FINAL,
			                             S.SERVRAIN RANGO_INICIAL
								   FROM servicios S
								  WHERE S.SERVID = '".$row_RsConsultaTurno['SERVICIO']."'";
			$RsRangosTurno = mysqli_query($turnos,$query_RsRangosTurno) ;
			$row_RsRangosTurno = mysqli_fetch_assoc($RsRangosTurno);	
			$totalRows_RsRangosTurno = mysqli_num_rows($RsRangosTurno);			
			$numero_turno = $row_RsConsultaTurno['NUMERO_TURNO'];
			$no_enter=0;
			if($totalRows_RsRangosTurno>0){
			  $rango_inicial = $row_RsRangosTurno['RANGO_INICIAL'];
			  $rango_final   = $row_RsRangosTurno['RANGO_FINAL'];
			  //$letra_turno  = $_GET['letra_sincronizada'];
			  $letra_turno  = $row_RsConsultaTurno['LETRA'];
			   	if($numero_turno > $rango_final){
			      $numero_turno = $rango_inicial;
				  $TAMANO_ARR_LETRAS=count($ARRAY_LETRAS);
				   if($_GET['letra_sincronizada']!=''){
					  for($s=0; $s<$TAMANO_ARR_LETRAS; $s++){
					   if($ARRAY_LETRAS[$s]==$letra_turno){ 
					    $indice_letra=$s;
					   }
					  }
					  if($indice_letra < ($TAMANO_ARR_LETRAS-1)){
						 $letra_turno=$ARRAY_LETRAS[$indice_letra+1];
						}

					  if($indice_letra==($TAMANO_ARR_LETRAS-1)){
						$letra_turno=$ARRAY_LETRAS[0];
					  }					  
					}
			    }
			}	  
		}

	  $query_RsInsert="INSERT INTO turnos (
									 TURNCONS ,
									 TURNCOAS ,
									 TURNLETR ,
									 TURNMODU ,
									 TURNIDUS ,
									 
									 TURNTURN ,
									 TURNIDES ,
									 TURNPARA,
									 TURNFELL,
									 TURNSERV
									)
							VALUES (
									NULL ,
									'".$numero_turno."',
									'".$letra_turno."',
									'".$_GET['modulo']."',
									'".$_SESSION["IDUSU"]."',
									
									'".$_GET['turnojornada']."',
									'3',
									'".$parametro_C."',
									SYSDATE(),
									'".$_GET['servicio_sincronizado']."'
									)";
         //echo($query_RsInsert);        
		$RsInsert = mysqli_query($turnos, $query_RsInsert);
		
		$query_RsUltInsert = "SELECT LAST_INSERT_ID() DATO";
		$RsUltInsert = mysqli_query($turnos,$query_RsUltInsert) ;
		$row_RsUltInsert = mysqli_fetch_assoc($RsUltInsert);
		$consecutivo=$row_RsUltInsert['DATO'];
		
		//$retorno=$_GET['numero_turno'].'/'.$parametro_C.'/'.$consecutivo;		
		$retorno=$numero_turno.'/'.$parametro_C.'/'.$consecutivo.'/'.$letra_turno;	
	    echo($retorno);
		
$query_RsllAMADOTV="SELECT      MODUID  CODIGO_MODULO,
								MODUNOMB MODULO,
								(select SERVCOLO
								  FROM servicios S
								 where S.SERVID = TURNSERV) COLOR,
								CONCAT(TURNLETR,'',TURNCOAS) TURNO,
								TURNCONS CONSECUTIVO,
								TURNSERV SERVICIO,
								SERVNOMB SERVICIO_DES
						FROM   turnos ,
        					   modulos,
							   estados,
							   servicios
						WHERE ESTAID =3
						AND TURNMODU = MODUID
						AND TURNSERV = SERVID
						AND TURNIDES = ESTAID
						AND TURNCONS = '".$consecutivo."'
						";
	$RsllAMADOTV = mysqli_query($turnos, $query_RsllAMADOTV) ;
	$row_RsllAMADOTV = mysqli_fetch_assoc($RsllAMADOTV);	
	$totalRows_RsllAMADOTV = mysqli_num_rows($RsllAMADOTV);
	$turnoactual='0/0/0/0/0/0!';
    if($totalRows_RsllAMADOTV>0){
	  $turnoactual=$row_RsllAMADOTV['CODIGO_MODULO'].'/'.$row_RsllAMADOTV['MODULO'].'/'.$row_RsllAMADOTV['TURNO'].'/'.$row_RsllAMADOTV['CONSECUTIVO'].'/'.$row_RsllAMADOTV['COLOR'].'/'.$row_RsllAMADOTV['SERVICIO_DES'].'!';
		//require('elephantio/lib/ElephantIO/Client.php');
        include('llamarnode.php');
	  
	}
		
	}
	
	

}

if($tipoguardar=='Siguiente_turno'){


        $secuencia_N='';
		if(isset($_GET['secuencia_N']) && $_GET['secuencia_N']!=''){
		$secuencia_N=$_GET['secuencia_N'];
		}
		$parametro_S=$_GET['parametro_N'];

		
		if($secuencia_N == 'dos' or $secuencia_N == 'uno'  )
		{
			$query_RsTurno="UPDATE turnos SET TURNIDES = '4' WHERE TURNCONS ='".$_GET['consecutivo_N']."'";
			$RsTurno = mysqli_query($turnos,$query_RsTurno) ;
			$turno_N=$_GET['numero_turno_N']+1;
		$query_RsConsultaTurno="SELECT 
										TURNCONS CONSECUTIVO ,
										(TURNCOAS+1) NUMERO_TURNO,
										TURNLETR LETRA,
										TURNPARA PARAMETRO,
										TURNSERV SERVICIO
								FROM turnos
								WHERE TURNPARA ='".$parametro_S."'
								 and  TURNCONS = (SELECT MAX(T2.TURNCONS)
								                   FROM turnos T2
												  WHERE T2.TURNPARA = '".$parametro_S."')";
		$RsConsultaTurno = mysqli_query($turnos, $query_RsConsultaTurno) ;
		$row_RsConsultaTurno = mysqli_fetch_assoc($RsConsultaTurno);	
		$totalRows_RsConsultaTurno = mysqli_num_rows($RsConsultaTurno);				
		if($totalRows_RsConsultaTurno>0){
		  $turno_N=$row_RsConsultaTurno['NUMERO_TURNO'];
			$query_RsRangosTurno="SELECT S.SERVRAFI RANGO_FINAL,
			                             S.SERVRAIN RANGO_INICIAL
								   FROM servicios S
								  WHERE S.SERVID = '".$row_RsConsultaTurno['SERVICIO']."'";
			$RsRangosTurno = mysqli_query($turnos,$query_RsRangosTurno) ;
			$row_RsRangosTurno = mysqli_fetch_assoc($RsRangosTurno);	
			$totalRows_RsRangosTurno = mysqli_num_rows($RsRangosTurno);			
			$numero_turno = $turno_N;
			$no_enter=0;
			if($totalRows_RsRangosTurno>0){
			  $rango_inicial = $row_RsRangosTurno['RANGO_INICIAL'];
			  $rango_final   = $row_RsRangosTurno['RANGO_FINAL'];
			  //$letra_turno  = $_GET['letra_sincronizada'];
			  $letra_turno  = $row_RsConsultaTurno['LETRA'];
			   if($numero_turno > $rango_final){
			      $numero_turno = $rango_inicial;
				  $TAMANO_ARR_LETRAS=count($ARRAY_LETRAS);
				    if($_GET['letra_sincronizada']!=''){
					  for($s=0; $s<$TAMANO_ARR_LETRAS; $s++){
					   if($ARRAY_LETRAS[$s]==$letra_turno){ 
					    $indice_letra=$s;
					   }
					  }
					  if($indice_letra < ($TAMANO_ARR_LETRAS-1)){
						 $letra_turno=$ARRAY_LETRAS[$indice_letra+1];
						}

					  if($indice_letra==($TAMANO_ARR_LETRAS-1)){
						$letra_turno=$ARRAY_LETRAS[0];
					  }					  
					}  
			    }
			}
		  
		}
			$query_RsInsert="INSERT INTO turnos (
									 TURNCONS ,
									 TURNCOAS ,
									 TURNLETR ,
									 TURNMODU ,
									 TURNIDUS ,
									 
									 TURNTURN ,
									 TURNIDES ,
									 TURNPARA,
									 TURNFELL,
									 TURNSERV
									)
							VALUES (
									NULL ,
									'".$numero_turno."',
									'".$letra_turno."',
									'".$_GET['modulo']."',
									'".$_SESSION["IDUSU"]."',
									
									'".$_GET['turnojornada']."',
									'3',
									'".$_GET['parametro_N']."',
									SYSDATE(),
									'".$_GET["servicio_sincronizado"]."'
									)";
//echo($query_RsInsert);        
		$RsInsert = mysqli_query($turnos, $query_RsInsert);

	$query_RsUltInsert = "SELECT LAST_INSERT_ID() DATO";
	$RsUltInsert = mysqli_query($turnos,$query_RsUltInsert) ;
	$row_RsUltInsert = mysqli_fetch_assoc($RsUltInsert);
	$TurnoSiguiente=$row_RsUltInsert['DATO'];
	
	$query_RsConsultaTurnoSig="SELECT 
                         TURNCONS CONSECUTIVO ,
						 TURNCOAS NUMERO_TURNO,
						 TURNLETR LETRA,
						 TURNPARA PARAMETRO,
						 TURNSERV SERVICIO
					FROM turnos
					WHERE TURNCONS ='".$TurnoSiguiente."'";
	$RsConsultaTurnoSig = mysqli_query($turnos,$query_RsConsultaTurnoSig);
	$row_RsConsultaTurnoSig = mysqli_fetch_assoc($RsConsultaTurnoSig);	
	
     $turno= $row_RsConsultaTurnoSig['NUMERO_TURNO'];
			
		$retorno=$turno.'/'.$row_RsConsultaTurnoSig['PARAMETRO'].'/'.$row_RsConsultaTurnoSig['CONSECUTIVO'].'/'.$row_RsConsultaTurnoSig['LETRA'];		
	    echo($retorno);	
		
$query_RsllAMADOTV="SELECT      MODUID  CODIGO_MODULO,
								MODUNOMB MODULO,
								(select SERVCOLO
								  FROM servicios S
								 where S.SERVID = TURNSERV) COLOR,
								CONCAT(TURNLETR,'',TURNCOAS) TURNO,
								TURNCONS CONSECUTIVO,
								TURNSERV SERVICIO,
								SERVNOMB SERVICIO_DES
						FROM   turnos ,
        					   modulos,
							   estados,
							   servicios
						WHERE ESTAID =3
						AND TURNMODU = MODUID
						AND TURNSERV = SERVID
						AND TURNIDES = ESTAID
						AND TURNCONS = '".$TurnoSiguiente."'
						";
	$RsllAMADOTV = mysqli_query($turnos, $query_RsllAMADOTV) ;
	$row_RsllAMADOTV = mysqli_fetch_assoc($RsllAMADOTV);	
	$totalRows_RsllAMADOTV = mysqli_num_rows($RsllAMADOTV);
	$turnoactual='0/0/0/0/0/0!';
    if($totalRows_RsllAMADOTV>0){
	  $turnoactual=$row_RsllAMADOTV['CODIGO_MODULO'].'/'.$row_RsllAMADOTV['MODULO'].'/'.$row_RsllAMADOTV['TURNO'].'/'.$row_RsllAMADOTV['CONSECUTIVO'].'/'.$row_RsllAMADOTV['COLOR'].'/'.$row_RsllAMADOTV['SERVICIO_DES'].'!';
		//require('elephantio/lib/ElephantIO/Client.php');
        include('llamarnode.php');
	  
	}
		
		}

	
}

if($tipoguardar=='Inicio_AtencionAyuda'){
//actualizar estado a "ATENDIENDO"        
$query_RsI_Turno="UPDATE turnos 
                      SET TURNIDES = '6' 
                      WHERE TURNCONS ='".$_GET['consecutivo_ayuda']."'
                      AND   TURNPARA ='".$_GET['parametro_ayuda']."' ";
$RsI_Turno = mysqli_query($turnos,$query_RsI_Turno) ;

//actualizar fecha de inicio
$query_RsI_Turno2="UPDATE turnos 
                      SET TURNFECH = SYSDATE() 
                      WHERE TURNCONS ='".$_GET['consecutivo_ayuda']."'
                      AND   TURNPARA ='".$_GET['parametro_ayuda']."' ";
$RsI_Turno2 = mysqli_query($turnos,$query_RsI_Turno2);

$r='T';
$retorno=$r.'/'.$_GET['parametro_ayuda'].'/'.$_GET['consecutivo_ayuda'];		
echo($retorno);
}


if($tipoguardar=='Inicio_Atencion'){

//actualizar estado a "ATENDIENDO"        
$query_RsI_Turno="UPDATE turnos 
                      SET TURNIDES = '6' 
                      WHERE TURNCONS ='".$_GET['I_consecutivo']."'
                      AND   TURNPARA ='".$_GET['I_parametro']."' ";
$RsI_Turno = mysqli_query($turnos,$query_RsI_Turno) ;

//actualizar fecha de inicio
$query_RsI_Turno2="UPDATE turnos 
                      SET TURNFECH = SYSDATE() 
                      WHERE TURNCONS ='".$_GET['I_consecutivo']."'
                      AND   TURNPARA ='".$_GET['I_parametro']."' ";
$RsI_Turno2 = mysqli_query($turnos,$query_RsI_Turno2);

$r='T';
$retorno=$r.'/'.$_GET['I_parametro'].'/'.$_GET['I_consecutivo'];		
echo($retorno);
		
}

if($tipoguardar=='Fin_AtencionAyuda'){
  //actualizar estado a "FINALIZADO"        
$query_RsF_Turno="UPDATE turnos 
                      SET TURNIDES = '2' 
                      WHERE TURNCONS ='".$_GET['consecutivo_ayuda']."'
                      AND   TURNPARA ='".$_GET['parametro_ayuda']."' ";
$RsF_Turno = mysqli_query($turnos,$query_RsF_Turno) ;

//actualizar fecha fin
 $query_RsF_Turno2="UPDATE turnos 
                      SET TURNFEFI =  SYSDATE()
                      WHERE TURNCONS ='".$_GET['consecutivo_ayuda']."'
                      AND   TURNPARA ='".$_GET['parametro_ayuda']."' ";
$RsF_Turno2 = mysqli_query($turnos,$query_RsF_Turno2) ;
  /*    
 $query_RsConsultar_Tur="SELECT `TURNCONS`,
                                 TURNCOAS TURNO,
							    `TURNPARA`
						   FROM `turnos` 
						   WHERE `TURNPARA`='".$_GET['F_parametro']."'
                           AND   `TURNCONS`='".$_GET['F_consecutivo']."'";
						   
$RsConsultar_Tur = mysqli_query($turnos,$query_RsConsultar_Tur) ;
$row_RsConsultar_Tur = mysqli_fetch_assoc($RsConsultar_Tur);	
$turno=$row_RsConsultar_Tur['TURNO'];						   
$r=$turno+1;		
$n="dos";
$retorno=$r.'/'.$_GET['F_parametro'].'/'.$n.'/'.$_GET['F_consecutivo'];		
echo($retorno);
*/
echo('nuevo');
}

if($tipoguardar=='Fin_Atencion'){

//actualizar estado a "FINALIZADO"        
$query_RsF_Turno="UPDATE turnos 
                      SET TURNIDES = '2' 
                      WHERE TURNCONS ='".$_GET['F_consecutivo']."'
                      AND   TURNPARA ='".$_GET['F_parametro']."' ";
$RsF_Turno = mysqli_query($turnos,$query_RsF_Turno) ;

//actualizar fecha fin
 $query_RsF_Turno2="UPDATE turnos 
                      SET TURNFEFI =  SYSDATE()
                      WHERE TURNCONS ='".$_GET['F_consecutivo']."'
                      AND   TURNPARA ='".$_GET['F_parametro']."' ";
$RsF_Turno2 = mysqli_query($turnos,$query_RsF_Turno2) ;

 $query_RsConsultar_Tur="SELECT  TURNCONS,
                                 TURNCOAS TURNO,
								 TURNLETR LETRA,
							     TURNPARA,
								 TURNSERV SERVICIO
								
						   FROM `turnos` 
						   WHERE `TURNPARA` = '".$_GET['F_parametro']."'
                           AND   `TURNCONS` = (SELECT MAX(T2.TURNCONS)
						                        FROM turnos T2
											   WHERE T2.TURNPARA = '".$_GET['F_parametro']."')  
						   ";						   
						   
$RsConsultar_Tur = mysqli_query($turnos,$query_RsConsultar_Tur) ;
$row_RsConsultar_Tur = mysqli_fetch_assoc($RsConsultar_Tur);	
$turno=$row_RsConsultar_Tur['TURNO'];						   
$Fconsecutivo=$row_RsConsultar_Tur['TURNCONS'];						   
$r=$turno+1;		
$n="dos";


//begin
		  $numero_turno = $r;
			$query_RsRangosTurno="SELECT S.SERVRAFI RANGO_FINAL,
			                             S.SERVRAIN RANGO_INICIAL
								   FROM servicios S
								  WHERE S.SERVID = '".$row_RsConsultar_Tur['SERVICIO']."'";
			$RsRangosTurno = mysqli_query($turnos,$query_RsRangosTurno) ;
			$row_RsRangosTurno = mysqli_fetch_assoc($RsRangosTurno);	
			$totalRows_RsRangosTurno = mysqli_num_rows($RsRangosTurno);			
			//$numero_turno = $row_RsConsultar_Tur['TURNO'];
			$no_enter=0;
			if($totalRows_RsRangosTurno>0){
			  $rango_inicial = $row_RsRangosTurno['RANGO_INICIAL'];
			  $rango_final   = $row_RsRangosTurno['RANGO_FINAL'];
			  //$letra_turno  = $_GET['letra_sincronizada'];
			  $letra_turno  = $row_RsConsultar_Tur['LETRA'];
			   if($numero_turno > $rango_final){
			      $numero_turno = $rango_inicial;
				  $TAMANO_ARR_LETRAS=count($ARRAY_LETRAS);
				   if($_GET['letra_sincronizada']!=''){
					  for($s=0; $s<$TAMANO_ARR_LETRAS; $s++){
					   if($ARRAY_LETRAS[$s]==$letra_turno){ 
					    $indice_letra=$s;
					   }
					  }
					  if($indice_letra < ($TAMANO_ARR_LETRAS-1)){
						 $letra_turno=$ARRAY_LETRAS[$indice_letra+1];
						}

					  if($indice_letra==($TAMANO_ARR_LETRAS-1)){
						$letra_turno=$ARRAY_LETRAS[0];
					  }					  
					}
			    }
			}
//end 
//$retorno=$r.'/'.$_GET['F_parametro'].'/'.$n.'/'.$_GET['F_consecutivo'];		
$retorno=$numero_turno.'/'.$_GET['F_parametro'].'/'.$n.'/'.$Fconsecutivo.'/'.$letra_turno;		
echo($retorno);
}		



if($tipoguardar=='Salir_Turno'){
$S_parametro=$_GET['S_parametro'];
$S_consecutivo=$_GET['S_consecutivo'];
$S_idusuario=$_SESSION["IDUSU"];

            $query_RsModulo="
			UPDATE modulos SET MODUESTA = '0', MODUSERV= '' WHERE MODUID ='".$_GET['S_modulo']."'";
			$RsModulo = mysqli_query( $turnos,$query_RsModul);
			
			$query_RsActualizarUsuario="
		   UPDATE usuarios SET USUAESTA = '0' WHERE USUAID ='".$S_idusuario."'";
			$RsActualizarUsuario = mysqli_query( $turnos,$query_RsActualizarUsuario);
			
    $query_RsSalida="UPDATE turnos 
                      SET TURNIDES = '4'
                      WHERE TURNCONS ='".$_GET['S_consecutivo']."'
                      AND   TURNPARA ='".$_GET['S_parametro']."' ";
    $RsSalida = mysqli_query($turnos,$query_RsSalida) ;
	
/*
	$query_RsComprobarEstados="SELECT T.TURNCONS FROM 
	                               turnos T
								WHERE (T.TURNIDUS = '".$_SESSION["IDUSU"]."' OR T.TURNIDAP = '".$_SESSION["IDUSU"]."' )
								  AND T.TURNIDES IN ('3','6')";
*/
	$query_RsComprobarEstados="SELECT T.TURNCONS FROM 
	                               turnos T
								WHERE TURNPARA = '".$_GET['S_consecutivo']."'
								 AND T.TURNIDES IN ('3','6') ";

    $RsComprobarEstados = mysqli_query( $turnos,$query_RsComprobarEstados) ;
	//$row_RsComprobarEstados = mysqli_fetch_assoc($RsComprobarEstados);	
	$totalRows_RsComprobarEstados = mysqli_num_rows($RsComprobarEstados);
if($totalRows_RsComprobarEstados == 0){	
	$query_RsTurnosExistentes="SELECT   T.TURNCONS,
										T.TURNCOAS,
										T.TURNMODU,
										T.TURNIDUS,
										T.TURNFECH,
										T.TURNFEFI,
										T.TURNTURN,
										T.TURNIDES,
										T.TURNPARA,
										T.TURNFELL,
										T.TURNAPOY,
										T.TURNIDAP,
										T.TURNSERV
							FROM turnos T
					    WHERE TURNIDUS = '".$_SESSION["IDUSU"]."'";
	$RsTurnosExistentes = mysqli_query( $turnos,$query_RsTurnosExistentes) ;
	$row_RsTurnosExistentes = mysqli_fetch_assoc($RsTurnosExistentes);	
	$totalRows_RsTurnosExistentes = mysqli_num_rows($RsTurnosExistentes);	
	if($totalRows_RsTurnosExistentes>0){
	  do{
	     $query_RsInsert="INSERT INTO turnosfull(
												 TURNCONS,
												 TURNCOAS,
												 TURNMODU,
												 TURNIDUS,
												 TURNFECH,
												 TURNFEFI,
												 TURNTURN,
												 TURNIDES,
												 TURNPARA,
												 TURNFELL,
												 TURNAPOY,
												 TURNIDAP,
												 TURNSERV
		                                          )
												  VALUES
												  (
												  'NULL',
												  '".$row_RsTurnosExistentes['TURNCOAS']."',
												  '".$row_RsTurnosExistentes['TURNMODU']."',
												  '".$row_RsTurnosExistentes['TURNIDUS']."',
												  '".$row_RsTurnosExistentes['TURNFECH']."',
												  '".$row_RsTurnosExistentes['TURNFEFI']."',
												  '".$row_RsTurnosExistentes['TURNTURN']."',
												  '".$row_RsTurnosExistentes['TURNIDES']."',
												  '".$row_RsTurnosExistentes['TURNPARA']."',
												  '".$row_RsTurnosExistentes['TURNFELL']."',
												  '".$row_RsTurnosExistentes['TURNAPOY']."',
												  '".$row_RsTurnosExistentes['TURNIDAP']."',
												  '".$row_RsTurnosExistentes['TURNSERV']."'
												  )";
	     $RsInsert = mysqli_query($turnos, $query_RsInsert);
		 
		 $query_RsDelete="delete from turnos where TURNCONS = '".$row_RsTurnosExistentes['TURNCONS']."'";
		 $RsDelete = mysqli_query( $turnos,$query_RsDelete);
	    }while($row_RsTurnosExistentes = mysqli_fetch_assoc($RsTurnosExistentes));

		$query_RsTruncarTable = "SELECT count(TURNCONS) CANTIDAD 
		                              FROM TURNOS 
                               ";
		$RsTruncarTable = mysqli_query($turnos,$query_RsTruncarTable) ;
		$row_RsTruncarTable = mysqli_fetch_assoc($RsTruncarTable);	
		//$totalRows_RsTruncarTable = mysqli_num_rows($RsTruncarTable);
		if($row_RsTruncarTable['CANTIDAD']==0){
		  $query_RsTruncar = 'TRUNCATE TABLE TURNOS';
		  $RsTruncar = mysqli_query($turnos,$query_RsTruncar);		  
		}
	
	}

	
}
echo 'salir';

     }
	 
if($tipoguardar == 'Contar_Turno'){

$C_parametro=$_GET['C_parametro'];

$query_RsContadorMax="
	SELECT count( `TURNCONS` ) numero,
	SERVTUMA, 
	SERVTUTA
	FROM `turnos`
	INNER JOIN SERVICIOS ON `TURNMODU` = SERVID
	WHERE `TURNPARA` ='".$C_parametro."'
	AND `TURNIDES` =2";

	$RsContadorMax = mysqli_query($turnos,$query_RsContadorMax);
	$row_RsContadorMax = mysqli_fetch_assoc($RsContadorMax);	
	$Contador=$row_RsContadorMax['numero'];
	
	echo($Contador);
	
}
	 
if($tipoguardar == 'servicio_crear'){
//$_SESSION["ID_SERVI"]=$_GET['C_servicio'];
/*	
	$query_RsContadorMax="UPDATE modulos set MODUSERV = 'M' 
	                       WHERE MODUUSUA = '".$_SESSION["IDUSU"]."'
						    AND  MODUESTA = 1";
	$RsContadorMax = mysqli_query($turnos,$query_RsContadorMax);
*/
	//header('location:home_multiple.php');
			$query_RsServicios="SELECT `SERVID` CODIGO,
						        `SERVNOMB`  NOMBRE,
								`SERVTUMA`,
								`SERVTUTA`,
								`SERVCOLO` 
						FROM `servicios` 
						WHERE 1
						";
		$RsServicios = mysqli_query($turnos,$query_RsServicios);
		$row_RsServicios = mysqli_fetch_assoc($RsServicios);		
		$totalRows_RsServicios = mysqli_num_rows($RsServicios);
		$ARRAY_SERVICIOS=array();
		if($totalRows_RsServicios>0){
		   $i=0;
		  do{
		     
		     if(isset($_POST['servi_'.$row_RsServicios['CODIGO']]) && $_POST['servi_'.$row_RsServicios['CODIGO']]!=''){
			 $ARRAY_SERVICIOS[$i]=$_POST['servi_'.$row_RsServicios['CODIGO']];
			 $i++;
			 }
			 
		    }while($row_RsServicios = mysqli_fetch_assoc($RsServicios));
		//print_r($ARRAY_SERVICIOS);
		}
		$_SESSION["ARR_SERVI"]=$ARRAY_SERVICIOS;
        
		$varios_servicios='';
		for($i=0; $i<count($ARRAY_SERVICIOS); $i++){
		  $varios_servicios=$varios_servicios.','.$ARRAY_SERVICIOS[$i];
		}
		$tamano_servicios=strlen($varios_servicios);
        $serviciosmult=substr($varios_servicios,1,$tamano_servicios);
	$query_RsContadorMax="UPDATE modulos set MODUSERV = '".$serviciosmult."', MODUMULT = 1 
	                       WHERE MODUUSUA = '".$_SESSION["IDUSU"]."'
						    AND  MODUESTA = 1";
	$RsContadorMax = mysqli_query($turnos,$query_RsContadorMax);		

header('location:home_multiple.php');		
}

if($tipoguardar == 'Ayuda_Turno'){

$A_parametro=$_GET['A_parametro'];

$query_RsTurnoMax="SELECT TURNCONS , 
						  MAX( TURNCOAS ) NUMERO,
						  TURNMODU ,
						  TURNIDUS ,
						  TURNFECH ,
						  TURNFEFI ,
						  TURNTURN ,
						  TURNIDES ,
						  TURNPARA ,
						  TURNFELL
					FROM turnos
					WHERE TURNPARA =".$A_parametro."";

	$RsTurnoMax = mysqli_query($turnos,$query_RsTurnoMax);
	$row_RsTurnoMax = mysqli_fetch_assoc($RsTurnoMax);	
	$TurnoMax=$row_RsTurnoMax['NUMERO'];
	
	$_SESSION["ID_PARAMETRO"]   =   $A_parametro;
    $_SESSION["ID_TURNO_ASIGN"] =	$row_RsTurnoMax['NUMERO'];
	
	echo($TurnoMax);
	
}
	 
