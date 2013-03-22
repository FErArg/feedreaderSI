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
print_r($_GET);
echo "</pre>";
*/
$origen = filter_var($_POST[campos][3], FILTER_SANITIZE_STRING);
$origen2 = filter_var($_POST[campos][2], FILTER_SANITIZE_STRING);
$accion = filter_var($_POST['accion'], FILTER_SANITIZE_STRING);
$filtro = filter_var($_POST[$origen], FILTER_SANITIZE_STRING);
$filtroId = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);
// echo $origen." - ".$accion." - ".$material."<br />";

if( $accion != 'agregar' AND $filtro == '' ){
	echo "<h2>debe seleccionar ".$origen2."</h2>\n<br />";
	die ("<br />\n<a href=\"?i=".$origen2."\" class=\"botonRojo1\">Volver</a><br /><br />\n");
}

switch($accion){
    case 'ver';
		echo "<meta http-equiv='refresh' content='0;URL=?w=filtro&t=".$filtroId."'>";
    break;
    case 'agregar';
		echo "<meta http-equiv='refresh' content='0;URL=?w=fil&o=".$origen2."&b=".$accion."'>";
    break;
    case 'editar';
		echo "<meta http-equiv='refresh' content='0;URL=?w=fil&o=".$origen2."&b=".$accion."&f=".$filtro."'>";
    break;
    case 'eliminar';
		echo "<meta http-equiv='refresh' content='0;URL=?w=fil&o=".$origen2."&b=".$accion."&f=".$filtro."'>";
    break;
}

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
