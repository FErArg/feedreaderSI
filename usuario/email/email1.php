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

// comprobar que el post al que se accede es del usuario, si no es el
// dueño, lo redirecciona al inicio de usuario
$campos = 'usuarioId';
$tabla = 'feeds';
$columna1 = 'id';
$queBuscar1 = $id;
$usuarioPost = mysql02($campos,$tabla,$columna1,$queBuscar1);
if( $usuarioPost != $usuarioId ){
	echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
}

$fechaHoy = date('Y-m-d h:i:s');

$query = "SELECT fecha, titulo, contenido, enlace, rssId FROM feeds WHERE id = '$id'";
$array00 = mysql03($query);

$array01 = array(
	'ID' => $id,
	'Fecha' => $array00[0],
	'Titulo' => $array00[1],
	'Contenido' => $array00[2],
	'Enlace' => $array00[3],
	'RssId' => $array00[4],);

// fecha
$array01['Fecha'] = fechaDesdeUnix($array01[Fecha]);

// contenido
$array01['Contenido'] = mostrarTexto($array01['Contenido']);
$array01['Contenido2'] = $array01['Enlace']." \n \n ".$array01['Contenido'];

echo "<form action=\"?w=email2\" method=\"POST\">\n";
echo "<input type=\"hidden\" name=\"id\" value=\"".$array01['ID']."\" />\n";
echo "<input type=\"hidden\" name=\"rssId\" value=\"".$array01['RssId']."\" />\n";
echo "<table id=\"one-column-emphasis\" >
    <colgroup>
    	<col class=\"oce-first\" />
    </colgroup>
    <tbody>";
	echo "<tr>";
		echo "<td>";
			echo "Para";
		echo "</td>\n";
		echo "<td>";
			echo "<input type=\"text\" class=\"text\" name=\"para\" size=\"90\" maxlength=\"100\" />";
		echo "</td>\n";
	echo "<tr>";
		echo "<td>";
			echo "Asunto";
		echo "</td>\n";
		echo "<td>";
			echo "<input type=\"text\" class=\"text\" name=\"asunto\" size=\"90\" maxlength=\"100\" value=\"".$array01['Titulo']."\" />";
		echo "</td>\n";
	echo "</tr>\n";
	echo "<tr>";
		echo "<td>";
			echo "Contenido";
		echo "</td>\n";
		echo "<td>";
			echo "<textarea cols=\"90\" class=\"text\" rows=\"10\" name=\"contenido\">".$array01['Contenido2']."</textarea>";
		echo "</td>\n";
	echo "</tr>\n";
echo "</tbody>\n</table>\n";

$volver = <<<_VOLVER
		<input class="botonFormulario1" type="button" value="Volver" name="ClickBack" onclick=(history.back())>
_VOLVER;
		echo $volver;

echo "<input class=\"botonFormulario1\" id=\"saveForm\" class=\"button_text\" type=\"submit\" name=\"submit\" value=\"Enviar\" />";
echo "</form>";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
