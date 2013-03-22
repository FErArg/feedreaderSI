<?php // ver todos los libros
if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

echo "<h3>Eliminar #1</h3> \n<br />";
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

$campos = $material1['o'];
$tabla = "tags";
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
echo "<form method=\"POST\" action=\"?w=mat&a=eliminar2\" accept-charset=\"utf-8\">\n";
echo "<input type=\"hidden\" name=\"id\" value=\"".$material1['m']."\" />\n";
echo "<input type=\"hidden\" name=\"o\" value=\"".$material1['o']."\" />\n";
echo "<table style=\"text-align: left; width: 800px;\" border=\"0\" cellpadding=\"10\" cellspacing=\"7\" >\n";

foreach( $material2 as $key => $value){
	echo "<tr>\n <td style=\"width: 125px;\" >\n <h3>".ucwords($key)."</h3><br></td>\n";
	echo "<td width: style=\"675px;\" >\n <h3>".$value." </h3><br></td>\n </tr>\n";
}
	echo "<tr><td colspan=\"2\"><p class=\"botonCeleste2\">Seguro quiere Eliminar esta Opci&oacute;n?</p><br /></td></tr>\n";
	echo "<tr>\n <td>\n <button type=\"submit\" class=\"botonRojo1\">SI</button> </td>\n";
	echo "<td>\n <a href=\"?w=inicio\" class=\"botonCeleste1\">NO</a> </td>\n </tr>\n";

	echo "</table>\n";
	echo "</form>\n";
$_SESSION['eliminar'] = '1';

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
