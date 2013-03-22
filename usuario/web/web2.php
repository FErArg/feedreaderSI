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
// extract($_POST);
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

$enlace = filter_var($_POST['enlace'], FILTER_SANITIZE_STRING);
$enlace = trim($enlace);
$enlace = rtrim($enlace);

$tagId = filter_var($_POST['tagId'], FILTER_SANITIZE_STRING);

if( empty($enlace) ){
	echo "<meta http-equiv='refresh' content='0;URL=?w=inicio'>";
}



// Descarga Web
$web = file_get_contents($enlace);

// limpia el contenido de la web
$contenido = str_replace('<script type=\'text/javascript\'>',"<!--", $web);
$contenido = str_replace('<script',"<!--", $contenido);
$contenido = str_replace('</script>',"-->", $contenido);
$contenido = str_replace('<!-->','<!--', $contenido);
$contenido = preg_replace('/<!--(.*)-->/', '', $contenido);
$contenido = strip_html_tags($contenido);

$contenido = limpiarTexto2($contenido);

// limpia comentarios, creo que no funciona
$tokens = token_get_all( $contenido );
foreach ( $tokens as $token ){
    if ( T_COMMENT == $token['0'] ){
        $contenido = str_replace($token['1'], '', $contenido);
    }
}

// titulo de la pagina
$titulo = getTitle($enlace);
$titulo = trim($titulo);
$titulo = rtrim($titulo);
$titulo = limpiarTexto2($titulo);
$titulo = strip_html_tags($titulo);

$enlace = limpiarTexto2($enlace);

if( empty($tagId) ){
	$tagId = '1';
}

$rssId = '9999';
$fecha = time();
$importante = '1';
$eliminado = '0';
$visitas = '1';
$protegido = '0';

/*
echo $fecha." - ".$titulo." - ".$enlace."<br />";
echo $contenido."<br />";
*/

// busca que el titulo no exista ya en la base de datos
$campos = 'id';
$tabla = 'feeds';
$columna1 = 'titulo';
$queBuscar1 = $titulo;
$resultado1 = mysql02($campos,$tabla,$columna1,$queBuscar1);
//echo $resultado1."<br /> \n";

$tituloMd5 = md5($titulo);
$resultado1Md5 = md5($resultado1);

if( $tituloMd5 != $resultado1Md5 AND isset($enlace) AND $enlace != '' AND $enlace != ' '){
	mysql_query("insert into feeds (usuarioId, rssId, titulo, fecha, enlace, contenido, importante, eliminado, tagId, visitas, protegido)
		values ('$usuarioId','$rssId','$titulo','$fecha','$enlace','$contenido','$importante','$eliminado','$tagId','$visitas','$protegido')");
	echo mysql_error();
} else {
	echo "<h2><p class=\"botonR\">Ya existe el artículo</p></h2>";
	echo "<meta http-equiv='refresh' content='3;URL=?w=inicio'>";
}

// borrar variables
unset($titulo);
unset($contenido);
unset($rssId);
unset($fecha);
unset($importante);
unset($enlace);
unset($eliminado);
unset($tagId);

// redireccionar de nuevo a index
echo "<meta http-equiv='refresh' content='0;URL=?w=inicio'>";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}

?>
