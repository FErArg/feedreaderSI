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



// session_start();
include('inc/framework.php');

/*
Para Ejecutar en Cron, agregar la siguiente línea

php -f /var/www/feedreaderSI/cargar-cron.php > /dev/null 2>&1

*/

mysql00();

require_once('magpierss/rss_fetch.inc');

// buscar todos los usuarios de la DB
$campo = 'id';
$tabla = 'usuarios';
$usuarios = mysql06($campo,$tabla);

foreach( $usuarios as $usuarioId){
	// buscar todos los feeds del usuario
	$tabla = 'rss';
	$campos = 'rss, tagId, id';
	$columna1 = 'usuarioId';
	$queBuscar1 = $usuarioId;
	$resultado = mysql12($campos,$tabla,$columna1,$queBuscar1);

	echo mysql_error();

	// buscar todos los filtros del usuario
	$tabla = 'filtros';
	$campos = 'filtro';
	$columna1 = 'usuarioId';
	$queBuscar1 = $usuarioId;
	$filtros = mysql12($campos,$tabla,$columna1,$queBuscar1);

	$h = '0';
	$filtro3 = '';
	foreach( $filtros as $key => $value ){
		$filtros2[$h] = $value['filtro'];
	//	$filtro3 = $filtro3." ".$value['filtro'];
		$h++;
	}
	$filtrosNro = count($filtros2);

	$i = '0';
	$urlArray = array();
	foreach($resultado as $key => $value){
		$urlArray[$i]['url'] = $value['rss'];
		$urlArray[$i]['tagId'] = $value['tagId'];
		$urlArray[$i]['id'] = $value['id'];
		$i++;
	}


	foreach( $urlArray as $value ){
		$url = $value['url'];
		$tagId = $value['tagId'];
		$rssId = $value['id'];
		// echo $url ." - ".$tagId."<br />";

		$rss = fetch_rss($url);
		$feed = array();
		// $i = '0';
		foreach ($rss->items as $item):
				$title1 = $item['title'];
				$fecha1 = $item['pubdate'];
				$fecha2 = $item['date_timestamp'];
				$fecha3 = $item['updated'];
				$contenido1 = $item['content']['encoded'];
				$contenido2 = $item['atom_content'];
				$contenido3 = $item['description'];
				$url1 = $item['link'];
				$url2 = $item['feedburner']['origlink'];
				$url3 = $item['link_'];

				$titulo = $title1;

				// no carga noticia si en titulo tiene un filtro
				foreach( $filtros2 as $key => $value ){
					$titulo2 = strtolower($titulo);

					$filtro = stristr($titulo2, $value);
					$filtro = trim($filtro);
					if( $filtro == '' ){
						// echo $filtro."<br>";
						$filtroControl++;
					}
				}

				// echo $filtroControl." Fil\n<br>";

				if( $filtroControl == $filtrosNro ){
					// echo "Cargar<br>";
					// echo $titulo2." - ".$filtro."<br>";

					if( isset($fecha3) ){
						$fecha = $fecha3;
					} elseif( isset($fecha2) ){
						$fecha = $fecha2;
					} elseif( isset($fecha1) ){
						$fecha = $fecha1;
					}

					if( isset($contenido1) ){
						$contenido = $contenido1;
					} elseif( isset($contenido2) ){
						$contenido = $contenido2;
					} elseif( isset($contenido3) ){
						$contenido = $contenido3;
					}

					if( isset($url1) ){
						$enlace = $url1;
					} elseif( isset($url2) ){
						$enlace = $url2;
					} elseif( isset($url3) ){
						$enlace = $url3;
					}

					$contenido = trim($contenido);
					$contenido = rtrim($contenido);

					$titulo = limpiarTexto($titulo);
					$fecha = $fecha;
					if( is_numeric($fecha) == FALSE ){
						$fecha = strtotime($fecha);
					}
					$enlace = limpiarTexto($enlace);
					$contenido = limpiarTexto($contenido);


					$campos = 'id';
					$tabla = 'feeds';
					$columna1 = 'titulo';
					$queBuscar1 = $titulo;
					$resultado1 = mysql02($campos,$tabla,$columna1,$queBuscar1);

					if( empty($resultado1) ){
						mysql_query("insert into feeds (usuarioId, rssId, titulo, fecha, enlace, contenido, eliminado, tagId, visitas)
							values ('$usuarioId','$rssId','$titulo','$fecha','$enlace','$contenido','0','$tagId','0')");
						$nroEnlacesCargados++;
					}
				} else{
					// echo "No cargar<br>";
					$nroEnlacesFiltrados++;
				}
			unset($title1);
			unset($titulo);
			unset($fecha1);
			unset($fecha2);
			unset($fecha3);
			unset($fecha);
			unset($contenido1);
			unset($contenido2);
			unset($contenido);
			unset($url1);
			unset($url2);
			unset($url3);
			unset($enlace);
			unset($filtroControl);
			$nroEnlacesCargar++;
		endforeach;
	}
	echo "usuarioID ".$usuarioId." Enlaces a cargar ".$nroEnlacesCargar."<br />\n";
	echo "<h3>".$nroEnlacesCargar." enlaces a Cargar</h3><br />\n";
	echo "<h3>".$nroEnlacesCargados." enlaces Nuevos</h3><br />\n";
	echo "<h3>".$nroEnlacesFiltrados." enlaces Filtrados</h3><br />\n";
	// Elimina temporales
	$dir = 'cache/';
	foreach(glob($dir.'*') as $v){
		unlink($v);
	}
}

// ---------------------------------------------------------------------------------
// carga datos desde owncloud

// buscar todos los usuarios de la DB
$campo = 'usuario';
$tabla = 'usuarios';
$usuarios = mysql06($campo,$tabla);
// print_r($usuarios);
foreach( $usuarios as $usuario){

echo $usuario."\n";

	$campos = 'id';
	$tabla = 'usuarios';
	$columna1 = 'usuario';
	$queBuscar1 = $usuario;
	$usuarioId = mysql02($campos,$tabla,$columna1,$queBuscar1);

	$directorio2="/var/www/owncloud/data/".$usuario."/files";

	$today = date("y-m-d");
	$random = php05('1000','9999');
	$myFile = $directorio2."/ShareURL.html";
	$myFile2 = $directorio2."/URL_Cargados/ShareURL.".$today."-".$random.".html";

	$fh = fopen($myFile, 'r');
	$theData = fread($fh, filesize($myFile));
	fclose($fh);


	$theData = str_replace('<html>', '', $theData);
	$theData = str_replace('<head>', '', $theData);
	$theData = str_replace('</head>', '', $theData);
	$theData = str_replace('</html>', '', $theData);
	$theData = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $theData);
	$theData = str_replace('<body>', '', $theData);
	$theData = str_replace('</body>', '', $theData);
	$theData = str_replace('<br><br>', '<br>', $theData);

	$theData = trim($theData);

	$theData2 = explode("<br>", $theData);

	$h = '0';
	foreach( $theData2 as $key => $value ){
		if( isset($value) AND $value != '' AND $value != ' '){
			$value = trim($value);
			$value = rtrim($value);
			$value = strip_tags($value);
			$theData2[$h] = $value;
			$h++;
		}
	}

	$totalArray = count($theData2);
	$totalArray = $totalArray / 3;

	$i = '0';
	$j = '1';
	$k = '2';
	$theData3 = array();
	for( $ii = '0' ; $ii < $totalArray ; $ii++ ){

		$theData3[$ii]['titulo'] = $theData2[$i];
		$theData3[$ii]['titulo'] = limpiarTexto($theData3[$ii]['titulo']);

		$j = $i + 1;
		$theData3[$ii]['fecha'] = $theData2[$j];

		$k = $j + 1;
		$theData3[$ii]['enlace'] = $theData2[$k];

		$i = $k + 1;
	}

	if( empty($theData3[$ii]['titulo']) AND empty($theData3[$ii]['fecha']) AND empty($theData3[$ii]['enlace']) ){
		array_pop($theData3);
	}

	$nroEnlacesCargar = count($theData3);

	$m = '0';
	$pasadas = '3';

	echo "<h3>Enlaces a Cargar</h3><br />\n";
	// Carga 3 veces el mismo documentos antes de renombrarlo
	for( $l = '0'; $l < $pasadas; $l++ ){
		foreach( $theData3 as $value ){

			// comprueba que no exista el enlace en el servidor
			if( $value['titulo'] != '' ){
				echo $value['titulo']."<br />\n";

				$campos = 'id';
				$tabla = 'feeds';
				$columna1 = 'titulo';
				$queBuscar1 = $value['titulo'];
				$resultado1 = mysql02($campos,$tabla,$columna1,$queBuscar1);

				$campos = 'id';
				$tabla = 'feeds';
				$columna1 = 'enlace';
				$queBuscar1 = $value['enlace'];
				$resultado3 = mysql02($campos,$tabla,$columna1,$queBuscar1);

				if( empty($resultado1) OR empty($resultado3) ){

					$web = file_get_contents($value['enlace']);

					// limpia el contenido de la web
					$contenido = str_replace('<script type=\'text/javascript\'>',"<!--", $web);
					$contenido = str_replace('<script',"<!--", $contenido);
					$contenido = str_replace('</script>',"-->", $contenido);
					$contenido = str_replace('<!-->','<!--', $contenido);
					$contenido = preg_replace('/<!--(.*)-->/', '', $contenido);
					$contenido = preg_replace('<!--(.*)-->', '', $contenido);
					$contenido = preg_replace('!/\*.*?\*/!s', '', $contenido);
					$contenido = preg_replace('/\n\s*\n/', "\n", $contenido);
					$contenido = limpiarTexto2($contenido);

					// limpia comentarios, creo que no funciona
					$tokens = token_get_all( $contenido );
					foreach ( $tokens as $token ){
						if ( T_COMMENT == $token['0'] ){
							$contenido = str_replace($token['1'], '', $contenido);
						}
					}

					$titulo = $value['titulo'];
					$enlace = $value['enlace'];
					$tagId = $tagIdOC;
					$rssId = $rssIdOC;
					$fecha = time();

					mysql_query("insert into feeds (usuarioId, rssId, titulo, fecha, enlace, contenido, eliminado, tagId, visitas)
						values ('$usuarioId','$rssId','$titulo','$fecha','$enlace','$contenido','0','$tagId','0')");
					$m++;

					// echo $value['titulo']."<br />";
					echo mysql_error()."<br />";
				}
			}
		}
	}
	$nroEnlacesCargados = $m/$pasadas;
	rename($myFile, $myFile2);

	echo "<h3>".$nroEnlacesCargar." enlaces a Cargar</h3><br />\n";
	echo "<h3>".$nroEnlacesCargados." enlaces Nuevos</h3><br />\n";
}
?>
