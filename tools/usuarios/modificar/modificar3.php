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

if ( (isset($_SESSION['AuthenticatedAD']) AND $_SESSION['AuthenticatedAD'] == 1) ){
mysql00();

/*
echo "<pre>";
	print_r($_POST);
echo "</pre>";
*/
	if( isset($_SESSION['modificar']) AND $_SESSION['modificar'] == '3' ){
		$datosModificar['modificar_usuario'] = filter_var($_POST['modificar_usuario'], FILTER_SANITIZE_STRING);
		$datosModificar['modificar_clave'] = filter_var($_POST['modificar_clave'], FILTER_SANITIZE_STRING);
		$datosModificar['modificar_id'] = filter_var($_POST['modificar_id'], FILTER_SANITIZE_STRING);

		if( isset($datosModificar['modificar_usuario']) AND $datosModificar['modificar_usuario'] != '' AND $datosModificar['modificar_usuario'] != ' ' ){
			// UPDATE
			mysql_query("update usuarios set usuario='$datosModificar[modificar_usuario]' where id='$datosModificar[modificar_id]'");
		}

		// comprobar clave
		if( isset($datosModificar['modificar_clave']) AND $datosModificar['modificar_clave'] != '' AND $datosModificar['modificar_clave'] != ' ' ){
			if( strlen($datosModificar['modificar_clave']) < 1 ){
				die("<br />\n Campo de Clave menor a 6 digitos! - <a href=\"?select2=ualta\" class=\"botonR\">Volver</a><br />\n");
			} else{
				$datosModificar['modificar_clave'] = md5($datosModificar['modificar_clave']);
				mysql_query("update usuarios set clave='$datosModificar[modificar_clave]' where id='$datosModificar[modificar_id]'");
			}
		}

		// elimina datos del array para no poder duplicar info al reload de la página
		foreach( $datosModificar as $key => $value ){
			$datosModificar[$key] = "SerInformaticos";
			$usuario = "SerInformaticos";
			$clave = "SerInformaticos";
		}

		// datos cargados y vuelve a inicio
		echo "<br >\n Datos cargados Correctamente";
		echo "<meta http-equiv='refresh' content='2;URL=?select='>";
	} else{
		echo "<br >\n No se Cargan datos en DB";
		echo "<br />\n Faltan Datos o algún dato Erroneo! - <a href=\"?select\" class=\"botonR\">Volver</a><br />\n";
	}



?>
<?php
// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>

