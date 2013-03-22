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

/*
 * Funciones escritas por Fernando A. Rodríguez para el uso en SerInformaticos.es
 * Framework v2
*/
// Personalizaciones
$db = "NOMBREDB";
$usuarioId = $_SESSION['usuarioId'];
$style = $_SESSION['style'];
$version = 'v.1';

// OwnClod
$directorio="/var/www/owncloud/data/".$_SESSION['usuario']."/files";
$tagIdOC = '9';
$rssIdOC = '62';

// Menu
function menu00($array){
		$i = '0';
	foreach ($array as $key => $value){
		if( $_SESSION['tipo'] == 'm' ){
			// $array2[$i] = strtolower($array2[$i][$key]);
			$array2[$i] = "<a href=\"".$value."\"><img src=\"imagenes/menu/".$key.".png\" width=\"45\" height=\"45\" alt=\"".$key."\"/></a>\n";
		} else {
			$array2[$i] = "<a class=\"botonMenu\" href=\"".$value."\">".$key."</a>\n";
		}
		$i++;
	}
	return $array2;

}

function menu01($inc2, $menuMovil){
	include('variables.inc.php');

	// permisos usuarios
	$array1 = array(
		'Inicio' => 'index.php',
		'Importante' => 'importante.php',
		'Feeds' => 'rss.php',
		'Tags' => 'tags.php',
		'Ver Elaces' => 'ver.php',
		'Cargar' => 'cargar.php',
		'Configuraci&oacute;n Feeds' => 'feeds/ver.php',
		'Buscar' => 'buscar.php',
		'Salir' => "../check.php?logout");

	$arrayFinal1 = $array1;

	if( $menuMovil == '1' ){

		// Opcion sin Java pero son Boton IR
		$i = '0';
		$arrayFinal2[$i++] = "<form id=\"page-changer\" action=\"\" method=\"post\">\n";
		$arrayFinal2[$i++] = "<select name=\"nav\">";
		foreach ($arrayFinal1 as $key => $value){
			$arrayFinal2[$i] = "<option value=\"".$value."\">".$key."</option>\n";
			$i++;
		}
		$arrayFinal2[$i++] = "<input type=\"submit\" value=\"Ir\" id=\"submit\">\n";
   		$arrayFinal2[$i++] = "</form>\n";

	} else{
		$i = '0';
		foreach ($arrayFinal1 as $key => $value){
			$arrayFinal2[$i] = "<a class=\"botonMenu\" href=\"".$value."\">".$key."</a>\n";
			$i++;
		}
	}
	return $arrayFinal2;

}
function menu02($inc2, $menuMovil){
	include('variables.inc.php');

	// permisos usuarios
	$array1 = array(
		'Agregar Feed' => 'agregar.php',
		'Volver' => '../index.php',
		'Salir' => "../../check.php?logout");

	$arrayFinal1 = $array1;

	if( $menuMovil == '1' ){

		// Opcion sin Java pero son Boton IR
		$i = '0';
		$arrayFinal2[$i++] = "<form id=\"page-changer\" action=\"\" method=\"post\">\n";
		$arrayFinal2[$i++] = "<select name=\"nav\">";
		//  $arrayFinal2[$i++] = "<option value=\"\">Menu...</option>\n";
		foreach ($arrayFinal1 as $key => $value){
			$arrayFinal2[$i] = "<option value=\"".$value."\">".$key."</option>\n";
			$i++;
		}
		$arrayFinal2[$i++] = "<input type=\"submit\" value=\"Ir\" id=\"submit\">\n";
   		$arrayFinal2[$i++] = "</form>\n";

	} else{
		$i = '0';
		foreach ($arrayFinal1 as $key => $value){
			$arrayFinal2[$i] = "<a class=\"botonMenu\" href=\"".$value."\">".$key."</a>\n";
			$i++;
		}
	}
	return $arrayFinal2;

}

// MySQL Querys ------------------------------------------------------------

// Conecta con DB
function mysql00($servidor,$usuario,$clave,$db){
	if ( empty($servidor) AND empty($usuario) AND empty($clave) AND empty($db) ){
		$servidor="SERVIDORDV";
		$usuario="USUARIODB";
		$clave="CLAVEUSUARIODB";
		$db="NOMBREDB";
	}

	$enlace=mysql_connect($servidor,$usuario,$clave);
	if (!$enlace) {
		mysql_close($enlace);
		$a1="Error de Conexi&oacute;n";
	} else {
		$a1="Conectado Correctamente";
	}
	$db=mysql_select_db($db,$enlace);
	return $a1;
}

// busca un elemento en una columna
function mysql02($campos,$tabla,$columna1,$queBuscar1){
	$query1="SELECT $campos FROM $tabla WHERE $columna1='$queBuscar1'";
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	return $resultado[0];
}

// recibe el query de MySQL
function mysql03($query1){
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	return $resultado;
}

// recibe peticion de tabla MySQL y devuelve array con formato de tabla HTML
function mysql04($tabla){
        $qColumnNames = mysql_query("SHOW COLUMNS FROM ".$tabla) or die("mysql error");
        $numColumns = mysql_num_rows($qColumnNames);
        $i = 0;
        while ( $i < $numColumns ){
                $colname = mysql_fetch_row($qColumnNames);
                $col[$i] = "<th>".$colname[0]."</th>";
                $i++;
        }
        $h = 0;
        $resultado[0] = "<tr>";
        while ( $h < $numColumns ){
                $resultado[0] = $resultado[0] . $col[$h];
                $h++;
        }
        $resultado[0] = $resultado[0]."</tr>";
        $query01="SELECT * FROM ".$tabla;
        $query02=mysql_query($query01);
        $numLines = mysql_num_rows($query02);

        $j=0;
        while( $rec = mysql_fetch_row($query02) ){
                for( $k = 0; $k != $numColumns ; $k++){
                        if ( $resultado[1 + $j] == "" ){
                                $resultado[1 + $j] = "<tr>";
                        }
                        if ( $rec[$k] == "" ){
                                $rec[$k] = "-";
                        }
                        $resultado[1 + $j] = $resultado[1 + $j]."<td>".$rec[$k]."</td>";
                }
                $resultado[1 + $j] = $resultado[1 + $j]."</tr>";
                $j++;
        }
        return $resultado;
}

// busca todos los elementos de una columna de una tabla
function mysql06($campo,$tabla){
    $query1="SELECT ".$campo." FROM ".$tabla;
    $query2=mysql_query($query1);
    $i = 0;
    while( $rec = mysql_fetch_row($query2) ){
            $array[$i] = $rec[0];
            $i++;
    }
    return $array;
}

// Busca todos los elementos de los campos asignados de una tabla y
// devuelve array multidimencional
function mysql08($campos, $tabla){
	$query01="SELECT $campos FROM $tabla ";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

}

// busca el/los campos que se le pasa al query y lo convierte en tabla
// con seleccionable segun el primer campo que se le pasa
function mysql10($campos, $tabla){
	$query01="SELECT $campos FROM $tabla";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}

	// elimina espacios y convierte en array los diferentes campos que
	// se pasaron
	$campos = str_replace(" ", "", $campos);
	$arr_campos = explode(",", $campos);
	$nro_campos = count($arr_campos);
	$h = 0;
	$l = 1;
	$rtdo[$h++] = "<table id=\"one-column-emphasis\">\n
    <colgroup>\n
    	<col class=\"oce-first\">\n
    </colgroup>\n
    <tbody>\n";
	foreach( $resultado as $value){
			unset($fila);
			unset($filaHidden);
			$filaHidden ='';
			// crea la tabla con los datos pedidos a la DB
			$fila = "<tr><td>";
			for( $i = 0; $i < $nro_campos; $i++){
				$campo = $arr_campos[$i];
				$fila = $fila . ucwords($value[$campo])."</td>\n<td>";
			}
			// utiliza el primer valor que se paso en el campo "campos"
			// para usarlo como valor identificativo y despues hacer
			// la b&uacute;squeda en la DB y crea la ultima columna con el selector
			$fila = $fila ./* $filaHidden.*/"<input id=\"".$tabla."\" name=\"".$tabla."\" class=\"".$tabla."\" type=\"radio\" value=\"".$value[$arr_campos[0]]."\"></td>\n</tr>\n";
			$rtdo[$h++] = $fila;
			$h++;
			//print "<br />\n";
			$l++;
	}
	$h++;
	$j = '1';
	foreach( $arr_campos as $value){
		$rtdo[$h] = "<input type=\"hidden\" name=\"campos[".$j."]\" value=\"".$value."\" />\n";
		$h++;
		$j++;
	}
	//$rtdo[$h++] = "<input type=\"hidden\" name=\"tabla\" value=\"".$tabla."\" />\n";
	$rtdo[$h++] = "<input type=\"hidden\" name=\"campos[".$j."]\" value=\"".$tabla."\" />\n";
	$rtdo[$h++] =  "</table>";
return $rtdo;

}

// busca todos los elementos de una fila y devuelve array con el
// primer resultado, si se esperan mas resultados usar la funcion
// mysql12 que devuelve array multidimencional
function mysql11($tabla,$enQueColumna,$queBuscar){
	$query1="SELECT * FROM $tabla WHERE $enQueColumna='$queBuscar';";
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	return $resultado;

}

// Busca todos los elementos de los campos asignados de una tabla y
// devuelve array multidimencional para despues separar los elementos
// con un foreach
function mysql12($campos,$tabla,$columna1,$queBuscar1){
	$query01="SELECT $campos FROM $tabla WHERE $columna1 = '$queBuscar1'";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;
}

// Busca todos los elementos de los campos asignados de una tabla y
// devuelve array multidimencional para despues separar los elementos
// con un foreach
function mysql12B($campos, $tabla, $columna1, $queBuscar1, $columna2, $queBuscar2){
	$query01="SELECT $campos FROM $tabla WHERE $columna1 = '$queBuscar1' AND $columna2 = '$queBuscar2'";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;
}

// pide datos a tabla, se declara columna entre 2 fechas y devuelte array
function mysql13($campos, $tabla, $colFecha, $fechaInicio, $fechaFinal){
	$query01="SELECT $campos FROM $tabla WHERE $colFecha BETWEEN '$fechaInicio' AND '$fechaFinal';";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;
}

// busca datos en tabla, limita la salida segun valor de $limite, y lo
// ordena en DESC / ASC segun la columna $colOrden y el orden segun
// $orden que es DESC o ASC
// para DB sin limites usar mysql23
// paar buscaques con ams opciones mysql21
function mysql14($campos, $tabla, $columna, $queBuscar, $colOrden, $limite, $orden){
	$query01="SELECT $campos FROM $tabla WHERE $columna = $queBuscar ORDER BY $colOrden $orden Limit $limite";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

}

//cuenta numero de resultados de busqueda con una condicion
function mysql16($campos,$tabla,$enQueColumna,$queBuscarEnColumna){
	$query1="select count($campos) from $tabla where $enQueColumna = '$queBuscarEnColumna';";
	$query2=mysql_query($query1);
	$resultado=mysql_fetch_row($query2);
	return $resultado[0];
}

// pide datos a DB pero que sean diferentes a $queBuscar
function mysql17($campos, $tabla, $columna, $queBuscar){
	$query01="SELECT $campos FROM $tabla WHERE $columna != '$queBuscar';";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
}

// pide datos a DB pero que sean diferentes a $queBuscar1 u $queBuscar1
// y puede buscarlo en 2 columnas diferentes
function mysql18($campos, $tabla, $columna1, $queBuscar1, $columna2, $queBuscar2){
	$query01="SELECT $campos FROM $tabla WHERE $columna1 != '$queBuscar1' AND $columna2 != '$queBuscar2';";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
}

// pide datos a DB pero que sean uno sea diferente a $queBuscar1 y otro
// igual a u $queBuscar1 y puede buscarlo en 2 columnas diferentes
function mysql19($campos, $tabla, $columnaIg, $queBuscarIg, $columnaDif, $queBuscarDif){
	$query01="SELECT $campos FROM $tabla WHERE $columnaIg = '$queBuscarIg' AND $columnaDif != '$queBuscarDif';";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
}

// pide datos a DB pero que sean uno sea diferente a $queBuscar1 y otro
// igual a u $queBuscar1 y puede buscarlo en 2 columnas diferentes
// y ordena salida
function mysql20($campos, $tabla, $columnaIg, $queBuscarIg, $columnaDif, $queBuscarDif, $colOrden, $orden, $limite){
	$query01="SELECT $campos FROM $tabla WHERE $columnaIg = '$queBuscarIg' AND $columnaDif != '$queBuscarDif' ORDER BY $colOrden $orden Limit $limite;";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
}

// pide datos a DB pero que se cumplan ambas busquedas
// igual a u $queBuscar1 y puede buscarlo en 2 columnas diferentes
// y ordena salida con un limite de peticiones
// peticion sin limites en funcion mysql25
function mysql21($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $colOrden, $orden, $limite){
	$query01="SELECT $campos FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 = '$queBuscar2' ORDER BY $colOrden $orden Limit $limite";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;

}

// actualiza campo de DB con un solo indice de busqueda
// para mas columnos ver mysql24
function mysql22($tabla, $columna1, $valorNuevo1, $columnaBuscar, $queBuscar){
	$query01="UPDATE $tabla SET $columna1 = $valorNuevo1 WHERE $columnaBuscar = '$queBuscar'";
    $query02=mysql_query($query01);

}

// busca datos en tabla, sin l&iacute;mite, y lo
// ordena en DESC / ASC segun la columna $colOrden y el orden segun
// $orden que es DESC o ASC
// para DB con limites usar mysql14
function mysql23($campo, $tabla, $columna, $buscarEnColumna, $colOrden, $orden){
	$query01="SELECT $campo FROM $tabla WHERE $columna = '$buscarEnColumna' ORDER BY $colOrden $orden ";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

}

// actualiza campo de DB con un solo indice de busqueda
// para 1 columna ver mysql22
function mysql24($tabla, $columna1, $valorNuevo1, $columna2, $valorNuevo2, $columnaBuscar, $queBuscar){
	$query01="UPDATE $tabla SET $columna1 = $valorNuevo1, $columna2 = $valorNuevo2 WHERE $columnaBuscar = $queBuscar";
    $query02=mysql_query($query01);
    return $query02;
}

// pide datos a DB pero que se cumplan ambas busquedas
// igual a u $queBuscar1 y puede buscarlo en 2 columnas diferentes
// y ordena salida con un limite de peticiones
// peticion con limites en funcion mysql21
function mysql25($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $colOrden, $orden){
    $query02=mysql_query("SELECT $campos FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 = '$queBuscar2' ORDER BY $colOrden $orden");
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
/*
$campos = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$queBuscar2 = '';
$colOrden = '';
$orden = '';
$resultado = mysql25($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $colOrden, $orden);
*/
}

// pide datos a DB pero que se cumplan ambas busquedas
// igual a u $queBuscar1 y puede buscarlo en 2 columnas diferentes
// y ordena salida con un limite de peticiones
// y se le declaran los signos " =, <, >, != "
function mysql26($campos, $tabla, $columna1, $signo1, $queBuscar1, $columna2, $signo2, $queBuscar2, $colOrden, $orden, $limite){
    $query02=mysql_query("select $campos FROM $tabla WHERE $columna1 $signo1 '$queBuscar1' AND $columna2 $signo2 '$queBuscar2' ORDER BY $colOrden $orden LIMIT $limite");
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;

/*
$campos = '';
$tabla = '';
$columna1 = '';
$signo1 = '';
$queBuscar1 = '';
$columna2 = '';
$signo2 = '';
$queBuscar2 = '';
$colOrden = '';
$orden = '';
$limite = '';
resultado = mysql26($campos, $tabla, $columna1, $signo1, $queBuscar1, $columna2, $signo2, $queBuscar2, $colOrden, $orden, $limite);

Como ver los datos
foreach( $resultado as $value){
	foreach( $value as $value){
		echo $value."<br />";
	}
}
*/
}

// busca campos en tabla sin buscar coincidencias, se usa para buscar
// todos los elementos de una tabla, en diferentes campos limitados en
// cantidad y ordenados
// sin limite ver mysql28
function mysql27($campo, $tabla, $colOrden, $limite, $orden){
	$query01="SELECT $campo FROM $tabla ORDER BY $colOrden $orden Limit $limite; ";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

/*
Como ver los datos
$campo = '';
$tabla = '';
s$colOrden = '';
$limite = '';
$orden = '';
$resultado = mysql27($campo, $tabla, $colOrden, $limite, $orden);
foreach( $resultado as $value){
	foreach( $value as $value){
		echo $value."<br />";
	}
}
*/
}

// busca campos en tabla sin buscar coincidencias, se usa para buscar
// todos los elementos de una tabla, en diferentes campos limitados en
// cantidad y ordenados
// con limite ver mysql27
function mysql28($campo, $tabla, $colOrden, $orden){
	$query01="SELECT $campo FROM $tabla ORDER BY $colOrden $orden; ";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

/*
Como ver los datos
$campo = '';
$tabla = '';
s$colOrden = '';
$limite = '';
$orden = '';
$resultado = mysql28($campo, $tabla, $colOrden, $orden);
foreach( $resultado as $value){
	foreach( $value as $value){
		echo $value."<br />";
	}
}
*/
}

// pide datos a DB pero que se cumplan las 3 condiciones de busquedas
// igual a u $queBuscar1 y puede buscarlo en 3 columnas diferentes
// y ordena salida con un limite de peticiones
// peticion sin limites en funcion mysql30
// menos condiciones en mysql21
function mysql29($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $colOrden, $orden, $limite){
	$query01="SELECT $campos FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 = '$queBuscar2' AND $columna3 = '$queBuscar3' ORDER BY $colOrden $orden Limit $limite";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
/*
$campos = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$queBuscar2 = '';
$columna3 = '';
$queBuscar3 = '';
$colOrden = '';
$orden = '';
$limite = '';
*/
}

// pide datos a DB pero que se cumplan las 3 condiciones de busquedas
// igual a u $queBuscar1 y puede buscarlo en 3 columnas diferentes
// y ordena salida con un limite de peticiones
// peticion con limites en funcion mysql29
// menos condiciones en mysql21
function mysql30($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $colOrden, $orden){
	$query01="SELECT $campos FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 = '$queBuscar2' AND $columna3 = '$queBuscar3' ORDER BY $colOrden $orden";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
/*
$campos = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$queBuscar2 = '';
$columna3 = '';
$queBuscar3 = '';
$colOrden = '';
$orden = '';
$resultado = mysql30($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $colOrden, $orden);
*/
}

// pide datos a DB pero que se cumplan las 2 condiciones de busquedas
// busca elemento igual a queBuscar1 en columna1
// ademas debe cumplir que queBuscar2 sea mayor a columna2
// y los ordenada por colOrden
// para "<" usar mysql32
function mysql31($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $colOrden, $orden){
	$query01="SELECT $campos FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 > '$queBuscar2' ORDER BY $colOrden $orden";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
/*
$campos = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$queBuscar2 = '';
$colOrden = '';
$orden = '';
$resultado = mysql31($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $colOrden, $orden);


Como ver los datos
foreach( $resultado as $value){
	foreach( $value as $value){
		echo $value."<br />";
	}
}

*/
}

// pide datos a DB pero que se cumplan las 2 condiciones de busquedas
// busca elemento igual a queBuscar1 en columna1
// ademas debe cumplir que queBuscar2 sea menor a columna2
// y los ordenada por colOrden
// para ">" usar mysql31
function mysql32($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $colOrden, $orden){
	$query01="SELECT $campos FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 < '$queBuscar2' ORDER BY $colOrden $orden";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
/*
$campos = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$queBuscar2 = '';
$colOrden = '';
$orden = '';
$resultado = mysql31($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $colOrden, $orden);


Como ver los datos
foreach( $resultado as $value){
	foreach( $value as $value){
		echo $value."<br />";
	}
}

*/
}

// pide datos a DB pero que se cumplan las 4 condiciones de busquedas
// igual a u $queBuscar1 y puede buscarlo en 4 columnas diferentes
// y ordena salida con un limite de peticiones
// menos condiciones en mysql21, mysql29 y otros
function mysql33($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $columna4, $queBuscar4, $colOrden, $orden){
	$query01="SELECT $campos FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 = '$queBuscar2' AND $columna3 = '$queBuscar3' AND $columna4 = '$queBuscar4' ORDER BY $colOrden $orden";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
/*
$campos = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$queBuscar2 = '';
$columna3 = '';
$queBuscar3 = '';
$columna4 = '';
$queBuscar4 = '';
$colOrden = '';
$orden = '';
$resultado = mysql33($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $columna4, $queBuscar4, $colOrden, $orden);
*/
}

//
function mysql34($campos1, $tabla1, $columna1, $queBuscar1, $columna2, $inicio1, $final1){
	$query01="SELECT $campos1 FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 BETWEEN '$inicio1' AND '$final1';";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;
/*
$campos1 = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$inicio1 = '';
$final1 = '';
$resultado = mysql34($campos1, $tabla1, $columna1, $queBuscar1, $columna2, $inicio1, $final1);

Como ver los datos
foreach( $resultado as $value){
	foreach( $value as $value){
		echo $value."<br />";
	}
}
*/
}

// pide datos a DB pero que se cumplan ambas busquedas
// igual a u $queBuscar1 y puede buscarlo en 2 columnas diferentes
// y ordena salida y pide entre 2 valores
function mysql35($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $colOrden, $orden, $columna3, $inicio1, $final1){
    $query02=mysql_query("SELECT $campos FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 = '$queBuscar2' AND $columna3 BETWEEN $inicio1 AND $final1 ORDER BY $colOrden $orden");
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
/*
$campos = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$queBuscar2 = '';
$colOrden = '';
$orden = '';
$columna3 = '';
$inicio1 = '';
$final1 = '';
$resultado = mysql35($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $colOrden, $orden, $columna3, $inicio1, $final1);
*/
}

// pide datos a DB pero que se cumplan las 3 condiciones de busquedas
// igual a u $queBuscar1 y puede buscarlo en 3 columnas diferentes
// y ordena salida con un limite
// Es mysql30
function mysql36($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $columna4, $inicio1, $final1, $colOrden, $orden){
	$query01="SELECT $campos FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 = '$queBuscar2' AND $columna3 = '$queBuscar3' AND $columna4 BETWEEN $inicio1 AND $final1 ORDER BY $colOrden $orden";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
/*
$campos = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$queBuscar2 = '';
$columna3 = '';
$queBuscar3 = '';
$columna4 = '';
$inicio1 = '';
$final1 = '';
$colOrden = '';
$orden = '';
$resultado = mysql36($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $columna4, $inicio1, $final1, $colOrden, $orden);
*/
}

// busca todos los elementos de una columna de una tabla
function mysql37($campo,$tabla){
    $query1="SELECT ".$campo." FROM ".$tabla;
    $query2=mysql_query($query1);
    $i = 0;
    while( $rec = mysql_fetch_row($query2) ){
            $array[$i] = $rec[0];
            $i++;
    }
    return $array;
}


// pide datos a DB pero que se cumplan las 4 condiciones de busquedas
// igual a u $queBuscar1 y puede buscarlo en 4 columnas diferentes
// y ordena salida con un limite de peticiones
// menos condiciones en mysql21, mysql29 y otros
function mysql38($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $columna4, $queBuscar4, $columna5, $queBuscar5, $colOrden, $orden){
	$query01="SELECT $campos FROM $tabla1 WHERE $columna1 = '$queBuscar1' AND $columna2 = '$queBuscar2' AND $columna3 = '$queBuscar3' AND $columna4 = '$queBuscar4' AND $columna5 = '$queBuscar5' ORDER BY $colOrden $orden";
    $query02=mysql_query($query01);
	$resultado = array();
	while( $line = mysql_fetch_array($query02, MYSQL_ASSOC) ){
		$resultado[] = $line;
	}
	return $resultado;
/*
$campos = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$queBuscar2 = '';
$columna3 = '';
$queBuscar3 = '';
$columna4 = '';
$queBuscar4 = '';
$columna5 = '';
$queBuscar5 = '';
$colOrden = '';
$orden = '';
$resultado = mysql38($campos, $tabla1, $columna1, $queBuscar1, $columna2, $queBuscar2, $columna3, $queBuscar3, $columna4, $queBuscar4, $columna5, $queBuscar5, $colOrden, $orden);
*/
}


// Busca terminos parecidos en una sola columna
function buscar01($campos1,$tabla1,$columna1,$queBuscar1){
	$query01="SELECT $campos1 FROM $tabla1 WHERE $columna1 LIKE '% $queBuscar1 %'";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

/*
$campos1 = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$resultado = buscar01($campos1,$tabla1,$columna1,$queBuscar1);

Como ver los datos

foreach( $resultado as $value){
	foreach( $value as $key => $value){
		echo $key." - ".$value."<br />";
	}
}
*/
}

// Busca terminos parecidos en dos columnas
function buscar02($campos1,$tabla1,$columna1,$columna2,$queBuscar1){
	$query01="SELECT $campos1 FROM $tabla1 WHERE $columna1 LIKE '% $queBuscar1 %' OR $columna2 LIKE '% $queBuscar1 %'";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

/*
$campos1 = '';
$tabla1 = '';
$columna1 = '';
$columna1 = '';
$queBuscar1 = '';
$resultado = buscar02($campos1,$tabla1,$columna1,$columna2,$queBuscar1);

Como ver los datos

foreach( $resultado as $value){
	foreach( $value as $key => $value){
		echo $key." - ".$value."<br />";
	}
}
*/
}

// Busca terminos parecidos en dos columnas
function buscar03($campos1,$tabla1,$columna1,$columna2,$queBuscar1,$columna3,$queBuscar3){
	$query01="SELECT $campos1 FROM $tabla1 WHERE $columna1 LIKE '% $queBuscar1 %' OR $columna2 LIKE '% $queBuscar1 %' AND $columna3 = '$queBuscar3'";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

/*
$campos1 = '';
$tabla1 = '';
$columna1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna3 = '';
$queBuscar3 = '';
$resultado = buscar03($campos1,$tabla1,$columna1,$columna2,$queBuscar1,$columna3,$queBuscar3);

Como ver los datos

foreach( $resultado as $value){
	foreach( $value as $key => $value){
		echo $key." - ".$value."<br />";
	}
}
*/
}

// Busca terminos parecidos en 3 columnas
function buscar04($campos1,$tabla1,$columna1,$queBuscar1,$columna2,$queBuscar2,$columna3,$queBuscar3,$orden,$colOrden){
	$query01 = "SELECT $campos1 FROM $tabla1 WHERE $columna1 LIKE '%$queBuscar1%' OR
				$columna2 LIKE '%$queBuscar1%' OR
				$columna3 LIKE '%$queBuscar1%'
				ORDER BY $orden $colOrden";
    $query02=mysql_query($query01);
	$resultado = array();
	while($line = mysql_fetch_array($query02, MYSQL_ASSOC)){
		$resultado[] = $line;
	}
	return $resultado;

/*
$campos1 = '';
$tabla1 = '';
$columna1 = '';
$queBuscar1 = '';
$columna2 = '';
$queBuscar2 = '';
$columna3 = '';
$queBuscar3 = '';
$orden = '';
$queBuscar = '';
$resultado = buscar04($campos1,$tabla1,$columna1,$queBuscar1,$columna2,$queBuscar2,$columna3,$queBuscar3,$orden,$colOrden);

Como ver los datos

foreach( $resultado as $value){
	foreach( $value as $key => $value){
		echo $key." - ".$value."<br />";
	}
}
*/
}

//actualiza DB de visitas, controlando quien, como y desde dond entra o
// visitan la web, usa funcion GetOS()
function visitas($usuario){
	if( empty($usuario) ){
		$usuario = 'anonymous';
	}
	$ip = $_SERVER['REMOTE_ADDR'];
	//$cliente = $_SERVER['HTTP_USER_AGENT'];
	$cliente = getBrowser();
	$os = getOS($_SERVER['HTTP_USER_AGENT']);
	$idioma = getDefaultLanguage();
	$fecha = time();
	mysql_query("INSERT INTO visitas (usuario, ip, cliente, os, idioma, fecha)
						values ('$usuario','$ip','$cliente','$os','$idioma','$fecha')");
	return mysql_error();
}

function sesionLogin01($usuarioId, $sesionId){
	$login = time();
	$logout = '0';
	if( !empty($usuarioId) AND $usuarioId != '' AND $usuarioId != '0'){
		mysql_query("INSERT INTO sesiones (usuario, sesiones, login, logout)
						values ('$usuarioId','$sesionId','$login','$logout')");
	}
}
function sesionLogout01($usuarioId, $sesiones){
	$tabla = 'sesiones';
	$columna1 = 'logout';
	$valorNuevo1 = time();
	$columnaBuscar = 'sesiones';
	$queBuscar = $sesiones;
	mysql22($tabla, $columna1, $valorNuevo1, $columnaBuscar, $queBuscar);
}


// PHP -------------------------------------------------------------------
// =======================================================================

// Genera un string de texto alfanumerico del tamaño pasado por la variable
function php01($tamanio){
	$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$string = '';
	for ($i = 0; $i < $tamanio; $i++) {
		$string .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $string;
}

// pide un string aleatorio de N caracteres usando variable numerica
// $n_caracteres, y mete dentro de ese texto el $dato_crypt empezando
// por donde la var. $coord le dice, inserta ese texto y devuelve el
// el nuevo string
function php02($n_caracteres_crypt,$coord,$dato_crypt){
	$n_caracteres = strlen($dato_crypt);
	$texto_crypt = php01($n_caracteres_crypt);
	$texto_n = '';
	for($i = 0; $i < strlen($texto_crypt); $i++){
		while ( $i == $coord){
			for($j = 0; $j < strlen($dato_crypt); $j++){
				$texto_n = $texto_n . $dato_crypt[$j];
				$i++;
			}
		}
		$texto_n = $texto_n . $texto_crypt[$i];
	}
	return $texto_n;
}

// encrypta texto
function php03($clave,$texto){
	$key = $clave;
	$string = $texto;
	$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
	return $encrypted;
}

// des-encrypta texto
function php04($clave,$texto){
	$key = $clave;
	$string = $texto;
	$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	return $decrypted;
}

// genera un numero aleatorio desde y hasta segun variables
function php05($min,$max){
	$random = rand($min,$max);
	return $random;
}

// controla si es navegador movil o PC
function movilCheck01(){
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';

    $mobile_browser = '0';

    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $mobile_browser++;

    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
        $mobile_browser++;

    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
        $mobile_browser++;

    if(isset($_SERVER['HTTP_PROFILE']))
        $mobile_browser++;

    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
    $mobile_agents = array(
                        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
                        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
                        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
                        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
                        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
                        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
                        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
                        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
                        'wapr','webc','winw','winw','xda','xda-'
                        );

    if(in_array($mobile_ua, $mobile_agents))
        $mobile_browser++;

    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
        $mobile_browser++;

    // Pre-final check to reset everything if the user is on Windows
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
        $mobile_browser=0;

    // But WP7 is also Windows, with a slightly different characteristic
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
        $mobile_browser++;

    if($mobile_browser>0)
        return true;
    else
        return false;
/*
Como usarlo
$mobile = movilCheck01();
if($mobile == 'TRUE'){
	echo" template movil";
} else{
	echo" template PC";
}
*/
}

// desencripta los datos encriptados y ofuscados por la funcion php02
function php07($coordenada, $text_des, $text_tam){
	$texto_n = '';
	for($i = 0; $i < strlen($text_des); $i++){
		if ($i >= $coordenada){
			if ($j < $text_tam) {
				$texto_n = $texto_n . $text_des[$i];
				$j++;
			}
		}
	}
	return $texto_n;
}

// Obtiene Sistema Operativo
function getOS($userAgent) {
  // Create list of operating systems with operating system name as array key
	$oses = array (
		'iPhone' => '(iPhone)',
		'Windows 3.11' => 'Win16',
		'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)', // Use regular expressions as value to identify operating system
		'Windows 98' => '(Windows 98)|(Win98)',
		'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
		'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
		'Windows 2003' => '(Windows NT 5.2)',
		'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
		'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
		'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
		'Windows ME' => 'Windows ME',
		'Open BSD'=>'OpenBSD',
		'Sun OS'=>'SunOS',
		'Linux'=>'(Linux)|(X11)',
		'Safari' => '(Safari)',
		'Macintosh'=>'(Mac_PowerPC)|(Macintosh)',
		'QNX'=>'QNX',
		'BeOS'=>'BeOS',
		'OS/2'=>'OS/2',
		'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
	);

	foreach($oses as $os=>$pattern){ // Loop through $oses array
    // Use regular expressions to check operating system type
		if(eregi($pattern, $userAgent)) { // Check if a value in $oses array matches current user agent.
			return $os; // Operating system was matched so return $oses key
		}
	}
	return 'Unknown'; // Cannot find operating system so return Unknown
}

// Obtiene Navegador
function getBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent) ){
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if( preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent) ){
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif(preg_match('/Firefox/i',$u_agent) ){
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif(preg_match('/Chrome/i',$u_agent) ){
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif(preg_match('/Safari/i',$u_agent) ){
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif(preg_match('/Opera/i',$u_agent) ){
        $bname = 'Opera';
        $ub = "Opera";
    } elseif(preg_match('/Netscape/i',$u_agent) ){
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        } else{
            $version= $matches['version'][1];
        }
    } else{
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

	// todos los datos obtenidos
    $info = array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'   => $pattern);

    $yourbrowser = $info['name'] . " " . $info['version'];
    return $yourbrowser;
/*
Como usar:

echo getBrowser();
*/
}



function checkEmail($email) {
  // First, we check that there's one @ symbol,
  // and that the lengths are right.
  if( !ereg("^[^@]{1,64}@[^@]{1,255}$", $email) ){
    // Email invalid because wrong number of characters
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if( !ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i]) ){
      return false;
    }
  }
  // Check if domain is IP. If not,
  // it should be valid domain name
  if( !ereg("^\[?[0-9\.]+\]?$", $email_array[1]) ){
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for( $i = 0; $i < sizeof($domain_array); $i++ ){
      if( !ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])| ([A-Za-z0-9]+))$", $domain_array[$i]) ){
        return false;
      }
    }
  }
  return true;
}

// HTML --------------------------------------------------------------------

// crea enlace
function enlace01($web,$texto){
	echo "<a href=\"$web\">$texto</a>";
	return;
}

// recibe array de 2 valores y devuelve tabla completa
function tabla01($array01){
	$i = '0';
	$array02[$i++] = "<table id=\"one-column-emphasis\">\n
    <colgroup>\n
    	<col class=\"oce-first\">\n
    </colgroup>\n
    <tbody>\n";
	foreach( $array01 as $key => $value){
		$array02[$i++] = "<tr><td>".$key."</td><td>".$value."</td></tr>\n";
	}
	$array02[$i++] = "</tbody>\n</table>\n";
	return $array02;
}

// recibe array de 2 valores y devuelve tabla completa con una columna extra
// para editar el contenido
function tabla02($array01){
	$i = '0';
	$array02[$i++] = "<table border=\"1\">";
	foreach( $array01 as $key => $value){
		if ( $key == 'id' or $key == 'ID' or $key == 'Id'){
			$array02[$i++] = "<tr><td>".$key."</td><td>".$value."</td><td> - </td></tr>\n";
		} else{
			$array02[$i++] = "<tr><td>".$key."</td><td>".$value."</td><td>".$value."</td></tr>\n";
		}
	}
	$array02[$i++] = "</table>";
	return $array02;
}

//reciba array de 2 dimenciones y devuelve tabla
function tabla03($array01){
	$i = '0';
	$array02[$i++] = "<table border=\"0\">";
	foreach( $array01 as $value ){
		foreach( $value as $key => $value){
			$array02[$i++] = "<tr><td>".$key."</td><td>".$value."</td></tr>\n";
		}
		// linea en blanco
		$array02[$i++] = "<tr><td></td><td></td></tr>\n";
	}
	$array02[$i++] = "</table>";
	return $array02;

// foreach( $array02 as $value ){
//	echo $value;
//}
}


// imprime contenido buscado en DB en una linea continua ue se mueve de
// derecha a izquierda
function marquee(){
	// para calendarioSI
	$dias = '5';
	$hoy1 = date("Y-m-j");
	$dia1 = date("Y-m-d",strtotime("+".$dias." days"));

	$colFecha = 'fecha';
	$campos = 'aviso';
	$tabla = 'avisos';
	$fechaInicio = $hoy1;
	$fechaFinal = $dia1;

	$resultado = mysql13($colFecha,$campos,$tabla,$fechaInicio,$fechaFinal);

	foreach( $resultado as $value){
		foreach( $value as $value){
		$marquee = $marquee ." - ". $value;
		}
	}
	$marqueeI = "<marquee bgcolor=\"lightgreen\" behavior=\"scroll\" direction=\"left\" scrollamount=\"10\" scrolldelay=\"150\" width=\"100%\">";
	$marqueeF = "</marquee>";
	$marqueeInf = "<a href=\"http://serinformaticos.es/?file=kop7.php\">Mas Informaci&oacute;n</a>";
	$marquee = $marqueeI ." ". $hoy1." ".$marquee." ".$marqueeInf." ".$marqueeF;

	return $marquee;
}

function marquee2(){
	// para mensajeroSI
	$campos = 'asunto';
	$tabla = 'mensajes';
	$columna = 'usuarioDestino';
	$queBuscar = '3'; // Id usuario web
	$colOrden = 'id';
	$orden = 'DESC';
	$limite = '3';

	$resultado = mysql14($campos, $tabla, $columna, $queBuscar, $colOrden, $limite, $orden);
	$numArray = count($resultado);
	foreach( $resultado as $value){
		if( $numArray > '1' ){
			foreach( $value as $value){
				$marquee = $marquee ." - ". $value;
			}
		} else {
			foreach( $value as $value){
				$marquee = $value ." - ";
			}
		}
	}
	$marqueeI = "<marquee bgcolor=\"#b4d351\" behavior=\"scroll\" direction=\"left\" scrollamount=\"10\" scrolldelay=\"150\" width=\"100%\">";
	$marqueeInf = "<a href=\"http://serinformaticos.es/?file=kop7.php\">Mas Informaci&oacute;n</a>";
	$marqueeF = "</marquee>";
	$marquee2 = $marqueeI ." ".$marquee." ".$marqueeInf." ".$marqueeF;

	return $marquee2;
}

function marquee3(){
	// para mensajeroSI
	$campos = 'asunto, mensaje, fecha';
	$tabla = 'mensajes';
	$columna = 'usuarioDestino';
	$queBuscar = '3'; // Id usuario web
	$colOrden = 'id';
	$orden = 'DESC';
	$limite = '3';

	$resultado = mysql14($campos, $tabla, $columna, $queBuscar, $colOrden, $limite, $orden);

	$i = '0';
	foreach( $resultado as $value){
		if( $i == '0' ){
			$value[fecha] = fechaDesdeUnix($value[fecha]);
			$marquee = "<a href='javascript:onClick=alert(\"".$value[fecha]." - ".$value[mensaje]."\")'>".$value[asunto]."</a> - \n";
			$i++;
		} else {
			$marquee = $marquee ." <a href='javascript:onClick=alert(\"".$value[fecha]." - ".$value[mensaje]."\")'>".$value[asunto]."</a> -\n";
		}
	}
	$marqueeI = "<marquee bgcolor=\"#b4d351\" behavior=\"scroll\" direction=\"left\" scrollamount=\"10\" scrolldelay=\"150\" width=\"100%\">\n";
	$marqueeInf = "<a href=\"http://serinformaticos.es/?file=kop7.php\">Mas Informaci&oacute;n</a>\n";
	$marqueeF = "</marquee>\n";
	$marquee2 = $marqueeI ." ".$marquee." ".$marqueeInf." ".$marqueeF;

	return $marquee2;
}

// conviernte fecha desde unixtime da fecha
function fechaDesdeUnix($fecha){
	$fecha2 = date('Y-m-d H:i:s', $fecha);
	return $fecha2;
}

// toma array de 1 dimension y lo convierte en Select html para formulario
function select01($nombreSelect,$arrayOpciones){
	$i = '0';
	$arrayResultado[$i++] = "<select name=\"$nombreSelect\">";
	foreach( $arrayOpciones as $value ){
		if( $i == '1' ){
			$arrayResultado[$i++] = "<option value=\"".$value."\" selected=\"selected\">".$value."</option>";
		} else {
			$arrayResultado[$i++] = "<option value=\"".$value."\">".$value."</option>";
		}
	}
	$arrayResultado[$i++] = "</select>";
	return $arrayResultado;
/*
foreach( $arrayResultado as $value){
	echo $value."<br />\n";
}
*/
}

// toma array de 2 dimensiones y lo convierte en Select html para formulario
function select02($nombreSelect,$arrayOpciones){
	$i = '0';
	$arrayResultado[$i++] = "<select name=\"$nombreSelect\">";
	foreach( $arrayOpciones as $key => $value ){
		if( $i == '1' ){
			$arrayResultado[$i++] = "<option value=\"".$key."\" selected=\"selected\">".$value."</option>";
		} else {
			$arrayResultado[$i++] = "<option value=\"".$key."\">".$value."</option>";
		}
	}
	$arrayResultado[$i++] = "</select>";
	return $arrayResultado;
/*
foreach( $arrayResultado as $value){
	echo $value."<br />\n";
}
*/
}

// recarga la página cada 30 segundos
function recarga01(){
	$var = <<<INICIO
<script>
/*
Auto Refresh Page with Time script
By JavaScript Kit (javascriptkit.com)
Over 200+ free scripts here!
*/

//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
var limit="0:30"
	if (document.images){
		var parselimit=limit.split(":")
		parselimit=parselimit[0]*60+parselimit[1]*1
	}

	function beginrefresh(){
		if (!document.images)
			return

		if (parselimit==1)
			window.location.reload()
		else{
			parselimit-=1
			curmin=Math.floor(parselimit/60)
			cursec=parselimit%60
			if (curmin!=0)
				curtime=curmin+" minutes and "+cursec+" seconds left until page refresh!"
			else
				curtime=cursec+" seconds left until page refresh!"
				window.status=curtime
				setTimeout("beginrefresh()",1000)
		}
	}
window.onload=beginrefresh
</script>
INICIO;
 return $var;
}

// imprime GPL3 en formato HTML oculto
function gpl3(){
	$glp3= <<<INICIO
<!--
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
-->

INICIO;
	return $gpl3;
}

// obtiene idioma del navegador
function getDefaultLanguage() {
   if( isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ){
      return parseDefaultLanguage($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
   } else{
      return parseDefaultLanguage(NULL);
  }
}

// obtiene idioma del navegador
function parseDefaultLanguage($http_accept, $deflang = "en") {
   if(isset($http_accept) && strlen($http_accept) > 1)  {
      # Split possible languages into array
      $x = explode(",",$http_accept);
      foreach ($x as $val) {
         #check for q-value and create associative array. No q-value means 1 by rule
         if(preg_match("/(.*);q=([0-1]{0,1}\.\d{0,4})/i",$val,$matches))
            $lang[$matches[1]] = (float)$matches[2];
         else
            $lang[$val] = 1.0;
      }

      #return default language (highest q-value)
      $qval = 0.0;
      foreach ($lang as $key => $value) {
         if ($value > $qval) {
            $qval = (float)$value;
            $deflang = $key;
         }
      }
   }
   return strtolower($deflang);
}

function limpiarTexto($texto){
	$texto = str_replace('Ñ', '&Ntilde;', $texto);
	$texto = str_replace('ñ', '&ntilde;', $texto);
	$texto = str_replace('Ü', '&Uuml;', $texto);
	$texto = str_replace('ü', '&uuml;', $texto);
	$texto = str_replace('€', '&euro;', $texto);
	$texto = str_replace('>', '&gt;', $texto);
	$texto = str_replace('<', '&lt;', $texto);
	$texto = str_replace('/', '&#47;', $texto);
	$texto = str_replace('¡', '&iexcl;', $texto);
	$texto = str_replace('¿', '&iquest;', $texto);
	$texto = str_replace('á', '&aacute;', $texto);
	$texto = str_replace('é', '&eacute;', $texto);
	$texto = str_replace('í', '&iacute;', $texto);
	$texto = str_replace('ó', '&oacute;', $texto);
	$texto = str_replace('ú', '&uacute;', $texto);
	$texto = str_replace('Á', '&Aacute;', $texto);
	$texto = str_replace('É', '&Eacute;', $texto);
	$texto = str_replace('Í', '&Iacute;', $texto);
	$texto = str_replace('Ó', '&Oacute;', $texto);
	$texto = str_replace('Ú', '&Uacute;', $texto);
	$texto = str_replace('–', '-', $texto);
	$texto = str_replace('"', '&quot;', $texto);
	$texto = str_replace("'", '&apos;', $texto);
	$texto = str_replace('“', '&rdquo;', $texto);
	$texto = str_replace('”', '&ldquo;', $texto);
	$texto = str_replace('«', '&laquo;', $texto);
	$texto = str_replace('»', '&raquo;', $texto);
	$texto = str_replace('‘', '&lsquo;', $texto);
	$texto = str_replace('’', '&rsquo;', $texto);
	return $texto;
}

function limpiarTexto2($texto){
	$texto = str_replace('Ñ', '&Ntilde;', $texto);
	$texto = str_replace('ñ', '&ntilde;', $texto);
	$texto = str_replace('Ü', '&Uuml;', $texto);
	$texto = str_replace('ü', '&uuml;', $texto);
	$texto = str_replace('€', '&euro;', $texto);
	$texto = str_replace('/', '&#47;', $texto);
	$texto = str_replace('¡', '&iexcl;', $texto);
	$texto = str_replace('¿', '&iquest;', $texto);
	$texto = str_replace('á', '&aacute;', $texto);
	$texto = str_replace('é', '&eacute;', $texto);
	$texto = str_replace('í', '&iacute;', $texto);
	$texto = str_replace('ó', '&oacute;', $texto);
	$texto = str_replace('ú', '&uacute;', $texto);
	$texto = str_replace('Á', '&Aacute;', $texto);
	$texto = str_replace('É', '&Eacute;', $texto);
	$texto = str_replace('Í', '&Iacute;', $texto);
	$texto = str_replace('Ó', '&Oacute;', $texto);
	$texto = str_replace('Ú', '&Uacute;', $texto);
	$texto = str_replace('–', '-', $texto);
	$texto = str_replace('"', '&quot;', $texto);
	$texto = str_replace("'", '&apos;', $texto);
	$texto = str_replace('“', '&rdquo;', $texto);
	$texto = str_replace('”', '&ldquo;', $texto);
	$texto = str_replace('«', '&laquo;', $texto);
	$texto = str_replace('»', '&raquo;', $texto);
	$texto = str_replace('‘', '&lsquo;', $texto);
	$texto = str_replace('’', '&rsquo;', $texto);
	return $texto;
}

function mostrarTexto($texto){
	$texto = str_replace('&#47;', '/', $texto);
	$texto = str_replace('&quot;', '"', $texto);
	$texto = str_replace("\'", "'", $texto);
	$texto = str_replace('&gt;', '>', $texto);
	$texto = str_replace('&lt;', '<', $texto);
	return $texto;
}

function aleatorio01($min,$max){
	$caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$aleatorio = '';
	for ($i = $min; $i < $max; $i++) {
		$aleatorio .= $caracteres[rand(0, strlen($caracteres) - 1)];
	}
	return $aleatorio;
}

function getTitle($url) {
        // we can't treat it as an XML document because some sites aren't valid XHTML
        // so, we have to use the classic file reading functions and parse the page manually
        $fh = fopen($url, "r");
        $str = fread($fh, 7500);  // read the first 7500 characters, it's gonna be near the top
        fclose($fh);
        $str2 = strtolower($str);
        $start = strpos($str2, "<title>")+7;
        $len   = strpos($str2, "</title>") - $start;
        return substr($str, $start, $len);
}

function strip_html_tags($text){
    $text = preg_replace(
        array(
          // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu'
        ),
        array(
            '', '', '', '', '', '', '', '', ''), $text );

    return strip_tags( $text);
}
?>
