<?php // ver todos los libros
if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

echo "<h3>Eliminar #3</h3> \n<br />";

if( $_SESSION['eliminar'] != '1' ){
	echo "<meta http-equiv='refresh' content='0;URL=?w=inicio'>";
}
/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
print_r($_SESSION);
echo "</pre>";
*/
$material = array();
foreach( $_POST as $key => $value ){
	$material[$key] = filter_var($value, FILTER_SANITIZE_STRING);
}

unset($id);
unset($clave);
unset($claveMD5);
unset($_SESSION['eliminar']);

$tabla = "tags";
mysql_query("DELETE FROM $tabla WHERE id ='$material[id]'");
echo mysql_error();
echo "<p class=\"botonCeleste2\">Tag Eliminado</p>\n<br />";
echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";


// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
