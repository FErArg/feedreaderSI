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

// limpia paginacion en $_SESSION
unset($_SESSION['limit']);
unset($_SESSION['page']);
unset($_SESSION['rss2']);
unset($_SESSION['protegido']);
unset($_SESSION['importante']);
/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/

$campos = 'id, nombre';
$tabla = 'rss';
$columna1 = 'usuarioId';
$queBuscar1 = $usuarioId;
$rss = mysql12($campos,$tabla,$columna1,$queBuscar1);

//pide a DB los articulos sin leer y que no esten eliminados y los
// agrega a un nuevo item del array
// numero de articulos sin leer
$totalArticulosSinLeer = '';
foreach( $rss as $key => $value ){
		$campos = 'id';
		$tabla1 = 'feeds';
		$columna1 = 'usuarioId';
		$queBuscar1 = $usuarioId;
		$columna2 = 'visitas';
		$queBuscar2 = '0'; // sin visitas"
		$columna3 = 'rssId';
		$queBuscar3 = $value['id']; // DEL RSS CON ESTE ID"
		$columna4 = 'eliminado';
		$queBuscar4 = '0'; // QUE NO ESTE ELIMINADO"
		$colOrden = 'fecha';
		$orden = 'DESC';
		$limite = '1000';
		$articulos = mysql33($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $columna4, $queBuscar4, $colOrden, $orden);
		$nroResultados = count($articulos);
		$rss[$key]['articulosSinLeer'] = $nroResultados;
		// echo $nroResultados."<br />";
		if( $rss[$key]['articulosSinLeer'] == '' OR empty($rss[$key]['articulosSinLeer']) ){
			unset($rss[$key]);
		}
		if( $rss[$key]['articulosSinLeer'] != '' OR !empty($rss[$key]['articulosSinLeer']) ){
			$totalArticulosSinLeer = $totalArticulosSinLeer + $nroResultados;
		}
}

$nroRss = count($rss);
echo $nroRss." feeds | ".$totalArticulosSinLeer." sin leer |";

echo "<table id=\"box-table-a2\" summary=\"Feeds\">\n";
echo "<thead>
    	<tr>
         <th scope=\"col\"> ID </th><th scope=\"col\"> Feed </th><th scope=\"col\"> Sin Leer </th></tr></thead><tbody>\n";
sort($rss);
foreach( $rss as $value1){

		echo "<tr>\n";
		echo "<td>".$value1['id']."</td>\n";
		echo "<td>\n";
		echo "<a href=\"?w=rss2&rss=".$value1['id']."\">".$value1['nombre']."</a>";
		echo "</td>\n<td>";
		echo $value1['articulosSinLeer'];
		echo "</td>\n";

}
echo "</tbody></table>\n";
// echo mysql_error();

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>
