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
include('../inc/framework.php');
include('../inc/header.php');

/*
echo "<pre>";
print_r($_SESSION);
print_r($_GET);
echo "</pre>";
*/

$w = filter_var($_GET['w'], FILTER_SANITIZE_STRING);
if ( !isset($_SESSION['Authenticated']) AND $w == 'inicio' ){
	echo "<meta http-equiv='refresh' content='0;URL=../'>";
}
if ( isset($_SESSION['Authenticated']) AND $_SESSION['Authenticated'] == 1 ){
mysql00();

$menu = array( 'Inicio' => '?w=inicio',
			   'Importante' => '?w=importante',
			   'Protegidos' => '?w=protegido',
			   'Ver' => '?w=ver',
			   'Buscar' => '?w=buscar',
			   'Feeds' => '?w=feeds',
			   'Web' => '?w=web',
			   'Estadisticas' => '?w=estadisticas',
			   'Config' => '?w=config',
			   'Salir' => '?w=salir');
foreach( menu00($menu) as $value){
	echo $value;
}
echo "<br />";
$selection = filter_var($_GET['w'], FILTER_SANITIZE_STRING);
switch($selection)
{
    case 'inicio';
		include('sinleer.php');
	break;

	// IMPORTANTE ------------------------------------------------------
    case 'importante';
		include('importante/importante.php');
	break;
    case 'importante2';
		include('importante/importante2.php');
	break;

	// PROTEGIDOS ------------------------------------------------------
    case 'protegido';
		include('protegido/protegido.php');
	break;
    case 'protegido2';
		include('protegido/protegido2.php');
	break;

	// VER -------------------------------------------------------------
    case 'ver';
		include('ver/ver.php');
	break;
    case 'ver2';
		include('ver/ver2.php');
	break;
    case 'ver3';
		include('ver/ver3.php');
	break;

	// EDITAR ----------------------------------------------------------
    case 'editar';
		include('editar/editar.php');
	break;
    case 'editar2';
		include('editar/editar2.php');
	break;
    case 'editar3';
		include('editar/editar3.php');
	break;

	// EMAIL -----------------------------------------------------------
    case 'email1';
		include('email/email1.php');
	break;
    case 'email2';
		include('email/email2.php');
	break;

	// BUSCAR ----------------------------------------------------------
    case 'buscar';
		include('buscar/buscar.php');
	break;
    case 'buscar2';
		include('buscar/buscar2.php');
	break;

	// FEEDS -----------------------------------------------------------
    case 'feeds';
		include('rss/rss.php');
	break;
    case 'rss2';
		include('rss/rss2.php');
	break;

	// web ------------------------------------------------------------

    case 'web';
		include('web/web.php');
	break;
    case 'web2';
		include('web/web2.php');
	break;





    case 'tag';
		include('tag/tag.php');
	break;

	// FILTROS ------------------------------------------------------------

    case 'filtro';
		include('filtro/filtros.php');
	break;

    case 'selectorf';
		include('filtro/selector.php');
	break;

    case 'fil';
		$b = filter_var($_GET['b'], FILTER_SANITIZE_STRING);
		switch($b){
			case 'agregar';
				include('filtro/acciones/agregar1.php');
			break;
			case 'agregar2';
				include('filtro/acciones/agregar2.php');
			break;
			case 'editar';
				include('filtro/acciones/editar1.php');
			break;
			case 'editarFil2';
				include('filtro/acciones/editar2.php');
			break;
			case 'eliminar';
				include('filtro/acciones/eliminar1.php');
			break;
			case 'eliminar2';
				include('filtro/acciones/eliminar2.php');
			break;
		}
	break;



    case 'filtros';
		include('filtro/filtros.php');
	break;

	// Estadisticas ----------------------------------------------------
	case 'estadisticas';
	echo "Informaci&oacute;n sobre Usuarios <br />\n";
	$arrayEstadisticas = array( 'Post por Dia' => '?w=pxdia',
								'Post Eliminados por Dia' => '?w=exdia',
								'Click por Dia' => '?w=clicksxdia',
								'Click por Dia y Eliminados' => '?w=clicksxelimxdia',
								'Importante por Dia' => '?w=ixdia',
								'Protegido por Dia' => '?w=protxdia',
								'Importantes y Protegidos' => '?w=impoxprot',
								'Totales' => '?w=totales');
	echo "<ul>";
		foreach( menu00($arrayEstadisticas) as $value){
			echo "<li>".$value."</li>";
		}
		break;
	echo "</ul>";

	// Estadisticas x DIA ------------------------------------------
	case 'pxdia'; // Ultimas Visitas
		include('estadisticas/postxdia.php');
	break;

	case 'exdia'; // Eliminados x dia
		include('estadisticas/eliminadosxdia.php');
	break;

	case 'ixdia'; // Importantes x dia
		include('estadisticas/importantexdia.php');
	break;

	case 'protxdia'; // protegidos x dia
		include('estadisticas/protegidoxdia.php');
	break;

	case 'impoxprot'; // importantes y protegidos
		include('estadisticas/impoxprot.php');
	break;

	case 'clicksxdia'; // click x dia
		include('estadisticas/clicksxdia.php');
	break;

	case 'clicksxelimxdia'; // click x dia + eliminados
		include('estadisticas/clicksxelimxdia.php');
	break;

	case 'totales'; // click x dia + eliminados
		include('estadisticas/totales.php');
	break;

	// Configuración ---------------------------------------------------
	case 'config';
	echo "Informaci&oacute;n sobre Usuarios <br />\n";
	$arrayConfig = array(	'Agregar Feeds' => '?w=feedagr',
							'Configurar Feeds' => '?w=feedsc',
							'Configurar Tags' => '?w=tags',
							'Descargar Art&iacute;culos' => '?w=cargar',
							'Descargar Art&iacute;culos owncloud' => '?w=cargar-owncloud',
							);
	echo "<ul>";
	foreach( menu00($arrayConfig) as $value){
		echo "<li>".$value."</li>";
	}
	break;
	echo "</ul>";
		// Config Feeds ------------------------------------------------

		echo "</ul>";
			case 'feedagr';
			include('config/feeds/fagregar.php');
			break;
			case 'feedagr2';
			include('config/feeds/fagregar2.php');
			break;

			case 'feedsc';
			include('config/feeds/fver.php');
			break;
			case 'fver2';
			include('config/feeds/fver2.php');
			break;

			case 'feedsa';
			include('config/feeds/fagregar.php');
			break;
			case 'feedsa2';
			include('config/feeds/fagregar2.php');
			break;

			case 'feditar2';
			include('config/feeds/feditar2.php');
			break;
			case 'feditar3';
			include('config/feeds/feditar3.php');
			break;

			case 'feliminar3';
			include('config/feeds/feliminar3.php');
			break;

		// Cargar ------------------------------------------------------
		case 'cargar';
			include('config/cargar/cargar.php');
		break;
		case 'cargar-owncloud';
			include('config/cargar/cargar-owncloud.php');
		break;

		// TAGS --------------------------------------------------------

		case 'tags';
			include('config/tags/tags.php');
		break;

		case 'selector';
			include('config/tags/selector.php');
		break;

		case 'mat';
			$a = filter_var($_GET['a'], FILTER_SANITIZE_STRING);
			switch($a){
				case 'agregar';
					include('config/tags/acciones/agregar1.php');
				break;
				case 'agregar2';
					include('config/tags/acciones/agregar2.php');
				break;
				case 'editar';
					include('config/tags/acciones/editar1.php');
				break;
				case 'editarTag2';
					include('config/tags/acciones/editar2.php');
				break;
				case 'eliminar';
					include('config/tags/acciones/eliminar1.php');
				break;
				case 'eliminar2';
					include('config/tags/acciones/eliminar2.php');
				break;
			}
		break;





	case 'eliminar3';
		include('varios/eliminar3.php');
	break;
    case 'salir';
    	echo "<meta http-equiv='refresh' content='0;URL=../check.php?logout'>";
	break;

	// Default ---------------------------------------------------------
    default;
        include('sinleer.php');
    break;
}

// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
include('../inc/footer.php');
?>
