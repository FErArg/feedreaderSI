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

echo "<h3>Editar #2</h3> \n<br />";
/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
echo "</pre>";
*/
foreach( $_POST as $key => $value ){
	$material[strtolower($key)] = filter_var($value, FILTER_SANITIZE_STRING);
}

foreach( $material as $key => $value ){
	if( $key != 'id' ){
		$campos = $key;
		$tabla = 'filtros';
		$columna1 = 'id';
		$queBuscar1 = $material['id'];
		$resultado = mysql12($campos,$tabla,$columna1,$queBuscar1);
		$rtdoMd5 = md5($resultado['0'][$key]);
		$valueMd5 = md5($value2);
		echo $rtdoMd5." - ".$valueMd5."<br />";
		echo $key." - ".$value." rtdo: ".$resultado[0][$key]."<br />";
		if( $rtdoMd5 != $valueMd5 ){
			// echo "<h3>Se actualiza campo ".$key." con nuevo valor</h3> \n<br />";
			mysql_query("UPDATE filtros SET $key='$value' WHERE id='$material[id]'");
			echo mysql_error();
		} else{
			echo "<h3>No se actualiza campo ".ucwords($material['o'])."</h3> \n<br />";
		}
	}
}
echo "<br />";
foreach( $material as $key1 => $value1 ){
	unset($material[$key1]);
}

echo "<meta http-equiv='refresh' content='3;URL=?w=inicio'>";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
