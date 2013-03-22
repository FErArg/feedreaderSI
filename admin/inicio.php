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
$inc="../inc";
$inc2="";
//include("$inc/variables.inc.php");
$titulo1 = "Inicio de ".$usuario;
if ( isset($_SESSION['AuthenticatedAD']) AND $_SESSION['AuthenticatedAD'] == 1 ){
mysql00();
?>
<?php
echo "<ul>";
// Noticias del Sistema
	$campos = 'visitas';
	$tabla1 = 'feeds';
	$query1="SELECT SUM($campos) FROM $tabla1";
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	echo mysql_error();
	echo "<li> Visitas a Post del Sistema: ".$resultado[0]."</a></li>";

// Noticias del Sistema
	$campos = 'id';
	$tabla1 = 'feeds';
	$query1="select count($campos) from $tabla1";
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	echo mysql_error();
	echo "<li> Enlaces del Sistema: ".$resultado[0]."</a></li>";

// Numero de Usuarios
	// hay que filtrar por prioridad urgente y por estado leido o no leido
	$campos = 'id';
	$tabla1 = 'usuarios';
	$query1="select count($campos) from $tabla1";
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	echo mysql_error();
	echo "<li> Usuarios del Sistema: ".$resultado[0]."</a></li>";


echo "</ul>";
?>
<?php
// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>
