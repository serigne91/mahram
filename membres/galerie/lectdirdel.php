<?php
$Id = $_COOKIE['Id'];
	
if ($Id=='OKDAK') {

	

include("../aqua_haut.htm");


$db = mysql_connect("sql.free.fr","zitounquat","chupetit");
mysql_select_db("zitounquat",$db);

	

	$query = "SELECT * FROM foto GROUP BY Id desc"; 
	$result = mysql_query($query);
	// tant qu'il y a des fiches
	while ($val = mysql_fetch_array($result)) { ?>
			<a href="delfichier.php?fichier=<?php echo $val["url"]; ?>&Ident=<?php echo $val["Id"]; ?>"><img src="images/delimg.gif" border="0"></a><img src="<?php echo "uploadimg/".$val["url"]; ?>" width=50> <?php echo $val["categorie"]; ?> <?php echo $val["description"]; ?> <br>
	<?php

		
}
	?>
	<?php


include("../aqua_bas.htm");


} else {
	echo "non autorisé";
}?>