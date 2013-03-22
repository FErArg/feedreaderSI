<html>
<head>
<title>OPML Parser Example</title>
</head>
<body>
<form action="index.php" method="post" name="form1" target="_self" id="form1">
  <label>URL of OPML file
  <input name="url" type="text" id="url" value='google-reader-subscriptions.xml' size="60" maxlength="255"/>
  </label>
  <p>
    <label>
    <input type="submit" name="Submit" value="Submit" />
    </label>
  </p>
</form>
<?php
require_once('iam_opml_parser.php');
include('../framework.php');
mysql00();
mysql_error();
if($_POST['url']!=''){
	$parser = new IAM_OPML_Parser();
	$parser->displayOPMLContents($_POST['url']);

	/*
		echo "<pre>";
		print_r($parser);
		echo "</pre>";
	*/
	$i = '0';
	$feedsArray = array();

	foreach( $parser as $key1 => $value1 ){
		if( $key1 == 'data' ){
			foreach( $value1 as $key2 => $value2 ){
				// $key2." - <br />";
/*
				echo "<pre>";
				print_r($value2);
				echo "</pre>";
*/
				if( isset($value2['names']) AND empty($value2['urls']) AND empty($value2['feeds']) ){
					// echo "Cat ".$value2['names']."<br />\n";
					$categoria = $value2['names'];
				} else{
					// echo "Nom ".$value2['names']."<br />\n";
					// echo "Feed ".$value2['feeds']."<br />\n";
					$feedsArray[$categoria][$i] = $value2;
				}
				if(	$categoria2 == $categoria ){
					$i++;
				} else{
					$categoria2 = $categoria;
					$i = '0';
				}
				// echo $i;
			}
		}
	}
}
/*
echo "<pre>";
print_r($feedsArray);
echo "</pre>";
*/

foreach( $feedsArray as $key => $value ){
	// echo $key." - ".$value."<br />\n";
	$tag = $key;
	// echo "CATEGORIA ".$cat."<br />\n";
	foreach( $value as $key2 => $value2 ){
		 // echo $key2." - ".$value2."<br />\n";
		 $j = 'NO';
		 foreach( $value2 as $key3 => $value3 ){
			// echo $key3." - ".$value3."<br />\n";
			if( empty($value3) ){
				unset($value2[$key3]);
			}
			if( $key3 == 'names' ){
				$nombre = $value3;
				$a1 = '1';
				// echo $nombre."<br />\n";
			} elseif( $key3 == 'feeds' ){
				$rss = $value3;
				$b1 = '1';
				// echo $rss."<br />\n";
			}


			if( $a1 == '1' AND $b1 == '1' AND $j == 'NO'){
				echo "Tag ".$tag."<br /> Nombre ".$nombre." -<br /> Feed ".$rss."<br />\n";

				// buscar tag en DB, si no existe, cargar a DB
				$campos = 'id';
				$tabla = 'tags';
				$columna1 = 'tag';
				$queBuscar1 = $tag;
				// $tagIdRtdo = mysql02($campos,$tabla,$columna1,$queBuscar1);
				$tagId = mysql02($campos,$tabla,$columna1,$queBuscar1);

/*
				if( empty($tagIdRtdo) ){
					mysql_query("INSERT INTO tags (tag)
						VALUES ('$tag')");
						// echo "TAG".$tagId."<br /> \n";
						$campos = 'id';
						$tabla = 'tags';
						$columna1 = 'tag';
						$queBuscar1 = $tag;
						$tagId = mysql02($campos,$tabla,$columna1,$queBuscar1);
				}
*/
				// cargar datos en DB
				mysql_query("insert into rss (usuarioId, rss, nombre, tagId)
					values ('2','$rss','$nombre','$tagId')");

				echo mysql_error()."<br /> \n";

				$j = 'SI';
				unset($nombre);
				unset($rss);
				unset($a1);
				unset($b1);
			}
		}
	}
}

?>
</body>
</html>

