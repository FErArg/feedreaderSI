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
?>

<form method="POST" action="?w=feedagr2" accept-charset="utf-8">
 <table>
	 <tr>
	   <h3>Nombre</h3>
	</tr>
	<tr>
		<input type="text" class="text" name="nombre" size="50" maxlength="100" />
	</tr>
	 <tr>
	   <h3>RSS</h3>
	</tr>
	<tr>
		<input type="text" class="text" name="rss" size="50" maxlength="100" />
	</tr>
	 <tr>
	   <h3>Tag</h3>
	</tr>
	<tr>
	<?php
			echo $array01['Tag']." ";
			echo "<select class=\"tag\" id=\"tag\" name=\"tagId\">";
			echo "<option value=\"\" selected=\"selected\"></option>\n";
			// busca tags y las convierte en seleccionables
			$tagArray = mysql06('tag','tags');
			// print_r($tagArray);
			foreach ( $tagArray as $key => $value ) {
				$key = $key + 1;
				echo "<option value=\"".$key."\" >".$value."</option>\n";
			}
			echo "</select>";
	?>
	</tr>
	<br />
	<br />
	  <input id="saveForm" class="button_text" type="submit" name="submit" value="Enviar" />
	</tr>
	</table>
</form>


<?php
// Control de la sesion ----------------------------------------------------------------------
} else{
		echo "<h3>No ha iniciado Sesi&oacute;n Correctamente</h3><br />\n";
		echo "<meta http-equiv='refresh' content='2;URL=?w=inicio'>";
}
?>
