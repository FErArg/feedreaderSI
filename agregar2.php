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


if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

	echo "<h3>Agregar #2</h3> \n<br />";
/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
echo "</pre>";
*/
$material = array();
foreach( $_POST as $key => $value ){
	$material[$key] = filter_var($value, FILTER_SANITIZE_STRING);
	$material[$key] = limpiarTexto2($material[$key]);
	$material[$key] = strtolower($material[$key]);
}

// comprueba que no exista en DB

foreach( $material as $key => $value ){
	$tabla = "tags";
	$check0="SELECT id FROM $tabla WHERE $key = '$value'";
	$check1=mysql_query($check0);
	$check=mysql_fetch_row($check1);

	if ( isset($check) AND $check != '' AND $check != ' ' ) {
		echo "<br />\nMaterial ".$key." ".$value." ya existe!<br /><br />\n";
		die("<br />\n<a href=\"?w=inicio\" class=\"botonRojo1\">Volver</a><br /><br />\n");
	} else{
		echo $key ." ".$value;
		// AGREGAR EN DB
		mysql_query("INSERT INTO $tabla ($key) VALUE ('$value')");
		echo mysql_error();
		echo "<br />\nMaterial ".$key." ".$value." agregado correctamente!<br /><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
	}
}

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
