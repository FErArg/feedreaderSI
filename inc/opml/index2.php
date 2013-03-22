<?php
include('../inc/framework.php');
				// buscar tag en DB, si no existe, cargar a DB
				$campos = 'id';
				$tabla = 'tags';
				$columna1 = 'tag';
				$queBuscar1 = $tag;
				$tagid = mysql02($campos,$tabla,$columna1,$queBuscar1);
				echo mysql_error();
?>
