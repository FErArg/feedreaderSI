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

/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
echo "</pre>";
*/
if( isset($_POST['buscar']) AND isset($_GET['ir']) AND $_POST['buscar'] != ''){
	$buscar = filter_var($_POST['buscar'], FILTER_SANITIZE_STRING);

	$campos1 = 'id, titulo, enlace, rssId, fecha, eliminado, protegido, importante, protegido';
	$tabla1 = 'feeds';
	$columna1 = 'titulo';
	$queBuscar1 = $buscar;
	$columna2 = 'contenido';
	$queBuscar2 = $buscar;
	$columna3 = 'eliminado';
	$queBuscar3 = '0';
	$orden = 'id';
	$colOrden = 'ASC';
	$resultado = buscar04($campos1,$tabla1,$columna1,$queBuscar1,$columna2,$queBuscar2,$columna3,$queBuscar3,$orden,$colOrden);
	echo mysql_error();

	$nroResultado = count($resultado);
	echo "<h2>Hay ".$nroResultado." coincidencias</h2>";
	echo "T&eacute;rmino buscado \"<b>".$buscar."\"</b>";

echo "<table id=\"box-table-a\" summary=\"Listado de Enlaces\">\n";
echo "<thead>
    	<tr>
         <th scope=\"col\">ID</th><th scope=\"col\">Visitas</th><th scope=\"col\">Fecha</th><th scope=\"col\">Enlace</th>\n";
         echo "</tr>\n";
         echo "</thead>\n";
         echo "<tbody>\n";

foreach($resultado as $value){

		echo "<tr>\n";
		echo "<td>".$value['id']."</td>\n";
		echo "<td>".$value['visitas']."</td>\n";

		$value['fecha'] = date('Y-m-d', $value['fecha']);
		echo "</td>\n<td>".$value['fecha']."</td>\n";

		echo " <td>\n";
		echo "<table id=\"sub-tabla\" border=\"0\" width=\"100%\">\n";
		echo "<tr class=\"linea\">\n";

		echo "<td width=\"90%\"><a href=\"?w=ver3&e=".$value['enlace']."&i=".$value['id']."\" target=\"_blank\">".$value['titulo']."</a></td>\n";

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
		<td><a href="?w=eliminar3&i=$value[id]&r=$rssId&o=buscar"><img src="imagenes/eliminar.png" alt="Eliminar"/></a></td>
_ELIMINAR;
		echo $eliminar;

		// protegido
		if( $value['protegido'] == '1' ){
			$imagenP = 'protegido';
		} else{
			$imagenP = 'protegido0';
		}
		$protegido = <<<_PROTEGIDO
		<td><a href="?w=protegido2&i=$value[id]&r=$rssId&o=buscar&p=$value[protegido]"><img src="imagenes/$imagenP.png" alt="Protegido"/></a></td>\n
_PROTEGIDO;
		echo $protegido;

		// Importante
		if( $value['importante'] == '1' ){
			$imagen = 'importante';
		} else{
			$imagen = 'importante0';
		}
		$importante = <<<_IMPORTANTE
		<td><a href="?w=importante2&i=$value[id]&r=$rssId&o=buscar&im=$value[importante]"><img src="imagenes/$imagen.png" alt="Importante"/></a></td>
_IMPORTANTE;
		echo $importante;

		echo "</tr>\n</table>\n";
		echo "</td>\n";
		echo "</tr>\n";

}
echo "</tbody></table>\n";
} else{
	echo "No hay terminos a buscar";
}


// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>

