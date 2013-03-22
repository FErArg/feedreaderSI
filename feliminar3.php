<?php

if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

$id = filter_var($_GET['i'], FILTER_SANITIZE_STRING);

/*
echo $id;
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

mysql_query("DELETE FROM rss WHERE id='$id'");

// busca todos los feeds del rss eliminado, y le cambi ael feed a "huerfano"
$campos = 'id';
$tabla = 'feeds';
$columna1 = 'rssId';
$queBuscar1 = $id;
$columna2 = 'usuarioId';
$queBuscar2 = $usuarioId;
$resultado = mysql12B($campos, $tabla, $columna1, $queBuscar1, $columna2, $queBuscar2);
/*
echo "<pre>";
print_r($resultado);
echo "</pre>";
*/
foreach( $resultado as $value ){
	echo $value['id']." - ".$usuarioId."<br>";
	mysql_query("UPDATE feeds SET rssId='1' WHERE id='$value[id]' AND usuarioId='$usuarioId'");
	echo mysql_error();
}
// redireccionar de nuevo a index
echo mysql_error();
echo "<meta http-equiv='refresh' content='0;URL=?w=inicio'>";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>
