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

if ( (isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1) ){


include('libchart/classes/libchart.php');

$fechaInicioI = '1328050800';// 1/FEB/2012 0:0:0
$intervalo = '86400';  // 24hs
$intervalo2 = '86399';  // 23:59:59
$fechaHoy  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

$a = '0';
for( $i = '1328050800' ; $i <= $fechaHoy ; $i = $i + $intervalo ){
	$fechas[$a] = $i;
	$a++;
}

$fechaPosts = array();
foreach( $fechas as $value ){
	$fechaI = $value;
	$fechaF = $fechaI + $intervalo2;
	$query1 = mysql_query("SELECT COUNT(id) FROM feeds WHERE usuarioId = '$usuarioId' AND fecha BETWEEN '$fechaI' AND '$fechaF'");
	$resultado=mysql_fetch_row($query1);
	$fechaPosts[$value] = $resultado[0];
}
// articulso eliminados
foreach( $fechas as $value ){
	$fechaI = $value;
	$fechaF = $fechaI + $intervalo2;
	$query1 = mysql_query("SELECT COUNT(id) FROM feeds WHERE usuarioId = '$usuarioId' AND eliminado = '1' AND fecha BETWEEN '$fechaI' AND '$fechaF'");
	$resultado=mysql_fetch_row($query1);
	$fechaPostsEliminados[$value] = $resultado[0];
}
/*
echo "<pre>";
print_r($fechaPosts);
print_r($fechaPostsEliminados);
echo "</pre>";
*/

// grafico
$aleatorio = aleatorio01('10','20');

$chart = new LineChart(2000, 800);

$serie1 = new XYDataSet();
foreach( $fechaPosts as $key => $value ){
	$key = date('d/m/y',$key);
	$serie1->addPoint(new Point($key, $value));
}
$serie2 = new XYDataSet();
foreach( $fechaPostsEliminados as $key => $value ){
	$key = date('d/m/y',$key);
	$serie2->addPoint(new Point($key, $value));
}

$dataSet = new XYSeriesDataSet();
$dataSet->addSerie("Post", $serie1);
$dataSet->addSerie("Eliminados", $serie2);

$grafico = "../cache/".$aleatorio.".jpg";
$chart->setDataSet($dataSet);
$chart->setTitle("Eliminados Por D&iacute;a");
$chart->render($grafico);
echo "<img src=\"".$grafico."\"><br />\n";


// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>
