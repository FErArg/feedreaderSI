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

$id = filter_var($_GET['i'], FILTER_SANITIZE_STRING);

/*
echo $id;
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

mysql_query("DELETE FROM rss WHERE id='$id'");

// busca todos los feeds del rss eliminado, y le cambi ael feed a "huerfano"
$campos = 'id';
$tabla = 'feeds';
$columna1 = 'rssId';
$queBuscar1 = $id;
$columna2 = 'usuarioId';
$queBuscar2 = $usuarioId;
$resultado = mysql12B($campos, $tabla, $columna1, $queBuscar1, $columna2, $queBuscar2);
/*
echo "<pre>";
print_r($resultado);
echo "</pre>";
*/
foreach( $resultado as $value ){
	echo $value['id']." - ".$usuarioId."<br>";
	mysql_query("UPDATE feeds SET rssId='1' WHERE id='$value[id]' AND usuarioId='$usuarioId'");
	echo mysql_error();
}
// redireccionar de nuevo a index
echo mysql_error();
echo "<meta http-equiv='refresh' content='0;URL=?w=inicio'>";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>
