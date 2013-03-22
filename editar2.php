<?php // ver todos los libros
if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

echo "<h3>Editar #2</h3> \n<br />";
/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
echo "</pre>";
*/
foreach( $_POST as $key => $value ){
	$material[strtolower($key)] = filter_var($value, FILTER_SANITIZE_STRING);
}

foreach( $material as $key => $value ){
	if( $key != 'id' ){
		$campos = $key;
		$tabla = 'tags';
		$columna1 = 'id';
		$queBuscar1 = $material['id'];
		$resultado = mysql12($campos,$tabla,$columna1,$queBuscar1);
		$rtdoMd5 = md5($resultado['0'][$key]);
		$valueMd5 = md5($value2);
		echo $rtdoMd5." - ".$valueMd5."<br />";
		echo $key." - ".$value." rtdo: ".$resultado[0][$key]."<br />";
		if( $rtdoMd5 != $valueMd5 ){
			// echo "<h3>Se actualiza campo ".$key." con nuevo valor</h3> \n<br />";
			mysql_query("UPDATE tags SET $key='$value' WHERE id='$material[id]'");
			echo mysql_error();
		} else{
			echo "<h3>No se actualiza campo ".ucwords($material['o'])."</h3> \n<br />";
		}
	}
}

foreach( $material as $key1 => $value1 ){
	unset($material[$key1]);
}

echo "<meta http-equiv='refresh' content='3;URL=?w=inicio'>";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
