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
	print_r($value);
echo "</pre>";
*/

if( isset($_SESSION['modificar']) AND $_SESSION['modificar'] == '2' ){
	$idUsuarioModificar = filter_var($_GET['idUsuarioModificar'], FILTER_SANITIZE_STRING);

		// BUSCAR USUARIO EN db E IMPRIMIR TODOS LOS DATOS
		$campos = '*';
		$tabla = 'usuarios';
		$enQueColumna = 'id';
		$queBuscarEnColumna = $idUsuarioModificar;
		$resultado0 = mysql12($campos,$tabla,$enQueColumna,$queBuscarEnColumna);
		$resultado = $resultado0[0];

		echo "<h3>Usuario a Modificar</h3>";

echo "<form action=\"?select2=umodifica3\" method=\"POST\">";

		// imprime en tabla de 2 columnas el array que contiene todos los datos
		// del mensaje
		echo "<br /><table class=\"one-column-emphasis\">";
		echo "<colgroup>
				<col class=\"oce-first\" />
			</colgroup>";
		echo "<tbody>";
		foreach( $resultado as $key => $value ){
			if( $key == 'id') {
				echo "
					<tr>
						<td>".$key."</td><td></td>
						<td>".$value."</td><td>Nuevos Datos</td>
					</tr>";
			} elseif( $key == 'usuario') {
				echo "
					<tr>
						<td>".$key."</td><td></td>
						<td>".$value."</td><td><input type=\"text\" name=\"modificar_usuario\" /></td>
					</tr>";
			} elseif( $key == 'clave') {
				echo "
					<tr>
						<td>".$key."</td><td></td>
						<td>".$value."</td><td><input type=\"password\" name=\"modificar_clave\" /></td>
					</tr>";
			}
		}
		echo "</tbody>";
		echo "</table>";
		$idUsuarioModificar3 = $idUsuarioModificar;

		// control para pasar a eliminar3.php
		$_SESSION['modificar'] = '3';

echo "<input type=\"hidden\" name=\"modificar\" />
	<input type=\"hidden\" name=\"modificar_id\" value=\"".$resultado[id]."\" />
	<input type=\"reset\" class=\"reset\">
	<input type=\"submit\" value=\"Modificar\" name=\"submit\" class=\"submit\" />
</form>";





		// eliminar usuario
	//	echo "<td><a href=\"?select2=umodifica3&idUsuarioModificar3=".$idUsuarioModificar3."\" class=\"botonR\">Modificar</a></td>";

} else{
	die("<br />\n Acceso Incorrecto! - <a href=\"?select\" class=\"botonR\">Volver</a><br />\n");
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

