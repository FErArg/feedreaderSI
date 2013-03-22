<?php

if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

$myFile = 'google-reader-subscriptions.xml';

if (file_exists($myFile)) {
    $xml =simplexml_load_file($myFile);
}

for($i=0;$i<=count($xml);$i++) {
    $array=array($xml->body->outline->outline[$i]);
    $key=(array_keys($array));
    foreach ($array as $key) {
        echo "<strong>".($key['xmlUrl'][0])."</strong><br/>";
    }
}



/*
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);

$theData = str_replace('<html>', '', $theData);
$theData = str_replace('<head>', '', $theData);
$theData = str_replace('</head>', '', $theData);
$theData = str_replace('</html>', '', $theData);
$theData = str_replace('<meta http-equiv="Content-Type" content="text/html ; charset=utf-8">', '', $theData);
$theData = str_replace('<body>', '', $theData);
$theData = str_replace('</body>', '', $theData);

echo "<pre>";
print_r($theData);
echo "</pre>";
*/

/*
$url = 'http://example.com/foo.opml'; // URL of OPML file
$parser = new IAM_OPML_Parser();
echo $parser->displayOPMLContents($url);
*/



// extract($_POST);


/*
echo "<pre>";
print_r($_POST);
echo "</pre>";


$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
$nombre = trim($nombre);
$nombre = rtrim($nombre);

$rss = filter_var($_POST['rss'], FILTER_SANITIZE_STRING);
$rss = trim($rss);
$rss = rtrim($rss);

$tagId = filter_var($_POST['tagId'], FILTER_SANITIZE_STRING);



if( empty($rss) ){
	echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
}

$campos = 'id';
$tabla = 'rss';
$columna1 = 'rss';
$queBuscar1 = $rss;
$resultado1 = mysql02($campos,$tabla,$columna1,$queBuscar1);
// echo $resultado1."<br /> \n";

if( empty($resultado1) AND isset($rss) AND $rss != '' AND $rss != ' '){
	mysql_query("insert into rss (usuarioId, rss, nombre, tagId)
		values ('$usuarioId','$rss','$nombre','$tagId')");
	echo mysql_error();
} else {
	echo "<h2><p class=\"botonR\">Ya existe el Feed</p></h2>";
}

// borrar variables
unset($rss);


// redireccionar de nuevo a index
echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
*/

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
