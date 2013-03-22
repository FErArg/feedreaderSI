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

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

$id = filter_var($_GET['i'], FILTER_SANITIZE_STRING);

$fechaHoy = date('Y-m-d h:i:s');

$query = "SELECT nombre, rss FROM rss WHERE id = '$id'";
$array00 = mysql03($query);

$array01 = array(
	'ID' => $id,
	'Nombre' => $array00[0],
	'Rss' => $array00[1]);

echo "<br />";
echo "<form action=\"?w=feditar3\" method=\"POST\">\n";
echo "<input type=\"hidden\" name=\"tabla\" value=\"rss\" />\n";
echo "<input type=\"hidden\" name=\"id\" value=\"".$array01['ID']."\" />\n";

echo "<table id=\"one-column-emphasis\" >
    <colgroup>
    	<col class=\"oce-first\" />
    </colgroup>
    <tbody>";
	echo "<tr>";
		echo "<td>";
			echo "ID";
		echo "</td>\n";
		echo "<td>";
			echo $array01['ID'];
		echo "</td>\n";
	echo "<tr>";
		echo "<td>";
			echo "Nombre";
		echo "</td>\n";
		echo "<td>";
			echo "<input type=\"text\" class=\"text\" name=\"nombre2\" size=\"50\" maxlength=\"100\" value=\"".$array01['Nombre']."\" />";
		echo "</td>\n";
	echo "<tr>";
		echo "<td>";
			echo "Rss";
		echo "</td>\n";
		echo "<td>";
			echo "<input type=\"text\" class=\"text\" name=\"rss2\" size=\"50\" maxlength=\"100\" value=\"".$array01['Rss']."\" />";
		echo "</td>\n";
	echo "</tr>\n";

echo "</tbody>\n</table>\n";
echo "<button type=\"button\" class=\"botonFormulario1\"><a href=\"?w=inicio\">Volver</a></button>";
echo "<input id=\"saveForm\" class=\"botonFormulario1\" type=\"submit\" name=\"submit\" value=\"Enviar\" />";
echo "</form>";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
