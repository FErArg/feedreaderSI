<?php
	/**************************************************************************************************
	#     Copyright (c) 2008 - 2013 Fernando A. Rodríguez para SerInformaticos.es                     #
	#                                                                                                 #
	#     Este programa es software libre: usted puede redistribuirlo y / o modificarlo               #
	#     bajo los t&eacute;rminos de la GNU General Public License publicada por la                  #
	#     la Free Software Foundation, bien de la versi&oacute;n 3 de la Licencia, o de               #
	#     la GPL2, o cualquier versi&oacute;n posterior.                                              #
	#                                                                                                 #
	#     Este programa se distribuye con la esperanza de que sea &uacute;til,                        #
	#     pero SIN NINGUNA GARANTÍA, incluso sin la garant&iacute;a impl&iacute;cita de               #
	#     COMERCIABILIDAD o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. V&eacute;ase el                   #
	#     GNU General Public License para m&aacute;s detalles.                                        #
	#                                                                                                 #
	#     Usted deber&iacute;a haber recibido una copia de la Licencia P&uacute;blica General de GNU  #
	#     junto con este programa. Si no, visite <http://www.gnu.org/licenses/>.                      #
	#                                                                                                 #
	#     Puede descargar la version completa de la GPL3 en este enlace:                              #
	#     	< http://www.serinformaticos.es/index.php?file=kop804.php >                               #
	#                                                                                                 #
	#     Para mas información puede contactarnos :                                                   #
	#                                                                                                 #
	#       Teléfono  (+34) 961 19 60 62                                                              #
	#                                                                                                 #
	#       Email:    info@serinformaticos.es                                                         #
	#                                                                                                 #
	#       MSn:      info@serinformaticos.es                                                         #
	#                                                                                                 #
	#       Twitter:  @SerInformaticos                                                                #
	#                                                                                                 #
	#       Web:      www.SerInformaticos.es                                                          #
	#                                                                                                 #
	**************************************************************************************************/


session_start();
$inc="../../inc";
//include("$inc/variables.inc.php");
if ( (isset($_SESSION['AuthenticatedAD']) AND $_SESSION['AuthenticatedAD'] == 1) ){
mysql00();
?>
<?php
/*
echo "<pre>";
	print_r($_POST);
echo "</pre>";
*/

if( isset($_POST['altas']) ){
	$datosAlta = Array( 'alta_usuario' => 'alta_usuario',
						'alta_clave' => 'alta_clave');
	foreach( $datosAlta as $key => $value ){
		$datosAlta[$key] = filter_var($_POST[$value], FILTER_SANITIZE_STRING);
	}
} else{
	die("<br />\n Acceso Incorrecto! - <a href=\"?select\" class=\"botonR\">Volver</a><br />\n");
}

// para control
$i = '0';

// comprobar usuario en db
$campos = 'id';
$tabla = 'usuarios';
$columna1 = 'usuario';
$queBuscar1 = $datosAlta['alta_usuario'];
$compUsuario = mysql02($campos,$tabla,$columna1,$queBuscar1);

echo mysql_error();

if( $compUsuario == TRUE ){
	die("<br />\n Usuario ya Existe! - <a href=\"?select2=ualta\" class=\"botonR\">Volver</a><br />\n");
} elseif( empty($datosAlta['alta_usuario']) ){
	die("<br />\n Campo de Usuario Obligatorio! - <a href=\"?select2=ualta\" class=\"botonR\">Volver</a><br />\n");
} else{
	$control[$i++] = '1';
}

// comprobar clave
if( empty($datosAlta['alta_clave']) ){
	die("<br />\n Campo de Clave Obligatorio! - <a href=\"?select2=ualta\" class=\"botonR\">Volver</a><br />\n");
} elseif( strlen($datosAlta['alta_clave']) < 1 ){
	die("<br />\n Campo de Clave menor a 6 digitos! - <a href=\"?select2=ualta\" class=\"botonR\">Volver</a><br />\n");
} else{
	$datosAlta['alta_clave'] = md5($datosAlta['alta_clave']);
	$control[$i++] = '1';
}

// control que todos los campos de control sean = 1
$j = '1';
$control2 = '';
foreach( $control as $key => $value ){
	if( $value != '1' ){
		echo "Error en campo ".$key;
	} else {
		$control2 = $j++;
	}
}

// si total de control2 es = 2 se cargan datos, sino error
if( $control2 == '2' ){
	// mete datos en DB
	mysql_query("INSERT INTO usuarios (usuario, clave)
	 VALUES ( '$datosAlta[alta_usuario]','$datosAlta[alta_clave]' )" );
	echo mysql_error();

	// elimina datos del array para no poder duplicar info al reload de la página
	foreach( $datosAlta as $key => $value ){
		$datosAlta[$key] = "SerInformaticos";
	}
	// datos cargados y vuelve a inicio
	echo "<br >\n Datos cargados Correctamente";
	echo "<meta http-equiv='refresh' content='2;URL=?select='>";
} else{
	echo "<br >\n No se Cargan datos en DB";
	echo "<br />\n Faltan Datos o algún dato Erroneo! - <a href=\"?select2=ualta\" class=\"botonR\">Volver</a><br />\n";
}


?>
<?php
// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<br />\n<a href=\"../index.php\" class=\"botonR\">Volver</a><br /><br />\n";
}
// Control de la sesion ----------------------------------------------------------------------
?>

