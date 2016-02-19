<?php

if ($mere_update == "non") {
	header("location:indexmf.php");
} else {
	include ("../conex.inc");
	$SqlUpdateMere = "UPDATE identifiant SET id_key_mere='$id_key_femme' WHERE id_key='$idkey_inscript'";
	
	$ResultUpdateMere = mysql_query($SqlUpdateMere,$conexion);
	mysql_query($ResultUpdateMere);
	header("location:indexmf.php");
}

?>