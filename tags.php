<?php
if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){



echo "<table width=\"50%\">\n";
echo "<tr>\n <td>\n";

echo "<form action=\"?w=selector\" method=\"POST\">";
$campos = "id, tag";
$tabla = "tags";
$resultado = mysql10($campos, $tabla);

foreach($resultado as $value){
		echo $value;
}

echo "</td>\n <td>\n";

echo "<input id=\"accion\" name=\"accion\" class=\"accion\" type=\"radio\" value=\"ver\"> Ver\n<br />";
echo "<input id=\"accion\" name=\"accion\" class=\"accion\" type=\"radio\" value=\"agregar\"> Agregar\n<br />";
echo "<input id=\"accion\" name=\"accion\" class=\"accion\" type=\"radio\" value=\"editar\"> Editar\n<br />";
echo "<input id=\"accion\" name=\"accion\" class=\"accion\" type=\"radio\" value=\"eliminar\"> Eliminar\n<br />";

echo "</td></tr>";
echo "</table>";

echo "<br />";
echo "<button class=\"botonFormulario1\" type=\"reset\">Limpiar</button></td><td><button  class=\"botonFormulario1\" type=\"submit\">Enviar</button>";
echo "</form>";



// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
