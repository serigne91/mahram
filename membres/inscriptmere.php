<?php
	require ("fonctions.inc");
	include ("../conex.inc");
?>
<html>
	<head>
		<title>Zitoun.biz</title>
	</head>
	<body bgcolor="#C0C0C0">
		<h1><font color="#8060A0">"GeneaTrombi"</font></h1>

	
				
<?php include ("../aqua_haut.htm"); ?>
		
<b>Inscription</b> --- <a href=../index.php><font size=2 color=green><b>Menu principal</b></font></a><br><br>
		
		<?php

//vérification de quelqu'un déjà inscrit sous ce nom
$SqlVerif="SELECT * FROM coordonnees WHERE nom='$nom' AND prenom='$prenom'";
$ResultVerif = mysql_query($SqlVerif,$conexion);
mysql_query($ResultVerif);
	while($ValVerif=mysql_fetch_array($ResultVerif)){
		$VidePlein = $VidePlein.$ValVerif["id_key"];
	}
	
// si personne d'inscrit sous ce nom/prenom
if ($VidePlein=="") {
		
		if ($couple=="S") {
			$raizon = "Célibatiare";
		} else {
			$raizon = "marié ou en couple";
		}
		
$chaine = "Sexe : ".$sexe
		."<br><b>Nom : ".$nom
		."<br>Prenom : ".$prenom
		."</b><br>Adresse : ".$adresse
		."<br>Code Postal : ".$cp
		."<br>Ville : ".$ville
		."<br>Date de naissance : ".$naiss
		."<br>E_Mail : <a href=mailto:".$mail.">".$mail."</a>"
		."<br>Téléphone : ".$fone
		."<br>Activité : ".$activ
		."<br>Autre : ".$autre
		."<i><b><br>Mot de passe : ".$pass."</b></i>"
		."<br>Raison sociale : ".$raizon
		."<br>Epoux/épouse de  : ".$nomC;
		
		echo $chaine;

$chaine2 = "Sexe : ".$sexeC
		."<br><b>Nom : ".$nomC
		."<br>Prenom : ".$prenomC
		."</b><br>Adresse : ".$adresseC
		."<br>Code Postal : ".$cpC
		."<br>Ville : ".$villeC
		."<br>Date de naissance : ".$naissC
		."<br>E_Mail : <a href=mailto:".$mailC.">".$mailC."</a>"
		."<br>Téléphone : ".$foneC
		."<br>Activité : ".$activC
		."<br>Autre : ".$autreC
		."<i><b><br>Mot de passe : ".$passC."</b></i>"
		."<br>Raison sociale : ".$raizonC
		."<br>Epoux/épouse de  : ".$nom;
		
		
		$lefic=strrchr($userfile,"\\");
	$lefic=substr($lefic,1);
	//echo "<br><br>".$lefic."<br><br>";
		
		if ($couple=='C') { echo $chaine2; }

//ajout enregistrement d'un fils dans la table coordonnees
	$sqlInsert2="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`, `photo`) VALUES ('$sexe', '$nom', '$prenom', '$adresse', '$cp', '$ville', '$fone', '$naiss', '$mail', '$pass', '$activ','$autre','$lefic')";
	$result2 = mysql_query($sqlInsert2,$conexion);
	mysql_query($result2);
	
//ajout enregistrement du conjoint dans coordonnees si marié
if ($couple=="C") {
	$sqlInsert3="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`) VALUES ('$sexeC', '$nomC', '$prenomC', '$adresseC', '$cpC', '$villeC', '$foneC', '$naissC', '$mailC', '$passC', '$activC','$autreC')";
	$result3 = mysql_query($sqlInsert3,$conexion);
	mysql_query($result3);
}
	
//recherche l'id_key dans coordonnees
	$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nom' AND prenom='$prenom'";
	$resultRecupId = mysql_query($sqlRecupId,$conexion);
	while($valv=mysql_fetch_array($resultRecupId)){
		$id_key = $valv["id_key"];
	}
	
	
		if (copy($userfile, "..\\trombi\\images\\mini\\".$lefic)) {
		//echo "ok"; 
	} else {
		//echo "pas ok";
	}
	//unlink($photo);
	
if ($couple=="C") {
	//recherche l'id_key du conjoint
	$sqlRecupIdC="SELECT * FROM coordonnees WHERE nom='$nomC' AND prenom='$prenomC'";
	$resultRecupIdC = mysql_query($sqlRecupIdC,$conexion);
	while($valv=mysql_fetch_array($resultRecupIdC)){
		$id_keyC = $valv["id_key"];
	}
}

//ajout enregistrement d'un fils dans la table identifiant
	$sqlInsert1="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_key', 'idkeypere', '$id_key_refinscript', '$couple', 'N', '1', '$id_keyC')";
	//echo $sqlInsert1;
	$result1 = mysql_query($sqlInsert1,$conexion);
	mysql_query($result1);

//ajout enregistrement du conjoint dans la table identifiant
if ($couple=="C") {
	$sqlInsert4="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_keyC', '', '', '$couple', 'N', '1', '$id_key')";
	$result4 = mysql_query($sqlInsert4,$conexion);
	mysql_query($result4);
}
// demande si le père est deja inscrit
?>
<hr>Votre père est-il dans la liste ?
<form action="pere_update.php" method="post">
<?php
 ListHommeInscrits($login,$conexion);
 ?>
 <input type="hidden" value="<?php echo $id_key; ?>" name="idkey_inscript">
 <input type="submit" value="oui" name="pere_update">
 <input type="submit" value="non" name="pere_update">
</form>
 <?php
//si qlq1 deja inscrit sous ce nom/prenom
} else {
	echo "<b><font color=red>Apparement tu es déjà inscrit</font></b><br><a href=\"indexMF.php?coordosbox=oui&trombibox=&listbox=";
	echo $login;
	echo "\">Retour</a>";
}	
		?>
		
		
<?php include ("../aqua_bas.htm"); ?>
				
	</body>
</html>