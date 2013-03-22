<?php // ver todos los libros
if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

echo "<h3>Editar #1</h3> \n<br />";
/*
echo "<pre>";
print_r($_GET);
echo "</pre>";
*/

$material1 = array();
foreach( $_GET as $key => $value ){
	$material1[$key] = filter_var($value, FILTER_SANITIZE_STRING);
	$material1[$key] = limpiarTexto2($material1[$key]);
	$material1[$key] = strtolower($material1[$key]);
}

$campos = 'tag';
$tabla = 'tags';
$columna1 = 'id';
$queBuscar1 = $material1['m'];
$resultado = mysql12($campos,$tabla,$columna1,$queBuscar1);

$material2 = $resultado['0'];

// limpia los "0" por nada
foreach( $material2 as $key => $value ){
	if( $value == '0' ){
		$material2[$key] = '';
	}
}


// ------------------------------------------------------------------ //
echo "<form method=\"POST\" action=\"?w=mat&a=editarTag2\" accept-charset=\"utf-8\">\n";
echo "<input type=\"hidden\" name=\"id\" value=\"".$material1['m']."\" />"; // Tipo 1 es libro
echo "<table style=\"text-align: left; width: 800px;\" border=\"0\" cellpadding=\"10\" cellspacing=\"7\" >\n";

foreach( $material2 as $key => $value){
	echo "<tr>\n <td style=\"width: 125px;\" >\n".ucwords($key)."</td>\n";
	echo "<td width: style=\"675px;\" >\n <input type=\"text\" class=\"text\" name=\"".strtolower($key)."\" value=\"".$value."\" size=\"80\" maxlength=\"100\" /></td>\n </tr>\n";
}

	echo "<tr>\n <td>\n <button type=\"reset\" class=\"botonFormulario1\">Limpiar</button> </td>\n";
	echo "<td>\n <button type=\"submit\" class=\"botonFormulario1\">Enviar</button> </td>\n </tr>\n";

	echo "</table>\n";
	echo "</form>\n";


// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
