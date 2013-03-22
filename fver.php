<?php

if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){

$campo = 'id, rss, nombre, tagId';
$tabla = 'rss';
$columna = 'usuarioId';
$buscarEnColumna = $usuarioId;
$colOrden = 'id';
$orden = 'ASC';
$resultado = mysql23($campo, $tabla, $columna, $buscarEnColumna, $colOrden, $orden);
 echo mysql_error();
// print_r($resultado);


echo "<table id=\"box-table-a\" summary=\"Listado de Enlaces\">\n";
echo "<thead>
    	<tr>
         <th scope=\"col\"> ID </th><th scope=\"col\"> Feed </a></th></thead><tbody>\n";
foreach($resultado as $value){

		echo "<tr>\n";
		echo "<td>".$value['id']."</td><td>\n";

		echo "<table border=\"0\" width=\"100%\">\n";
		echo "<tr>\n";

		echo "<td width=\"50%\">";
		echo $value['nombre'];
		echo "</td>\n";

		echo "<td width=\"50%\">";
		echo $value['rss'];
		echo "</td>\n";

		// Ver
		$ver = <<<_VER
		<td><a class="botonFormulario1" href="?w=fver2&i=$value[id]">Ver</a></td>\n
_VER;
		echo $ver;

		// editar
		$editar = <<<_EDITAR
		<td><a class="botonFormulario1" href="?w=feditar2&i=$value[id]">Editar</a></td>\n
_EDITAR;
		echo $editar;

		// eliminar
		$eliminar = <<<_ELIMINAR
		<td><a class="botonFormulario1" href="?w=feliminar3&i=$value[id]">Eliminar</a></td>\n
_ELIMINAR;
		echo $eliminar;

		// TAGS
		// convierte tagId en Tag
		$dondeBuscar = 'tag';
		$tabla = 'tags';
		$enQueColumna = 'id';
		$queBuscar = $value['tagId'];
		$value['tag'] = mysql02($dondeBuscar,$tabla,$enQueColumna,$queBuscar);
		$tags = <<<_TAGS
		<td>
		<p class="botonFormulario1" >$value[tag]</p>
		</td>
_TAGS;
		echo $tags;
		echo "</tr>\n</table>\n";
		echo "</tr>\n";
}
echo "</tbody></table>\n";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>

