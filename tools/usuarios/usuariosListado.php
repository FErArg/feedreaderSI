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
// include("$inc/framework.php");
if ( (isset($_SESSION['AuthenticatedAD']) AND $_SESSION['AuthenticatedAD'] == 1) ){
mysql00();
?>
<?php

$tabla = 'usuarios';
$resultado = mysql04($tabla);
echo mysql_error();
echo "<table id=\"box-table-a\">";
 foreach( $resultado as $value ){
	echo $value;
}
echo "</table>";

?>
<?php
// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<br />\n<a href=\"../index.php\" class=\"botonR\">Volver</a><br /><br />\n";
}
// Control de la sesion ----------------------------------------------------------------------
?>

