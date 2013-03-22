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

// recuerda paginacion y no solapa la seleccion de rss2, importante y
// protegido, limpiando la seleccion al pasar de una pagina a otra
if( isset($_SESSION['rss2']) OR isset($_SESSION['protegido']) ){
	unset($_SESSION['limit']);
	unset($_SESSION['page']);
	unset($_SESSION['rss2']);
	unset($_SESSION['protegido']);
	// unset($_SESSION['importante']);
}
$_SESSION['importante'] = '1';

/*
echo "<pre>";
print_r($_POST);
print_r($_SESSION);
echo "</pre>";
*/

$campos = 'id, titulo, fecha, enlace, visitas, importante, protegido';
$tabla1 = 'feeds';
$columna1 = 'usuarioId';
$queBuscar1 = $usuarioId;
$columna2 = 'eliminado';
$queBuscar2 = '0';
$columna3 = 'importante';
$queBuscar3 = '1';
$colOrden = 'fecha';
$orden = 'DESC';
$resultado = mysql30($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $colOrden, $orden);

$nroRss = count($resultado);
echo "<table><tr><td>";
echo $nroRss." art. sin leer | </td>";

//----------------------------------------------------------------------
// PAGINACION
$page_name = "?w=importante";
$t = mysql_query("SELECT count(*) cnt FROM feeds where usuarioId = '$usuarioId' AND eliminado = '0' AND importante = '1' ");

if( !$t ){
	die("Error quering the Database: " . mysql_error());
}

$a = mysql_fetch_object($t);
$total_items = $a->cnt;
/*
$limit= (isset($_GET["limit"])) ? $_GET["limit"] : 10;
$page= (isset($_GET["page"]))? $_GET["page"] : 1;
*/

//recuerda el numero de items y la pagina
if( isset($_GET['limit']) ){
	$limit = filter_var($_GET['limit'], FILTER_SANITIZE_STRING);
	$_SESSION['limit'] = $limit;
} else{
	// $limit = (isset($_GET['limit'])) ? $_GET['limit'] : 10;
	$limit = $_SESSION['limit'];
}

if( isset($_GET['page']) ){
	$page = filter_var($_GET['page'], FILTER_SANITIZE_STRING);
	$_SESSION['page'] = $page;
} else{
	// $page = (isset($_GET['page']))? $_GET['page'] : 1;
	$page = $_SESSION['page'];
}

//Set defaults if: $limit is empty, non numerical, less than 10, greater than 50
if( (!$limit) || (is_numeric($limit) == false) || ($limit < 10) || ($limit > 50) ){
	$limit = 10; //default
}

//Set defaults if: $page is empty, non numerical, less than zero, greater than total available
if( (!$page) || (is_numeric($page) == false) || ($page < 0) || ($page > $total_items) ){
	$page = 1; //default
}

//calculate total pages
$total_pages = ceil($total_items / $limit);
$set_limit = ($page * $limit) - $limit;

//query: **EDIT TO YOUR TABLE NAME, ETC.
$q = mysql_query("SELECT id, titulo, fecha, enlace, tagId, visitas, importante, protegido FROM feeds
WHERE usuarioId = '$usuarioId' AND eliminado = '0' AND importante = '1' ORDER BY fecha DESC LIMIT $set_limit, $limit ");

if(!$q) die(mysql_error());

$no_row = mysql_num_rows($q);

if($no_row == 0) die("No matches met your criteria.");
// Pagina Siguiente o Anterior -----------------------------------------
echo "<td>";
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

echo "<table id=\"box-table-a\" summary=\"Feeds\">\n";
echo "<thead>
    	<tr>
         <th scope=\"col\"> ID </th><th scope=\"col\"> Visitas </th><th scope=\"col\"> Fecha </th><th scope=\"col\"> T&iacute;tulo </th></tr></thead><tbody>\n";
while( $object = mysql_fetch_object($q) ){

	//print your data here.
	// echo("ID: ".$object->id."<BR/>\n");
	// echo("Titulo: ".$object->titulo."<BR/>\n");
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

		echo "<td width=\"90%\"><a href=\"?w=ver3&e=".$value['enlace']."&i=".$value['id']."\" target=\"_blank\" >".$value['titulo']."</a></td>\n";
/*
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
*/
		// Ver
		$ver = <<<_VER
		<td><a href="?w=ver2&i=$value[id]&r=$rssId"><img src="imagenes/ver.png" width="40" height="40" alt="Ver"/></a></td>
_VER;
		echo $ver;

		// editar
		$editar = <<<_EDITAR
		<td><a href="?w=editar2&i=$value[id]"><img src="imagenes/editar.png" width="40" height="40" alt="Editar"/></a></td>
_EDITAR;
		echo $editar;

		// email
		$email = <<<_EMAIL
		<td><a href="?w=email1&i=$value[id]"><img src="imagenes/email.png" width="40" height="40" alt="eMail"/></a></td>
_EMAIL;
		echo $email;

		// eliminar
		$eliminar = <<<_ELIMINAR
		<td><a href="?w=eliminar3&i=$value[id]&r=$rssId&o=importante"><img src="imagenes/eliminar.png" width="40" height="40" alt="Eliminar"/></a></td>
_ELIMINAR;
		echo $eliminar;

		// protegido
		if( $value['protegido'] == '1' ){
			$imagenP = 'protegido';
		} else{
			$imagenP = 'protegido0';
		}
		$protegido = <<<_PROTEGIDO
		<td><a href="?w=protegido2&i=$value[id]&r=$rssId&o=importante&p=$value[protegido]"><img src="imagenes/$imagenP.png" width="40" height="40" alt="Protegido"/></a></td>\n
_PROTEGIDO;
		echo $protegido;

		// Importante
		if( $value['importante'] == '1' ){
			$imagen = 'importante';
		} else{
			$imagen = 'importante0';
		}
		$importante = <<<_IMPORTANTE
		<td><a href="?w=importante2&i=$value[id]&r=$rssId&o=importante&im=$value[importante]"><img src="imagenes/$imagen.png" width="40" height="40" alt="Importante"/></a></td>
_IMPORTANTE;
		echo $importante;

		echo "</tr>\n</table>\n";
		echo "</td>\n";
		echo "</tr>\n";
}
echo "</tbody></table>\n";

// Pagina Siguiente o Anterior -----------------------------------------
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
// Control de la sesion ----------------------------------------------------------------------
?>
