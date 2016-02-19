<?php
	if (copy($userfile, "..trombi/images/mini/".$userfile_name)) {
		//echo "ok"; 
	} else {
		//echo "pas ok";
	}
	unlink($userfile);




$db = mysql_connect("localhost","genelogin","");
mysql_select_db("callnet",$db);



$table="coordonnees";

   $query = "INSERT INTO $table(url,categorie,description)";
   $query .= " VALUES('$userfile_name','$categ','$descript')"; 
   $result = mysql_query($query);

header("Location: ../index2.php?tab=photo"); 
?>