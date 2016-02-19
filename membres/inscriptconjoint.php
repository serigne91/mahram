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
		."<br>Raison sociale : ".$raizon;
		
		echo $chaine."<hr>";

		
			
//Enreg du nv conjoint - pièce rapporté


		//le créer
		$sqlInsert2="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`) VALUES ('$sexe', '$nom', '$prenom', '$adresse', '$cp', '$ville', '$fone', '$naiss', '$mail', '$pass', '$activ','$autre')";
		$result2 = mysql_query($sqlInsert2,$conexion);
		mysql_query($result2);
		//recherche de son id_key dans coordonnees
		$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nom' AND prenom='$prenom'";
		$resultRecupId = mysql_query($sqlRecupId,$conexion);
		while($valv=mysql_fetch_array($resultRecupId)){
			$id_key_nvconjoint = $valv["id_key"];
		}
		//generation de l'inscrit
	$Sqlgene="SELECT * FROM identifiant WHERE id_key='$id_key_refinscript'";
	$Resultgene = mysql_query($Sqlgene,$conexion);
	mysql_query($Resultgene);
	while($ValGene=mysql_fetch_array($Resultgene)){
		$geneinscr = $ValGene["generation"];
	}
	
		
		
		
		//ajout dans la table identifiant
			$sqlInsert1="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_key_nvconjoint', '', '', 'C', 'N', '$geneinscr', '$id_key_refinscript')";
			
			$result1 = mysql_query($sqlInsert1,$conexion);

			

		//update du réferant, en couple et id_key du nv_conjoint
		
		$SqlUpdateRef = "UPDATE identifiant SET statut_social='C', id_key_epoux='$id_key_nvconjoint' WHERE id_key='$id_key_refinscript'";
		$ResultUpdateRef = mysql_query($SqlUpdateRef,$conexion);
		mysql_query($ResultUpdateRef);

		echo $sqlInsert2."<br>";
		echo $sqlInsert1."<br>";
		echo $SqlUpdateRef;

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