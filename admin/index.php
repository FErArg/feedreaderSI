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
$titulo1 = ucwords($usuario);
$subTitulo1 = "Panel de Administración";
include("../inc/framework.php");
include("../inc/header.php");
mysql00();

if ( isset($_SESSION['AuthenticatedAD']) AND $_SESSION['AuthenticatedAD'] == 1 ){

?>

<div class="cabecera">
<ul class="menu">
<?php
$arrayMenu = array(
	'Inicio' => "index.php",
	'Usuarios' => "?select2=usuarios",
	'Visitas' => "?select2=visitas",
	'Estad&iacute;sticas' => "?select2=estadisticas",
	'Salir' => "../check.php?logout");

foreach ($arrayMenu as $key => $value){
			$arrayMenu2[$i] = "<a href=\"".$value."\">".$key."</a>\n";
			$i++;
		}

foreach( $arrayMenu2 as $value){
	echo "<li>".$value."</li>";
}
?>
</ul>

</div>

<div class="izquierda">
<h1>Izquierda</h1>
</div> <!-- izq -->

<div class="derecha">
<?php
// OPCIONES VISIBLES SOLO PARA USUARIO O GRUPO ADMIN

$selection2 = $_GET['select2'];
switch($selection2) {
		// Usuarios ----------------------------------------------------
		case 'usuarios';
		echo "Informaci&oacute;n sobre Usuarios <br />\n";
		$arrayUsuarios = array( 'Alta Usuario' => '?select2=ualta',
								'Modificar Usuario' => '?select2=umodifica',
								'Elimina Usuario' => '?select2=uelimina',
								'Listado de Usuarios' => '?select2=ulistado');

		echo "<ul>";
			foreach( menu00($arrayUsuarios) as $value){
				echo "<li>".$value."</li>";
			}
			break;
		echo "</ul>";

		// Varios Usuarios ---------------------------------------------
		case 'ulistado'; // Ultimas Visitas
			include('../tools/usuarios/usuariosListado.php');
		break;


		// Alta de Usuario ---------------------------------------------
		case 'ualta'; // Formulario de Alta
			include('../tools/usuarios/altas/alta1.php');
		break;
		case 'ualta2'; // carga datos en DB
			include('../tools/usuarios/altas/alta2.php');
		break;

		// Modifica de Usuario ---------------------------------------------
		case 'umodifica'; // Formulario de Alta
			include('../tools/usuarios/modificar/modificar1.php');
		break;
		case 'umodifica2'; // carga datos en DB
			include('../tools/usuarios/modificar/modificar2.php');
		break;
		case 'umodifica3'; // carga datos en DB
			include('../tools/usuarios/modificar/modificar3.php');
		break;


		// Eliminar Usuario ---------------------------------------------
		case 'uelimina'; // Elimina usuario
			include('../tools/usuarios/eliminar/eliminar1.php');
		break;
		case 'uelimina2'; // Elimina usuario
			include('../tools/usuarios/eliminar/eliminar2.php');
		break;
		case 'uelimina3'; // Elimina usuario
			include('../tools/usuarios/eliminar/eliminar3.php');
		break;


		// Visitas -----------------------------------------------------
		case 'visitas';
		echo "Informaci&oacute;n sobre Visitas <br />\n";
		$arrayVisitas = array(  '&Uacute;ltimas Visitas' => '?select2=vultimas');

		echo "<ul>";
			foreach( menu00($arrayVisitas) as $value){
				echo "<li>".$value."</li>";
			}
			break;
		echo "</ul>";

		case 'vultimas'; // Ultimas Visitas
			include('../tools/visitas/visitasUltimas.php');
		break;

		// Estadisticas -------------------------------------------------
		case 'estadisticas';
		echo "Informaci&oacute;n sobre Usuarios <br />\n";
		$arrayEstadisticas = array( 'Post por Dia' => '?select2=pxdia',
								'Modificar Usuario' => '?select2=umodifica');

		echo "<ul>";
			foreach( menu00($arrayEstadisticas) as $value){
				echo "<li>".$value."</li>";
			}
			break;
		echo "</ul>";

		// Estadisticas x DIA ------------------------------------------
		case 'pxdia'; // Ultimas Visitas
			include('../tools/estadisticas/postxdia.php');
		break;

		// Default -----------------------------------------------------
		default;
		extract($_GET);
		if( $select == '' ){
			echo "Elija Opci&oacute;n en Men&uacute; <br />\n";
			include('inicio.php');
		}
		break;
}

// ***********************************************************************
// -----------------------------------------------------------------------
?>
</div> <!-- /derecha -->

<?php
// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
// Control de la sesion ----------------------------------------------------------------------
?>

<div class="pie">
<h1>Pie</h1>
<?php include("../inc/footer.php"); ?>
</div> <!-- pie -->
