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


session_start();
$inc="../../inc";
//include("$inc/variables.inc.php");
if ( (isset($_SESSION['AuthenticatedAD']) AND $_SESSION['AuthenticatedAD'] == 1) ){
mysql00();
?>
<?php
echo "Modificar de Usuario";

/*
echo "<pre>";
	print_r($value);
echo "</pre>";
*/
$campos = "id, usuario";
$tabla = 'usuarios';
$resultado = mysql08($campos,$tabla);
$nroResultados = count($resultado);

//  el usuarioId por usuario
for( $i = '0'; $i < $nroResultados ; $i++){
	$dondeBuscar = 'usuario';
	$tabla = 'usuarios';
	$enQueColumna = 'id';
	$queBuscar = $resultado[$i]['usuario'];
	$usuarioDestino = mysql02($dondeBuscar,$tabla,$enQueColumna,$queBuscar);
}
?>
<?php
// Control para pasar a tools/usuarios/eliminar2.php
$_SESSION['modificar'] = '2';

// crea tabla con listado de mensajes recibidos y enlace que pasa datos
// por URL para lmensaje y poder ver en mensaje completo
echo "<table id=\"box-table-a\">\n";
// cabecera de tabla
echo "<tr><th scope=\"col\">Id</th>
	  <th scope=\"col\">Usuario</th>
	  <th scope=\"col\"></th>\n";
foreach( $resultado as $value ){
echo "<tr>\n";
	$numArray = count($value);
	foreach( $value as $key => $value ){
		echo "<td>".$value."</td>\n";
		if ($key == 'id'){
			$idUsuarioModificar = $value;
		}
	}
	echo "<td><a href=\"?select2=umodifica2&idUsuarioModificar=".$idUsuarioModificar."\">Modificar</a></td>";
}
echo "</table><br />\n";

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<br />\n<a href=\"../index.php\" class=\"botonR\">Volver</a><br /><br />\n";
}
// Control de la sesion ----------------------------------------------------------------------
?>

