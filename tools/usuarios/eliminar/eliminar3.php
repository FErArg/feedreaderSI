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
if( isset($_SESSION['eliminar']) AND $_SESSION['eliminar'] == '3' ){
	$idUsuarioEliminar3 = filter_var($_GET['idUsuarioEliminar3'], FILTER_SANITIZE_STRING);

	if( $idUsuarioEliminar3 == '1' OR $idUsuarioEliminar3 == '2' ){
		echo "No se puede Eliminar Este Usuario";
		echo "<meta http-equiv='refresh' content='2;URL=?select='>";
	} else{

		// BUSCAR USUARIO EN db E IMPRIMIR TODOS LOS DATOS
		$campos = 'usuario';
		$tabla = 'usuarios';
		$enQueColumna = 'id';
		$queBuscarEnColumna = $idUsuarioEliminar3;
		$resultado0 = mysql12($campos,$tabla,$enQueColumna,$queBuscarEnColumna);
		$resultado = $resultado0[0]['usuario'];

		echo "Usuario <p class=\"boton1\">".$resultado."</p> eliminado";

		// elimina de db
		$tabla = 'usuarios';
		$columna1 = 'id';
		$queBuscar1 = $idUsuarioEliminar3;
		mysql_query("DELETE FROM $tabla WHERE $columna1 ='$queBuscar1'");

		unset($_SESSION['eliminar']);
		echo "<meta http-equiv='refresh' content='1;URL=?select='>";
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

