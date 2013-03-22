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
// include('../inc/header.php');

if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){
mysql00();

require_once('../magpierss/rss_fetch.inc');

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

$nroEnlacesCargar = '0';
$nroEnlacesCargados = '0';




foreach( $urlArray as $value ){
	$url = $value['url'];
	$tagId = $value['tagId'];
	$rssId = $value['id'];
	// echo $url ." - ".$tagId."<br />";

	$rss = fetch_rss($url);
	$feed = array();
	$i = '0';
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

echo "<h3>".$nroEnlacesCargar." enlaces a Cargar</h3><br />\n";
echo "<h3>".$nroEnlacesCargados." enlaces Nuevos</h3><br />\n";
echo "<h3>".$nroEnlacesFiltrados." enlaces Filtrados</h3><br />\n";

// Elimina temporales
$dir = 'cache/';
foreach(glob($dir.'*') as $v){
	unlink($v);
}

echo "<meta http-equiv='refresh' content='3;URL=?w=cargar-owncloud'>";
mysql_close();

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>
