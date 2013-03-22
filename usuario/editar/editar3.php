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

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/
$titulo2 = filter_var($_POST['titulo2'], FILTER_SANITIZE_STRING);
$contenido2 = filter_var($_POST['contenido2'], FILTER_SANITIZE_STRING);
$enlace2 = filter_var($_POST['enlace2'], FILTER_SANITIZE_STRING);
$tag2 = filter_var($_POST['tag2'], FILTER_SANITIZE_STRING);
$id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
$rssId = $_SESSION['rssId'];

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



if ( $titulo2 == '' OR $titulo2 == ' '){
	unset($titulo2);
}
if ( $tag2 == ''){
	unset($tag2);
}
if ( $contenido2 == '' OR $contenido2 == ' '){
	unset($contenido2);
}
if ( $enlace2 == '' OR $enlace2 == ' '){
	unset($enlace2);
}

if (isset($titulo2)){
	mysql_query("update $tabla set titulo='$titulo2' where id='$id'");
}
if (isset($tag2)){
	mysql_query("update $tabla set tagId='$tag2' where id='$id'");
}
if (isset($contenido2)){
	mysql_query("update $tabla set contenido='$contenido2' where id='$id'");
}
if (isset($enlace2)){
	mysql_query("update $tabla set enlace='$enlace2' where id='$id'");
}

if ( $titulo2 == '' OR $titulo2 == ' '){
	unset($titulo2);
}
if ( $tag2 == ''){
	unset($tag2);
}
if ( $contenido2 == '' OR $texto2 == ' '){
	unset($texto2);
}
if ( $enlace2 == '' OR $enlace2 == ' '){
	unset($enlace2);
}

// redireccionar de nuevo a index
// echo mysql_error();
// echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
echo "<meta http-equiv='refresh' content='0;URL=?w=rss2&rss=".$rssId."'>";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>
