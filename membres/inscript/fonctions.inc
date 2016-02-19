<?php

//récupérations des variables
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

//récupère la liste de tous les gens inscripts
function ListInscrits($login,$conexion) {
	mysql_select_db($login,$conexion);

	$Sqllist="SELECT * FROM coordonnees";

	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	echo "<select size=1 name=\"id_key_refinscriptf\"><option value=\"\">------</option>";

	while($Vallist=mysql_fetch_array($Resultlist)){
		if ($Vallist["nom"]<>"virtuel") {
			echo "<option value=".$Vallist["id_key"].">".$Vallist["nom"]." ".$Vallist["prenom"]."</option>";
							

		}
	}
	echo "</select>";
}

//récupère la liste de tous les gens inscripts pour inscription parents
function ListInscritsP($login,$conexion) {
	mysql_select_db($login,$conexion);

	$Sqllist="SELECT * FROM coordonnees";

	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	echo "<select size=1 name=\"id_key_refinscriptp\"><option value=\"\">------</option>";

	while($Vallist=mysql_fetch_array($Resultlist)){
		if ($Vallist["nom"]<>"virtuel") {
			echo "<option value=".$Vallist["id_key"].">".$Vallist["nom"]." ".$Vallist["prenom"]."</option>";
							

		}
	}
	echo "</select>";
}

//récupère la liste des célibataires
function ListInscritsCelib($login,$conexion) {
	mysql_select_db($login,$conexion);
	
	$Sqllist="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key AND ident.statut_social = 'S'";
	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	echo "<select size=1 name=\"id_key_refinscriptc\"><option value=\"\">------</option>";

	while($Vallist=mysql_fetch_array($Resultlist)){
		if ($Vallist["nom"]<>"virtuel") {
			echo "<option value=".$Vallist["id_key"].">".$Vallist["nom"]." ".$Vallist["prenom"]."</option>";
			
		}
	}
	echo "</select>";
}

//récupère la liste des inscrits masculins
function ListInscritsMasculin($login,$conexion) {
	mysql_select_db($login,$conexion);
	
	$Sqllist="SELECT * FROM coordonnees AS coor WHERE coor.sexe = 'M'";
	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	echo "<select size=1 name=\"id_key_refinscriptc\"><option value=\"\">------</option>";

	while($Vallist=mysql_fetch_array($Resultlist)){
		if ($Vallist["nom"]<>"virtuel") {
			echo "<option value=".$Vallist["id_key"].">".$Vallist["nom"]." ".$Vallist["prenom"]."</option>";
			
		}
	}
	echo "</select>";
}

//récupère le sexe de $id_key_refinscript
function SexRef($login,$conexion,$id_key_refinscript) {
	mysql_select_db($login,$conexion);
	$Sqllist="SELECT * FROM coordonnees where id_key=$id_key_refinscript";
	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	while($Vallist=mysql_fetch_array($Resultlist)){
		global $sex_refinscript;
		$sex_refinscript = $Vallist["sexe"];


	}
	echo "</select>";
}


//liste des femmes inscrites
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


//liste des hommes inscrites
function ListHommeInscrits($login,$conexion) {
	//$conlist = mysql_connect('localhost','callnet','bpbm00');
	mysql_select_db($login,$conexion);

	$Sqllist="SELECT * FROM coordonnees WHERE sexe='M'";

	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	echo "<select size=1 name=\"id_key_homme\"><option value=\"\">------</option>";

	while($Vallist=mysql_fetch_array($Resultlist)){
		if ($Vallist["nom"]<>"virtuel") {
			echo "<option value=".$Vallist["id_key"].">".$Vallist["nom"]." ".$Vallist["prenom"]."</option>";
		}
	}
	echo "</select>";
}



//récupère les coordonees du référant
function CoorRef($login,$conexion,$id_key_refinscript) {
	mysql_select_db($login,$conexion);

	$Sqllist="SELECT * FROM coordonnees where id_key=$id_key_refinscript";

	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	
	while($Vallist=mysql_fetch_array($Resultlist)){
			echo $Vallist["prenom"]." ".$Vallist["nom"];
	}
}

//formulaire d'inscription sans balise form
function FormulaireInscript($login,$conexion) {
	?>
	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">

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
    <td width="50%">J<input type="text" value="" name="jnaiss" size=2 maxlength=2>M<input type="text" value="" name="mnaiss" size=2 maxlength=2>A<input type="text" value="" name="anaiss" size=4 maxlength=4></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD">Email</td>
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
</td>
    <td width="50%" valign="top"></td>
  </tr>  <tr>
    <td width="50%" valign="top"></td>
    <td width="50%" valign="top"></td>
  </tr>
</table>

	<?php
}	

?>