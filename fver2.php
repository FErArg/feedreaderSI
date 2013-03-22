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

echo "<br />\n";

$id = filter_var($_GET['i'], FILTER_SANITIZE_STRING);

/*
echo "<pre>";
	print_r($_POST);
echo "</pre>";
*/
$query = "SELECT rss FROM rss WHERE id = '$id' AND usuarioID ='$usuarioId'";
$array00 = mysql03($query);

// print_r($array00);

$array01 = array(
	'ID' => $id,
	'Rss' => $array00[0]);

$array2 = tabla01($array01);
foreach ( $array2 as $value){
	echo $value;
}
echo "<br />\n";
echo "<table>\n";
echo "<tr>\n";
// editar
$editar = <<<_EDITAR
<td><a class="botonFormulario1" href="?w=feditar2&i=$array01[ID]">Editar</a></td>\n
_EDITAR;
echo $editar;

// eliminar
$eliminar = <<<_ELIMINAR
<td><a class="botonFormulario1" href="?w=feliminar3&i=$array01[ID]">Eliminar</a></td>\n
_ELIMINAR;
echo $eliminar;

$volver = <<<_VOLVER
<td><input class="botonFormulario1" type="button" value="Volver" name="ClickBack" onclick=(history.back())></td>\n
_VOLVER;
echo $volver;

echo "</tr>\n";
echo "</table>\n";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
