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
include('../../inc/framework.php');
include('../../inc/header2.php');

if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){
mysql00();

$menu = array( 'Ver' => '?w=feedsc',
			   'Agregar' => '?w=feedsa',
			   'Editar' => '?w=feedse2',);
foreach( menu00($menu) as $value){
	echo $value;
}

//	echo "<br /><p></p><br />\n";
	echo "<p></p>\n";

$selection = filter_var($_GET['w'], FILTER_SANITIZE_STRING);
switch($selection)
{
	// CONFIGURACION FEEDS ---------------------------------------------
    case 'feedsc';
		include('ver.php');
	break;
    case 'ver2';
		include('ver2.php');
	break;

    case 'feedsa';
		include('agregar.php');
	break;
    case 'feedsa2';
		include('agregar2.php');
	break;

    case 'editar2';
		include('editar2.php');
	break;
    case 'editar3';
		include('editar3.php');
	break;

    case 'eliminar3';
		include('eliminar3.php');
	break;

    case 'volver';
		echo "<meta http-equiv='refresh' content='0;URL=../'>";
	break;

	// Default ---------------------------------------------------------
    default;
        include('ver.php');
    break;
}

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
}
// Control de la sesion ----------------------------------------------------------------------
include('../../inc/footer.php');
?>
