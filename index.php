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



include('inc/framework.php');
include('inc/header.php');

// comprueba si es escritorio o movil
$mobile = movilCheck01();
if($mobile == 'TRUE'){
	// echo" template movil";
?>
<STYLE type="text/css">
body{
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size:20px;
}
p, h1, form, button{
	 border:0; margin:0; padding:0;
}
.spacer{
	clear:both; height:1px;
}

.myform{
	margin:0 auto;
	width:80%;
	padding:14px;
}

#stylized{
	border:solid 2px #EBC119;
	background:#F5EA53;
}
#stylized h1 {
	font-size:14px;
	font-weight:bold;
	margin-bottom:8px;
}
#stylized p{
	font-size:20px;
	color:#666666;
	margin-bottom:20px;
	border-bottom:solid 1px #EBC119;
	padding-bottom:10px;
}
#stylized label{
	display:block;
	font-weight:bold;
	text-align:right;
	width:140px;
	float:left;
}
#stylized .small{
	color:#666666;
	display:block;
	font-size:11px;
	font-weight:normal;
	text-align:right;
	width:140px;
}
#stylized input{
	float:left;
	font-size:30px;
	padding:4px 2px;
	border:solid 1px #EBC119;
	width:200px;
	margin:2px 0 20px 10px;
}
#stylized button{
	clear:both;
	margin-left:50px;
	width:125px;
	height:50px;
	background:#666666 no-repeat;
	text-align:center;
	line-height:31px;
	color:#FFFFFF;
	font-size:20px;
	font-weight:bold;
}
</STYLE>
<?php
} else{
	// echo" template PC";
?>
<STYLE type="text/css">
body{
	font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
}
p, h1, form, button{
	 border:0; margin:0; padding:0;
}
.spacer{
	clear:both; height:1px;
}

.myform{
	margin:0 auto;
	width:400px;
	padding:14px;
}

#stylized{
	border:solid 2px #EBC119;
	background:#F5EA53;
}
#stylized h1 {
	font-size:14px;
	font-weight:bold;
	margin-bottom:8px;
}
#stylized p{
	font-size:11px;
	color:#666666;
	margin-bottom:20px;
	border-bottom:solid 1px #EBC119;
	padding-bottom:10px;
}
#stylized label{
	display:block;
	font-weight:bold;
	text-align:right;
	width:140px;
	float:left;
}
#stylized .small{
	color:#666666;
	display:block;
	font-size:11px;
	font-weight:normal;
	text-align:right;
	width:140px;
}
#stylized input{
	float:left;
	font-size:12px;
	padding:4px 2px;
	border:solid 1px #EBC119;
	width:200px;
	margin:2px 0 20px 10px;
}
#stylized button{
	clear:both;
	margin-left:150px;
	width:125px;
	height:31px;
	background:#666666 no-repeat;
	text-align:center;
	line-height:31px;
	color:#FFFFFF;
	font-size:11px;
	font-weight:bold;
}
</STYLE>
<?php
}
?>


<div id="stylized" class="myform">
<p>feedreaderSI</p>
<form action="check.php" method="post">
	<label>	Usuario</label>
		<input type="text" name="usuario" size=10 />
	<label>Clave</label>
		<input type="password" name="clave" size=10 />
<input type="hidden" name="login" />
<button type="submit">Entrar</button>
<div class="spacer"></div>

</form>
</div>

<?php
include('inc/footer.php');
?>
