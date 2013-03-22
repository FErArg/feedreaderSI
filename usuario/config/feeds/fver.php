<?php
	/**************************************************************************************************
	#     Copyright (c) 2008 - 2013 Fernando A. Rodríguez para SerInformaticos.es                     #
	#                                                                                                 #
	#     Este programa es software libre: usted puede redistribuirlo y / o modificarlo               #
	#     bajo los t&eacute;rminos de la GNU General Public License publicada por la                  #
	#     la Free Software Foundation, bien de la versi&oacute;n 3 de la Licencia, o de               #
	#     la GPL2, o cualquier versi&oacute;n posterior.                                              #
	#                                                                                                 #
	#     Este programa se distribuye con la esperanza de que sea &uacute;til,                        #
	#     pero SIN NINGUNA GARANTÍA, incluso sin la garant&iacute;a impl&iacute;cita de               #
	#     COMERCIABILIDAD o IDONEIDAD PARA UN PROPÓSITO PARTICULAR. V&eacute;ase el                   #
	#     GNU General Public License para m&aacute;s detalles.                                        #
	#                                                                                                 #
	#     Usted deber&iacute;a haber recibido una copia de la Licencia P&uacute;blica General de GNU  #
	#     junto con este programa. Si no, visite <http://www.gnu.org/licenses/>.                      #
	#                                                                                                 #
	#     Puede descargar la version completa de la GPL3 en este enlace:                              #
	#     	< http://www.serinformaticos.es/index.php?file=kop804.php >                               #
	#                                                                                                 #
	#     Para mas información puede contactarnos :                                                   #
	#                                                                                                 #
	#       Teléfono  (+34) 961 19 60 62                                                              #
	#                                                                                                 #
	#       Email:    info@serinformaticos.es                                                         #
	#                                                                                                 #
	#       MSn:      info@serinformaticos.es                                                         #
	#                                                                                                 #
	#       Twitter:  @SerInformaticos                                                                #
	#                                                                                                 #
	#       Web:      www.SerInformaticos.es                                                          #
	#                                                                                                 #
	**************************************************************************************************/



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

