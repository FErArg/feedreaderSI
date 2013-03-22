<?php // ver todos los libros
if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
echo "</pre>";
*/
$origen = filter_var($_POST[campos][3], FILTER_SANITIZE_STRING);
$origen2 = filter_var($_POST[campos][2], FILTER_SANITIZE_STRING);
$accion = filter_var($_POST['accion'], FILTER_SANITIZE_STRING);
$material = filter_var($_POST[$origen], FILTER_SANITIZE_STRING);
$tagId = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);
// echo $origen." - ".$accion." - ".$material."<br />";

if( $accion != 'agregar' AND $material == '' ){
	echo "<h2>debe seleccionar ".$origen2."</h2>\n<br />";
	die ("<br />\n<a href=\"?i=".$origen2."\" class=\"botonRojo1\">Volver</a><br /><br />\n");
}

switch($accion){
    case 'ver';
		echo "<meta http-equiv='refresh' content='0;URL=?w=tag&t=".$tagId."'>";
    break;
    case 'agregar';
		echo "<meta http-equiv='refresh' content='0;URL=?w=mat&o=".$origen2."&a=".$accion."'>";
    break;
    case 'editar';
		echo "<meta http-equiv='refresh' content='0;URL=?w=mat&o=".$origen2."&a=".$accion."&m=".$material."'>";
    break;
    case 'eliminar';
		echo "<meta http-equiv='refresh' content='0;URL=?w=mat&o=".$origen2."&a=".$accion."&m=".$material."'>";
    break;
}

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
