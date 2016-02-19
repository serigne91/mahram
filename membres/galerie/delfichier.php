<?php

unlink("uploadimg/".$fichier);

if ($Ident!="undefined") {
//$db = mysql_connect("sql.free.fr","zitounquat","chupetit");
//mysql_select_db("zitounquat",$db);;
	$query = "DELETE FROM foto WHERE Id=$Ident"; 
	$result = mysql_query($query);
}

header('location:indexmf.php?photo=oui');
?>