<?php // ver todos los libros
if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

	echo "<h3>Agregar #1</h3> \n<br />";
/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
echo "</pre>";
*/
foreach( $_GET as $key => $value ){
	$material[$key] = filter_var($value, FILTER_SANITIZE_STRING);
}

echo "<h2>".ucwords($material['a'])." ".ucwords($material['o'])."</h2>";

$var1 = <<<INICIO
<form method="POST" action="?w=mat&a=agregar2" accept-charset="utf-8">\n

<table style="text-align: left; width: 800px;" border="0" cellpadding="10" cellspacing="7" >
	<tr>
		<td>Nuevo $material[o]</td><td><input type="text" class="text" name="$material[o]" size="80" maxlength="100" /></td>
	</tr>

	<tr>\n <td>\n <button type="reset" class="botonCeleste2">Limpiar</button> </td>
	<td>\n <button type="submit" class="botonCeleste2">Enviar</button> </td>\n </tr>
</table>
</form>

INICIO;
echo $var1;

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
