<?php

if ($pere_update == "non") {
	header("location:indexmf.php");
} else {
	include ("../conex.inc");
	$SqlUpdatePere = "UPDATE identifiant SET id_key_pere='$id_key_homme' WHERE id_key='$idkey_inscript'";
	//echo $SqlUpdatePere;
	$ResultUpdatePere = mysql_query($SqlUpdatePere,$conexion);
	mysql_query($ResultUpdatePere);
	header("location:indexmf.php");
}

?>