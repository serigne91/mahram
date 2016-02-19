<?php
function getHTTPVars($name, $POST, $GET) {
 	$value='';    
	 if (isset($POST[$name])) {
	  	$value = $POST[$name];
	 } elseif (isset($GET[$name])) {
	  	$value = $GET[$name];
	 } else {
	  	$value = '';
	 }
	 return $value;
}	

include ("../conex.inc");
	$ModifPass= getHTTPVars("ModifPass", $_POST, $_GET);
	$ModifId= getHTTPVars("ModifId", $_POST, $_GET);

	
include ("../aqua_haut.htm");
	
	?>
<html><head><title>Modifier ses coordonnées</title></head>



<body bgcolor=#C0C0C0 leftmargin="5" marginwidth="0" topmargin="5" marginheight="0">
		<br><form name="FormName" action="modif_base.php?DetailId=<?php echo $ModifId ?>" method="post" enctype="multipart/form-data">

<?php

	$query = "SELECT * FROM coordonnees WHERE pass='$ModifPass' AND id_key='$ModifId'";
	//echo $query;
	//echo $conexion;

if (mysql_query($query,$conexion)) {
		
	$result = mysql_query($query,$conexion);
	//echo $result;
	if (mysql_num_rows($result)==0) {
		echo "Mot de passe incorrect, vous pouvez fermer cette fenêtre<br><a href=\"javascript:window.close();\">Fermer</a>";
	}
	
	while ($val = mysql_fetch_array($result)) { 
		?>
		
		</p>
		<center>
			<table border="0" cellpadding="0" cellspacing="0" width="198">
				<tr>
					<td><b><i><font size="2">Pr&eacute;nom</font></i></b></td>
					<td><b><i><font size="2">Nom</font></i></b></td>
				</tr>
				<tr>
					<td><input type="text" value='<?php echo $val["prenom"]; ?>' name="ModifPrenom" style="background:#CCCCFF"></td>
					<td><input type="text" value='<?php echo $val["nom"]; ?>' name="ModifNom" style="background:#CCCCFF"></td>
				</tr>
				<tr>
					<td><i><b><font size="2">Adresse</font></b></i></td>
					<td></td>
				</tr>
				<tr>
					<td><input type="text" value='<?php echo $val["adresse"]; ?>' style="background:#CCCCFF" name="ModifAdresse"></td>
					<td><b><i><font size="2">T&eacute;l&eacute;phone</font></i></b></td>
				</tr>
				<tr>
					<td><input type="text" value='<?php echo $val["cp"]; ?>' style="background:#CCCCFF" name="ModifCP"></td>
					<td><input type="text" value='<?php echo $val["fone"]; ?>' style="background:#CCCCFF" name="ModifFone"></td>
				</tr>
				<tr>
					<td><input type="text" value='<?php echo $val["ville"]; ?>' style="background:#CCCCFF" name="ModifVille"></td>
					<td></td>
				</tr>
				<tr>
					<td><b><i><font size="2">N&eacute; le</font></i></b></td>
					<td><b><i><font size="2">Mail</font></i></b></td>
				</tr>
				<tr>
					<td><input type="text" value='<?php echo $val["naiss"]; ?>' style="background:#CCCCFF" name="ModifNaiss"></td>
					<td><input type="text" value='<?php echo $val["mail"]; ?>' style="background:#CCCCFF" name="ModifMail"></td>
				</tr>
			</table>
		</center>
		<center>
			<address><b><font size="2"><i>Activit&eacute;s</i></font></b><br>
			<font color="#030000"><textarea name="ModifActiv" cols="30" rows="4" tabindex="1" style="background:#CCCCFF"><?php echo $val["activ"]; ?></textarea></font><br>
			<b><i><font size="2">Suppl&eacute;ment<br>
			</font></i></b><textarea name="ModifAutre" cols="30" rows="4" style="background:#CCCCFF"><?php echo $val["autre"]; ?></textarea><br>
			
<input type=hidden name="max_file_size" value="1024000">
	<br>
	Photo <input type=file name="userfile"><br><br>

	
<font color=purple size=2><b><i>PS : le nom de l'image ne doit pas comporter d'espaces<br>ni de caractères spéciaux et doit peser moins d'1Mo</i></font>
	
			


		
			<b><font size="2"><i>Mot de passe</i></font></b><input type="text" value='<?php echo $val["pass"]; ?>' style="background:#CCCCFF" name="ModifPass"> 
			<br><br><input type="submit" name="submitButtonName" value="Enregistrer les modifications"> </form>
			<?php
	}
}


include ("../aqua_bas.htm");

 ?>
