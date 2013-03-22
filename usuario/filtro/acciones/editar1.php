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

echo "<h3>Editar #1</h3> \n<br />";
/*
echo "<pre>";
print_r($_POST);
print_r($_GET);
echo "</pre>";
*/

$material1 = array();
foreach( $_GET as $key => $value ){
	$material1[$key] = filter_var($value, FILTER_SANITIZE_STRING);
	$material1[$key] = limpiarTexto2($material1[$key]);
	$material1[$key] = strtolower($material1[$key]);
}

$campos = 'filtro';
$tabla = 'filtros';
$columna1 = 'id';
$queBuscar1 = $material1['f'];
$resultado = mysql12($campos,$tabla,$columna1,$queBuscar1);

$material2 = $resultado['0'];

// limpia los "0" por nada
foreach( $material2 as $key => $value ){
	if( $value == '0' ){
		$material2[$key] = '';
	}
}


// ------------------------------------------------------------------ //
echo "<form method=\"POST\" action=\"?w=fil&b=editarFil2\" accept-charset=\"utf-8\">\n";
echo "<input type=\"hidden\" name=\"id\" value=\"".$material1['f']."\" />"; // Tipo 1 es libro
echo "<table style=\"text-align: left; width: 800px;\" border=\"0\" cellpadding=\"10\" cellspacing=\"7\" >\n";

foreach( $material2 as $key => $value){
	echo "<tr>\n <td style=\"width: 125px;\" >\n".ucwords($key)."</td>\n";
	echo "<td width: style=\"675px;\" >\n <input type=\"text\" class=\"text\" name=\"".strtolower($key)."\" value=\"".$value."\" size=\"80\" maxlength=\"100\" /></td>\n </tr>\n";
}

	echo "<tr>\n <td>\n <button type=\"reset\" class=\"botonFormulario1\">Limpiar</button> </td>\n";
	echo "<td>\n <button type=\"submit\" class=\"botonFormulario1\">Enviar</button> </td>\n </tr>\n";

	echo "</table>\n";
	echo "</form>\n";


// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
