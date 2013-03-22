<?php

session_start();
include('../../inc/framework.php');
include('../../inc/header2.php');

if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){
mysql00();

$menu = array( 'Ver' => '?w=feedsc',
			   'Agregar' => '?w=feedsa',
			   'Editar' => '?w=feedse2',);
foreach( menu00($menu) as $value){
	echo $value;
}

//	echo "<br /><p></p><br />\n";
	echo "<p></p>\n";

$selection = filter_var($_GET['w'], FILTER_SANITIZE_STRING);
switch($selection)
{
	// CONFIGURACION FEEDS ---------------------------------------------
    case 'feedsc';
		include('ver.php');
	break;
    case 'ver2';
		include('ver2.php');
	break;

    case 'feedsa';
		include('agregar.php');
	break;
    case 'feedsa2';
		include('agregar2.php');
	break;

    case 'editar2';
		include('editar2.php');
	break;
    case 'editar3';
		include('editar3.php');
	break;

    case 'eliminar3';
		include('eliminar3.php');
	break;

    case 'volver';
		echo "<meta http-equiv='refresh' content='0;URL=../'>";
	break;

	// Default ---------------------------------------------------------
    default;
        include('ver.php');
    break;
}

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
}
// Control de la sesion ----------------------------------------------------------------------
include('../../inc/footer.php');
?>
