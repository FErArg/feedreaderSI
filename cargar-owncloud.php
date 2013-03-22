<?php

session_start();
include('../inc/framework.php');
include('../inc/header.php');

if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){
mysql00();

// carga datos desde owncloud
$today = date("y-m-d");
$random = php05('1000','9999');
$myFile = $directorio."/ShareURL.html";
$myFile2 = $directorio."/URL_Cargados/ShareURL.".$today."-".$random.".html";

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
    // unset($theData2[$key]);
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
//			echo $value['fecha']."<br />\n";
//			echo $value['enlace']."<br />\n";

			$campos = 'id';
			$tabla = 'feeds';
			$columna1 = 'titulo';
			$queBuscar1 = $value['titulo'];
			$resultado1 = mysql02($campos,$tabla,$columna1,$queBuscar1);
//			echo $resultado1."<br /> \n";

			$campos = 'id';
			$tabla = 'feeds';
			$columna1 = 'enlace';
			$queBuscar1 = $value['enlace'];
			$resultado3 = mysql02($campos,$tabla,$columna1,$queBuscar1);
//			echo $resultado3."<br /> \n";

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
// echo $myFile."<br />";
// echo $myFile2."<br />";
rename($myFile, $myFile2);

echo "<h3>".$nroEnlacesCargar." enlaces a Cargar</h3><br />\n";
echo "<h3>".$nroEnlacesCargados." enlaces Nuevos</h3><br />\n";

echo "<meta http-equiv='refresh' content='1;URL=?w=inicio'>";
mysql_close();

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>
