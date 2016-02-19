<?php	include ("../aqua_haut.htm");
			
	$Sqllist="SELECT * FROM coordonnees WHERE id_key='$lekey'";
						
	if (mysql_query($Sqllist,$conexion)) {
		$Resultlist=mysql_query($Sqllist,$conexion);
		while($Vallist=mysql_fetch_array($Resultlist)){
			echo "<b><font color=red> Bonjour ".$Vallist["prenom"]." ".$Vallist["nom"]."</font></b>";
			$InscriptON = $Vallist["nom"];
		}
		echo "<br><br><a href=modifmf.php><font size=2 color=green><b>Modifier ses coordonnées</b></font></a><br><hr>";
		echo "<a href=../index.php><font size=2 color=green><b>Menu principal</b></font></a><br><br>";
	} else {
		
		
		
if ($ValConnect=="oui") {
	 ?>

<form method="POST" action="<?php if ($envoi==o) { echo "confirmationsa.php?coordosbox=oui"; } else { echo "indexsa.php?coordosbox=oui&envoi=o"; } ?>">

<table><tr><td>

<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
 <tr>
    <td width="50%"><input type="radio" <?php if ($couple=="S") { echo "checked"; }?> name="couple" value="S"> célibataire</td>
    <td><input type="radio" <?php if ($couple=="C") { echo "checked"; }?> value="C" name="couple"> marié ou en couple</td>
  </tr>
  <tr>
    <td width="50%"><font color="red">*</font>Sexe</td>
    <td width="50%">M<input type="radio" name="sexe" value="M" <?php if ($sexe=="M") { echo "checked"; } ?>>/ F<input type="radio" name="sexe" value="F" <?php if ($sexe=="F") { echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD"><font color="red">*</font>Nom</td>
    <td width="50%" bgcolor="#CDCDCD" align="right"><input type="text" value="<?php echo $nom; ?>" name="nom"></td>
  </tr>
  <tr>
    <td width="50%"><font color="red">*</font>Prenom</td>
    <td width="50%" align="right"><input type="text" value="<?php echo $prenom; ?>" name="prenom"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD">Adresse</td>
    <td width="50%" bgcolor="#CDCDCD" align="right"><input type="text" value="<?php echo $adresse; ?>" name="adresse"></td>
  </tr>
  <tr>
    <td width="50%">Code Postal</td>
    <td width="50%" align="right"><input type="text" value="<?php echo $cp; ?>" name="cp"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD">Ville</td>
    <td width="50%" bgcolor="#CDCDCD" align="right"><input type="text" value="<?php echo $ville; ?>" name="ville"></td>
  </tr>
  <tr>
    <td width="50%"><font color="red">*</font>Date de Naissance</td>
    <td width="50%" align="right"><input type="text" value="<?php echo $naiss; ?>" name="naiss"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD"><font color="red">*</font>Email</td>
    <td width="50%" bgcolor="#CDCDCD" align="right"><input type="text" value="<?php echo $mail; ?>" name="mail"></td>
  </tr>
  <tr>
    <td width="50%">Téléphone</td>
    <td width="50%" align="right"><input type="text" value="<?php echo $fone; ?>" name="fone"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD">Activité</td>
    <td width="50%" bgcolor="#CDCDCD" align="right"><input type="text" value="<?php echo $activ; ?>" name="activ"></td>
  </tr>
  <tr>
    <td width="50%">Autre</td>
    <td width="50%" align="right"><input type="text" value="<?php echo $autre; ?>" name="autre"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD"><font color="red">*</font>Mot de passe</td>
    <td width="50%" bgcolor="#CDCDCD" align="right"><input type="text" value="<?php echo $pass; ?>" name="pass"></td>
  </tr>
 
</table>
<br>
<font color="red">*</font>Login la généalogie <input type="text" name="logingene" size="13" value="<?php echo $logingene; ?>"><br>
<font color="red">*</font>Mot de passe de la généalogie <input type="password" name="passgene1" size="13" value="<?php echo $passgene1; ?>"><br>
<font color="red">*</font>Retapez le mot de passe <input type="password" name="passgene2" size="13" value="<?php echo $passgene2; ?>"><br>
<input type="submit" value="<?php if ($envoi==o) { echo "Inscription Super_Admin et conjoint"; } else { echo "Inscription Super_Administrateur"; } ?>" name="creanew">
</td>
<?php

if ($couple=="C") {
	echo "<td width=20></td><td valign=top>";
	include("formconjoint.php");
	echo "</td>";
}
}
?>
</tr>
</table>
</form>

<?php
}
	include ("../aqua_bas.htm");
?>