<?php

include ("../conex.inc");
	
$SqlVerif="SELECT * FROM coordonnees";
$resultVerif = mysql_query($SqlVerif,$conexion);
mysql_query($resultVerif);
	while($valv=mysql_fetch_array($resultVerif)){
		$lelogin = $valv["prenom"];
		$lepass = $valv["pass"];
		$lekeyref = $valv["id_key"];
	
		//echo "<br>".$lelogin."_".$login."_".$lepass."_".$pass;
		//echo "<br>".$lekey;

		
		if ( ($lepass==$pass) and ($lelogin==$login) and ($lekeyref=3)) {
			$valid="sa";
			break;
			$err="";
		} elseif ( ($lepass==$pass) and ($lelogin==$login) ) {
			$valid="ok";
			break;
			$err="";
				
		} else {
			
			//header ("location:../index.php?err=inc");
		}
	}
		
	$ladir="location:cookie.php?lekeyref=".$lekeyref."&valid=".$valid."&err=".$err;
	//echo $ladir;
	header ($ladir);
?>