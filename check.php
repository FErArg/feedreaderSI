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
include('inc/framework.php');
mysql00();

// comprueba si es escritorio o movil
$mobile = movilCheck01();
if($mobile == 'TRUE'){
	// echo " template movil";
	$_SESSION['style'] = 'mobile.css';
	$_SESSION['tipo'] = 'm';
} else{
	// echo " template PC";
	$_SESSION['style'] = 'desktop.css';
	$_SESSION['tipo'] = 'd';
}

if( isset($_POST['login']) ){
	$usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
	$clave = filter_var($_POST['clave'], FILTER_SANITIZE_STRING);

	visitas($usuario);

	if ( isset($usuario) AND isset($clave) ){
		$getuser="SELECT clave, id FROM usuarios WHERE usuario = '$usuario'";
		$getuser1=mysql_query($getuser);
		$datosDB=mysql_fetch_row($getuser1);
		$claveMD5=md5($clave);

		if( isset($datosDB[0]) AND $datosDB[0] == $claveMD5 ){
			if ( $datosDB[1] == '1' ){
				session_regenerate_id(); // genera nuevo ID de session
				$_SESSION['AuthenticatedAD'] = 1;
				$_SESSION['usuarioId'] = $datosDB[1];
				$_SESSION['usuario'] = $usuario;
				session_write_close();
				echo "<meta http-equiv='refresh' content='0;URL=admin/'>";
			} else{
				session_regenerate_id(); // genera nuevo ID de session
				$_SESSION['Authenticated'] = 1;
				$_SESSION['usuarioId'] = $datosDB[1];
				$_SESSION['usuario'] = $usuario;
				session_write_close();
				echo "<meta http-equiv='refresh' content='0;URL=usuario/'>";
			}
		}else{
			$_SESSION['Authenticated'] = 0;
			echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
		}
	}else{
		echo "<br /><br />";
		echo "<h3>Error en Datos</h3>";
		echo "<br />\n<a href=\"index.php\">Volver</a><br /><br />\n";
	}
}
if( isset($_GET['logout']) ){
	session_destroy();
	header('Location: index.php');
	echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
