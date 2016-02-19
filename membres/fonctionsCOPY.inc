<?php

//récupère la liste des inscrits dans la généalogie définie par $login
function ListInscrits($login,$conexion) {
	//$conlist = mysql_connect('localhost','callnet','bpbm00');
	mysql_select_db($login,$conexion);

	$Sqllist="SELECT * FROM coordonnees";

	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	echo "<select size=1 name=\"id_key_refinscript\"><option value=\"\">------</option>";

	while($Vallist=mysql_fetch_array($Resultlist)){
		if ($Vallist["nom"]<>"virtuel") {
			echo "<option value=".$Vallist["id_key"].">".$Vallist["nom"]." ".$Vallist["prenom"]."</option>";
		}
	}
	echo "</select>";
}

function ListFemmeInscrits($login,$conexion) {
	//$conlist = mysql_connect('localhost','callnet','bpbm00');
	mysql_select_db($login,$conexion);

	$Sqllist="SELECT * FROM coordonnees WHERE sexe='F'";

	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	echo "<select size=1 name=\"id_key_femme\"><option value=\"\">------</option>";

	while($Vallist=mysql_fetch_array($Resultlist)){
		if ($Vallist["nom"]<>"virtuel") {
			echo "<option value=".$Vallist["id_key"].">".$Vallist["nom"]." ".$Vallist["prenom"]."</option>";
		}
	}
	echo "</select>";
}

function ListEpoux($login,$conexion) {
	//$conlist = mysql_connect('localhost','callnet','bpbm00');
	mysql_select_db($login,$conexion);

	$Sqllist="SELECT * FROM coordonnees";

	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	echo "<select size=1 name=\"id_key_epoux\"><option value=\"\">------</option>";

	while($Vallist=mysql_fetch_array($Resultlist)){
		if ($Vallist["nom"]<>"virtuel") {
			echo "<option value=".$Vallist["id_key"].">".$Vallist["nom"]." ".$Vallist["prenom"]."</option>";
		}
	}
	echo "</select>";
}

//boutons radio pour liens de parenté à la généalogie
function ChoixReferantInscript() {
	?>
		est<br>
		mon père <input type="radio" name="RefInscript" value="pere" checked><br>
		ma mère <input type="radio" name="RefInscript" value="mere"><br>
		mon fils <input type="radio" name="RefInscript" value="fils"><br>
		ma fille <input type="radio" name="RefInscript" value="fille"><br>
		mon/ma cousin(e) <input type="radio" name="RefInscript" value="cousin"><br>
		mon grand-père <input type="radio" name="RefInscript" value="gmere"><br>
		ma grand-mère <input type="radio" name="RefInscript" value="gpere"><br>
	<?php
}	

//formulaire d'inscription sans balise form
function FormulaireInscript($login,$conexion) {
	?>
	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
<tr>
    <td width="50%" bgcolor="#CCCCCC"><font color="red">*</font>Sexe</td>
    <td width="50%" bgcolor="#CCCCCC">M<input type="radio" name="sexe" value="M" checked>/ F<input type="radio" name="sexe" value="F"></td>
    <td width="34%" rowspan="13">
			<input type="radio" checked name="couple" value="S"> célibataire
			     
			    <div id="menu1" onclick="showhide(menu1in, menu1out)">
			    <input type="radio" value="C"  name="couple" id="menu1out"> marié ou en couple
			    </div>
			    
				<span id="menu1in" style="display:'none'">
				<div><p><b>Quelqu'un d'enregistré<br><?php ListEpoux($login,$conexion); ?><br><br>
				<font color="red"><b>ou</b></font><br><br>
				Quelqu'un pas encore enregistré :</b><br><?php include('formconjoint.php'); ?></div>
	   
    </td>

  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD"><font color="red">*</font>Nom</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="nom"></td>
  </tr>
  <tr>
    <td width="50%"><font color="red">*</font>Prenom</td>
    <td width="50%"><input type="text" value="" name="prenom"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD">Adresse</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="adresse"></td>
  </tr>
  <tr>
    <td width="50%">Code Postal</td>
    <td width="50%"><input type="text" value="" name="cp"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD">Ville</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="ville"></td>
  </tr>
  <tr>
    <td width="50%"><font color="red">*</font>Date de Naissance</td>
    <td width="50%"><input type="text" value="" name="naiss"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD"><font color="red">*</font>Email</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="mail"></td>
  </tr>
  <tr>
    <td width="50%">Téléphone</td>
    <td width="50%"><input type="text" value="" name="fone"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD">Activité</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="activ"></td>
  </tr>
  <tr>
    <td width="50%">Autre</td>
    <td width="50%"><input type="text" value="" name="autre"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD"><font color="red">*</font>Mot de passe</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="pass"></td>
  </tr>
  <tr>
    <td width="50%" valign="top"></td>
    <td width="50%" valign="top"></td>
  </tr>
</table>

	<?php
}	


//crea pere virtuel
function CreaPereVirtuel($login,$conexion) {
	
	//$conpere = mysql_connect('localhost','callnet','bpbm00');
		
	$sqlInsertpere="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`) VALUES ('M', '$nom', '', '', '', '', '', '', '', '', '','')";
	
	
	$resultpere = mysql_query($sqlInsertpere,$conexion);
	mysql_query($result2);
	
	$sqlRecupId="SELECT * FROM coordonnees";
	//echo $sqlRecupId;
	$resultRecupId = mysql_query($sqlRecupId,$conexion);
	mysql_query($resultRecupId);
	while($valv=mysql_fetch_array($resultRecupId)){
		global $id_key_pere;
		$id_key_pere = $valv["id_key"];
	}
		
	mysql_select_db($login,$conexion);
	$sqlInsertpere2="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_key_pere', '', '', 'I', 'O', '-1', '')";
	$resultpere = mysql_query($sqlInsertpere2,$conexion);
	mysql_query($resultpere);
	
}

//crea mere virtuel
function CreaMereVirtuel($login,$conexion) {
	
	//$conmere = mysql_connect('localhost','callnet','bpbm00');
		
	$sqlInsertmere="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`) VALUES ('F', '$nom', '', '', '', '', '', '', '', '', '','')";
	
	
	$resultmere = mysql_query($sqlInsertmere,$conexion);
	mysql_query($resultmere);
	
	$sqlRecupId="SELECT * FROM coordonnees";

	$resultRecupId = mysql_query($sqlRecupId,$conexion);
	mysql_query($resultRecupId);
	while($valv=mysql_fetch_array($resultRecupId)){
		global $id_key_mere;
		$id_key_mere = $valv["id_key"];
	}

	mysql_select_db($login,$conexion);
	$sqlInsertmere2="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_key_mere', '', '', 'I', 'O', '-1', '')";
	$resultmere = mysql_query($sqlInsertmere2,$conexion);
	mysql_query($resultmere);
}


									
?>