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

//----------------------------------------------------------------------
// PAGINACION

$page_name = "?w=ver";
$t = mysql_query("SELECT count(*) cnt FROM feeds where usuarioId = '$usuarioId' AND eliminado != '1' ");

if( !$t ){
	die("Error quering the Database: " . mysql_error());
}

$a = mysql_fetch_object($t);
$total_items = $a->cnt;
$limit= (isset($_GET["limit"])) ? $_GET["limit"] : 10;
$page= (isset($_GET["page"]))? $_GET["page"] : 1;

//Set defaults if: $limit is empty, non numerical,
//less than 10, greater than 50
if( (!$limit) || (is_numeric($limit) == false) || ($limit < 10) || ($limit > 50) ){
	$limit = 10; //default
}

//Set defaults if: $page is empty, non numerical,
//less than zero, greater than total available
if( (!$page) || (is_numeric($page) == false) || ($page < 0) || ($page > $total_items) ){
	$page = 1; //default
}

//calculate total pages
$total_pages = ceil($total_items / $limit);
$set_limit = ($page * $limit) - $limit;

//query: **EDIT TO YOUR TABLE NAME, ETC.
$q = mysql_query("SELECT id, titulo, fecha, enlace, tagId, visitas, importante, protegido
					FROM feeds where usuarioId = '$usuarioId' AND eliminado != '1' LIMIT $set_limit, $limit");

if(!$q) die(mysql_error());

$no_row = mysql_num_rows($q);

if($no_row == 0) die("No matches met your criteria.");

// Pagina Siguiente o Anterior -----------------------------------------
echo "\n<table>\n<tr><td>";
//Results per page:
echo("Resultados por p&aacute;gina: <a href=$page_name&limit=10&page=1>10</a> | <a href=$page_name&limit=25&page=1> 25</a> | <a href=$page_name&limit=50&page=1>50</a><br/>\n");
echo "</td>";
echo "<td>";

//prev. page
$prev_page = $page - 1;
if( $prev_page >= 1 ) {
	echo("<a href=$page_name&limit=$limit&page=$prev_page><img src=\"imagenes/f_izq.png\" alt=\"Anterior\"/></a>");
}
// next page
$next_page = $page + 1;
if(	$next_page <= $total_pages ){
	echo("<a href=$page_name&limit=$limit&page=$next_page><img src=\"imagenes/f_der.png\" alt=\"Siguiente\"/></a><br />\n");
}
echo "</td></tr> </table>";
// Pagina Siguiente o Anterior -----------------------------------------
// PAGINACION
//----------------------------------------------------------------------
/*
$nroRss = count($resultado);
echo $nroRss." art&iacute;culos para leer";
*/
echo "<table id=\"box-table-a\" summary=\"Listado de Enlaces\">\n";
echo "<thead>
    	<tr>
         <th scope=\"col\">ID</th><th scope=\"col\">Visitas</th><th scope=\"col\">Fecha</th><th scope=\"col\">Enlace</th>\n";
         echo "</tr>\n";
         echo "</thead>\n";
         echo "<tbody>\n";

	//foreach($resultado as $value){
	while( $object = mysql_fetch_object($q) ){

		//print your data here.
		$value = array('id' => $object->id,
					   'visitas' => $object->visitas,
					   'fecha' => $object->fecha,
					   'enlace' => $object->enlace,
					   'titulo' => $object->titulo,
					   'tagId' => $object->tagId,
					   'protegido' => $object->protegido,
					   'importante' => $object->importante);

		echo "<tr>\n";
		echo "<td>".$value['id']."</td>\n";

		echo "<td>".$value['visitas']."</td>\n";

		$value['fecha'] = date('Y-m-d', $value['fecha']);
		echo "</td>\n<td>".$value['fecha']."</td>\n";

		echo " <td>\n";
		echo "<table id=\"sub-tabla\" border=\"0\" width=\"100%\">\n";
		echo "<tr class=\"linea\">\n";

		echo "<td width=\"90%\"><a href=\"?w=ver3&e=".$value['enlace']."&i=".$value['id']."\" target=\"_blank\">".$value['titulo']."</a></td>\n";

		// TAGS
		// convierte tagId en Tag
		$dondeBuscar = 'tag';
		$tabla = 'tags';
		$enQueColumna = 'id';
		$queBuscar = $value['tagId'];
		$value['tag'] = mysql02($dondeBuscar,$tabla,$enQueColumna,$queBuscar);
		$tags = <<<_TAGS
		<td>
		<a class="botonFormulario1" href="?w=tag&t=$value[tagId]"/>$value[tag]</a>
		</td>
_TAGS;
		echo $tags;

		// Ver
		$ver = <<<_VER
		<td><a href="?w=ver2&i=$value[id]&r=$rssId"><img src="imagenes/ver.png" alt="Ver"/></a></td>
_VER;
		echo $ver;

		// editar
		$editar = <<<_EDITAR
		<td><a href="?w=editar2&i=$value[id]"><img src="imagenes/editar.png" alt="Editar"/></a></td>
_EDITAR;
		echo $editar;

		// email
		$email = <<<_EMAIL
		<td><a href="?w=email1&i=$value[id]"><img src="imagenes/email.png" alt="eMail"/></a></td>
_EMAIL;
		echo $email;

		// eliminar
		$eliminar = <<<_ELIMINAR
		<td><a href="?w=eliminar3&i=$value[id]&r=$rssId&o=ver"><img src="imagenes/eliminar.png" alt="Eliminar"/></a></td>
_ELIMINAR;
		echo $eliminar;

		// protegido
		if( $value['protegido'] == '1' ){
			$imagenP = 'protegido';
		} else{
			$imagenP = 'protegido0';
		}
		$protegido = <<<_PROTEGIDO
		<td><a href="?w=protegido2&i=$value[id]&r=$rssId&o=ver&p=$value[protegido]"><img src="imagenes/$imagenP.png" alt="Protegido"/></a></td>\n
_PROTEGIDO;
		echo $protegido;

		// Importante
		if( $value['importante'] == '1' ){
			$imagen = 'importante';
		} else{
			$imagen = 'importante0';
		}
		$importante = <<<_IMPORTANTE
		<td><a href="?w=importante2&i=$value[id]&r=$rssId&o=ver&im=$value[importante]"><img src="imagenes/$imagen.png" alt="Importante"/></a></td>
_IMPORTANTE;
		echo $importante;

		echo "</tr>\n</table>\n";
		echo "</td>\n";
		echo "</tr>\n";
}

echo "</tbody></table>\n";
// Pagina Siguiente o Anterior -----------------------------------------
//prev. page
//prev. page
$prev_page = $page - 1;
if( $prev_page >= 1 ) {
	echo("<a href=$page_name&limit=$limit&page=$prev_page><img src=\"imagenes/f_izq.png\" alt=\"Anterior\"/></a>");
}
// next page
$next_page = $page + 1;
if(	$next_page <= $total_pages ){
	echo("<a href=$page_name&limit=$limit&page=$next_page><img src=\"imagenes/f_der.png\" alt=\"Siguiente\"/></a><br />\n");
}
// Pagina Siguiente o Anterior -----------------------------------------

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>

