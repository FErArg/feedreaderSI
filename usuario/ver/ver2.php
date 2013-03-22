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
echo "<br />\n";

/*
echo "<pre>";
	print_r($_GET);
echo "</pre>";
*/

$id = filter_var($_GET['i'], FILTER_SANITIZE_STRING);
$rssId = filter_var($_GET['r'], FILTER_SANITIZE_STRING);
// echo $id." - ".$rssId;

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

$query = "SELECT fecha, titulo, contenido, enlace, tagId, importante, protegido FROM feeds WHERE id = '$id' AND usuarioID ='$usuarioId'";
$array00 = mysql03($query);
/*
echo "<pre>";
print_r($array00);
echo "</pre>";
*/

$array01 = array(
	'ID' => $id,
	'Fecha' => $array00[0],
	'Titulo' => $array00[1],
	'Contenido' => $array00[2],
	'Enlace' => "<a href=?w=ver3&e=\"".$array00[3]."&i=".$id." target=\"_blank\">".$array00[3]."</a>",
	'Tag' => $array00[4]);

$importante = $array00[5];
$protegido = $array00[6];

// fecha
$array01['Fecha'] = fechaDesdeUnix($array01[Fecha]);

// tagId a tag
$dondeBuscar = 'tag';
$tabla = 'tags';
$enQueColumna = 'id';
$queBuscar = $array01['Tag'];
$array01['Tag'] = mysql02($dondeBuscar,$tabla,$enQueColumna,$queBuscar);

// contenido
$array01['Contenido'] = mostrarTexto($array01['Contenido']);

$value = $array01;

echo "<table>\n";
echo "<tr>\n";

// editar
$editar = <<<_EDITAR
<td><a class="botonFormulario1" href="?w=editar2&i=$value[ID]">Editar</a></td>\n
_EDITAR;
		echo $editar;

// email
$email = <<<_EMAIL
<td><a class="botonFormulario1" href="?w=email1&i=$value[ID]">eMail</a></td>\n
_EMAIL;
		echo $email;

// eliminar
$eliminar = <<<_ELIMINAR
<td><a class="botonFormulario1" href="?w=eliminar3&i=$value[ID]&r=$rssId&o=ver2">Eliminar</a></td>\n
_ELIMINAR;
		echo $eliminar;

// protegido
if( $protegido == '1' ){
	$botonP = 'botonFormulario2';
} else{
	$botonP = 'botonFormulario1';
}
$protegido = <<<_PROTEGIDO
<td><a class="$botonP" href="?w=protegido2&i=$value[ID]&r=$rssId&o=importante&p=$protegido">Protegido</a></td>\n
_PROTEGIDO;
		echo $protegido;

// Importante
if( $importante == '1' ){
	$botonI = 'botonFormulario2';
} else{
	$botonI = 'botonFormulario1';
}
$importante = <<<_IMPORTANTE
<td><a class="$botonI" href="?w=importante2&i=$value[ID]&r=$rssId&o=ver2&im=$importante">Importante</a></td>\n
_IMPORTANTE;
		echo $importante;

$volver = <<<_VOLVER
<td><input class="botonFormulario1" type="button" value="Volver" name="ClickBack" onclick=(history.back())></td>\n
_VOLVER;
echo $volver;

echo "</tr>\n";
echo "</table>\n";

$array2 = tabla01($array01);
foreach ( $array2 as $value1){
	echo $value1;
}
echo "<br />\n";
echo "<table>\n";
echo "<tr>\n";


		echo $editar;

		echo $email;

		echo $eliminar;

		echo $protegido;

		echo $importante;

		echo $volver;

echo "</tr>\n";
echo "</table>\n";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
