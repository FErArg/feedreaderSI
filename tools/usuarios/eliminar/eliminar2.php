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
if( isset($_SESSION['eliminar']) AND $_SESSION['eliminar'] == '2' ){
	$idUsuarioEliminar = filter_var($_GET['idUsuarioEliminar'], FILTER_SANITIZE_STRING);

	if( $idUsuarioEliminar == '1' OR $idUsuarioEliminar == '2' ){
		echo "No se puede Eliminar Este Usuario";
		echo "<meta http-equiv='refresh' content='2;URL=?select='>";
	} else{

		// BUSCAR USUARIO EN db E IMPRIMIR TODOS LOS DATOS
		$campos = '*';
		$tabla = 'usuarios';
		$enQueColumna = 'id';
		$queBuscarEnColumna = $idUsuarioEliminar;
		$resultado0 = mysql12($campos,$tabla,$enQueColumna,$queBuscarEnColumna);
		$resultado = $resultado0[0];

		echo "<h3>Usuario a Eliminar</h3>";

		// imprime en tabla de 2 columnas el array que contiene todos los datos
		// del mensaje
		echo "<br /><table class=\"one-column-emphasis\">";
		echo "<colgroup>
				<col class=\"oce-first\" />
			</colgroup>";
		echo "<tbody>";
		foreach( $resultado as $key => $value ){
			echo "
				<tr>
					<td>".$key."</td>
					<td>".$value."</td>
				</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		$idUsuarioEliminar3 = $idUsuarioEliminar;

		// control para pasar a eliminar3.php
		$_SESSION['eliminar'] = '3';

		// eliminar usuario
		echo "<td><a href=\"?select2=uelimina3&idUsuarioEliminar3=".$idUsuarioEliminar3."\" class=\"botonR\">Eliminar</a></td>";
	}
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

