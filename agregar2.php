<?php // ver todos los libros
if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

	echo "<h3>Agregar #2</h3> \n<br />";
/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
echo "</pre>";
*/
$material = array();
foreach( $_POST as $key => $value ){
	$material[$key] = filter_var($value, FILTER_SANITIZE_STRING);
	$material[$key] = limpiarTexto2($material[$key]);
	$material[$key] = strtolower($material[$key]);
}

// comprueba que no exista en DB

foreach( $material as $key => $value ){
	$tabla = "tags";
	$check0="SELECT id FROM $tabla WHERE $key = '$value'";
	$check1=mysql_query($check0);
	$check=mysql_fetch_row($check1);

	if ( isset($check) AND $check != '' AND $check != ' ' ) {
		echo "<br />\nMaterial ".$key." ".$value." ya existe!<br /><br />\n";
		die("<br />\n<a href=\"?w=inicio\" class=\"botonRojo1\">Volver</a><br /><br />\n");
	} else{
		echo $key ." ".$value;
		// AGREGAR EN DB
		mysql_query("INSERT INTO $tabla ($key) VALUE ('$value')");
		echo mysql_error();
		echo "<br />\nMaterial ".$key." ".$value." agregado correctamente!<br /><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
	}
}

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
