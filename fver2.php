<?php

if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

echo "<br />\n";

$id = filter_var($_GET['i'], FILTER_SANITIZE_STRING);

/*
echo "<pre>";
	print_r($_POST);
echo "</pre>";
*/
$query = "SELECT rss FROM rss WHERE id = '$id' AND usuarioID ='$usuarioId'";
$array00 = mysql03($query);

// print_r($array00);

$array01 = array(
	'ID' => $id,
	'Rss' => $array00[0]);

$array2 = tabla01($array01);
foreach ( $array2 as $value){
	echo $value;
}
echo "<br />\n";
echo "<table>\n";
echo "<tr>\n";
// editar
$editar = <<<_EDITAR
<td><a class="botonFormulario1" href="?w=feditar2&i=$array01[ID]">Editar</a></td>\n
_EDITAR;
echo $editar;

// eliminar
$eliminar = <<<_ELIMINAR
<td><a class="botonFormulario1" href="?w=feliminar3&i=$array01[ID]">Eliminar</a></td>\n
_ELIMINAR;
echo $eliminar;

$volver = <<<_VOLVER
<td><input class="botonFormulario1" type="button" value="Volver" name="ClickBack" onclick=(history.back())></td>\n
_VOLVER;
echo $volver;

echo "</tr>\n";
echo "</table>\n";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
