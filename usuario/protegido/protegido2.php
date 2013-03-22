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
*/

$id = filter_var($_GET['i'], FILTER_SANITIZE_STRING);
$origen = filter_var($_GET['o'], FILTER_SANITIZE_STRING);
$rssId = filter_var($_GET['r'], FILTER_SANITIZE_STRING);
$protegido = filter_var($_GET['p'], FILTER_SANITIZE_STRING);

// comprobar que el post al que se accede es del usuario, si no es el
// dueño, lo redirecciona al inicio de usuario
$campos = 'usuarioId';
$tabla = 'feeds';
$columna1 = 'id';
$queBuscar1 = $id;
$usuarioPost = mysql02($campos,$tabla,$columna1,$queBuscar1);
if( $usuarioPost != $usuarioId ){
	echo "<meta http-equiv='refresh' content='0;URL=?w=inicio'>";
}

// pedir nro visitas
$campos = 'visitas';
$tabla = 'feeds';
$columna1 = 'id';
$queBuscar1 = $id;
$resultado = mysql02($campos,$tabla,$columna1,$queBuscar1);
// echo $resultado."<br />\n";

// sumar visitas
$visitasN = $resultado + 1;

// actualizar visitas
mysql_query("update feeds set visitas='$visitasN' where id='$id'");

if( $protegido == '0' ){
	// marca como protegido
	mysql_query("UPDATE feeds SET protegido='1' WHERE id='$id'");
	echo mysql_error();
} else{
	mysql_query("UPDATE feeds SET protegido='0' WHERE id='$id'");
	echo mysql_error();
}

// redireccionar de nuevo a index
if( isset($origen) ){
	switch($origen){
		case 'rss2';
			echo "<meta http-equiv='refresh' content='0;URL=?w=rss2&rss=".$rssId."'>";
		break;

		case 'ver';
			echo "<meta http-equiv='refresh' content='0;URL=?w=ver'>";
		break;

		case 'importante';
			echo "<meta http-equiv='refresh' content='0;URL=?w=importante'>";
		break;

		case 'protegido';
			echo "<meta http-equiv='refresh' content='0;URL=?w=protegido'>";
		break;

		case 'tag';
			echo "<meta http-equiv='refresh' content='0;URL=?w=tag&t=$rssId'>";
		break;

	    default;
			echo "<meta http-equiv='refresh' content='0;URL=?w=inicio'>";
		break;
	}
} else{
	echo "<meta http-equiv='refresh' content='0;URL=?w=inicio'>";
}

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>
