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
		
		echo $chaine."<hr>";

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
		
		if ($couple=='C') { echo $chaine2; }

								
					
							
			
//si l'inscrit est un homme
if ($sexe == 'M') {

		//le créer
		$sqlInsert2="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`) VALUES ('$sexe', '$nom', '$prenom', '$adresse', '$cp', '$ville', '$fone', '$naiss', '$mail', '$pass', '$activ','$autre')";
		$result2 = mysql_query($sqlInsert2,$conexion);
		mysql_query($result2);
		//recherche de son id_key dans coordonnees
		$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nom' AND prenom='$prenom'";
		$resultRecupId = mysql_query($sqlRecupId,$conexion);
		while($valv=mysql_fetch_array($resultRecupId)){
			$id_key_pere_du_ref = $valv["id_key"];
		}
		//generation de l'inscrit
		$geneinscr = $gene_du_ref-1;
		//ajout dans la table identifiant
			$sqlInsert1="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_key_pere_du_ref', '', '', '$couple', 'N', '$geneinscr', '')";
			echo $sqlInsert1;
			$result1 = mysql_query($sqlInsert1,$conexion);

			
	}

		//s'il est en couple
		if ($couple=='C') {
			//si le conjoint existe deja
			if ($id_key_mere_du_ref != '') {
						$SqlUpdateMere = "UPDATE identifiant SET statut_social='$couple', virtuel='N' WHERE id_key='$id_key_mere_du_ref'";
						$ResultUpdateMere = mysql_query($SqlUpdateMere,$conexion);
						mysql_query($ResultUpdateMere);

						$SqlUpdateMere = "UPDATE coorodonnees SET nom='$nomC', prenom='$prenomC', adresse='$adresseC', cp='$cpC', ville='$villeC', fone='$foneC', mail='$mailC', pass='$passC', activ='$activC', autre='$autreC' WHERE id_key='$id_key_mere_du_ref'";
						$ResultUpdateMere = mysql_query($SqlUpdateMere,$conexion);
						mysql_query($ResultUpdateMere);
			} else {
				//on la crée
				$sqlInsert2="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`) VALUES ('$sexeC', '$nomC', '$prenomC', '$adresseC', '$cpC', '$villeC', '$foneC', '$naissC', '$mailC', '$passC', '$activC','$autreC')";
				$result2 = mysql_query($sqlInsert2,$conexion);
				mysql_query($result2);
				//recherche de son id_key dans coordonnees
				$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nomC' AND prenom='$prenomC'";
				$resultRecupId = mysql_query($sqlRecupId,$conexion);
				while($valv=mysql_fetch_array($resultRecupId)){
					$id_keyC = $valv["id_key"];
				}
				//generation de l'inscrit
				$geneinscr = $gene_du_ref-1;
				//ajout dans la table identifiant
					$sqlInsert1="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_keyC', '', '', '$couple', 'N', '$geneinscr', '$id_key_pere_du_ref')";
					$result1 = mysql_query($sqlInsert1,$conexion);
					mysql_query($result1);
				//update de l'enfant
				$SqlUpdateEnf = "UPDATE identifiant SET id_key_mere='$id_keyC' WHERE id_key='$id_key_refinscript'";
				$ResultUpdateEnf = mysql_query($SqlUpdateEnf,$conexion);
				mysql_query($ResultUpdateEnf);
				
			}
		
	
//si l'inscrit est une femme
} else {
	
		//la créer
		$sqlInsert2="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`) VALUES ('$sexe', '$nom', '$prenom', '$adresse', '$cp', '$ville', '$fone', '$naiss', '$mail', '$pass', '$activ','$autre')";
		$result2 = mysql_query($sqlInsert2,$conexion);
		mysql_query($result2);
		//recherche de son id_key dans coordonnees
		$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nom' AND prenom='$prenom'";
		$resultRecupId = mysql_query($sqlRecupId,$conexion);
		while($valv=mysql_fetch_array($resultRecupId)){
			$id_key_mere_du_ref = $valv["id_key"];
		}
		//generation de l'inscrit
		$geneinscr = $gene_du_ref-1;
		//ajout dans la table identifiant
			$sqlInsert1="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_key', '', '', '$couple', 'N', '$geneinscr', '')";
			$result1 = mysql_query($sqlInsert1,$conexion);
			mysql_query($result1);

	}
	
			//s'il est en couple
		if ($couple=='C') {
			//si le conjoint existe deja
			if ($id_key_pere_du_ref != '') {
						$SqlUpdatePere = "UPDATE identifiant SET statut_social='$couple', virtuel='N' WHERE id_key='$id_key_pere_du_ref'";
						$ResultUpdatePere = mysql_query($SqlUpdatePere,$conexion);
						mysql_query($ResultUpdatePere);

						$SqlUpdateMere = "UPDATE coorodonnees SET nom='$nomC', prenom='$prenomC', adresse='$adresseC', cp='$cpC', ville='$villeC', fone='$foneC', mail='$mailC', pass='$passC', activ='$activC', autre='$autreC' WHERE id_key='$id_key_pere_du_ref'";
						$ResultUpdatePere = mysql_query($SqlUpdatePere,$conexion);
						mysql_query($ResultUpdatePere);
			} else {
				//on la crée
				$sqlInsert2="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`) VALUES ('$sexeC', '$nomC', '$prenomC', '$adresseC', '$cpC', '$villeC', '$foneC', '$naissC', '$mailC', '$passC', '$activC','$autreC')";
				$result2 = mysql_query($sqlInsert2,$conexion);
				mysql_query($result2);
				//recherche de son id_key dans coordonnees
				$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nomC' AND prenom='$prenomC'";
				$resultRecupId = mysql_query($sqlRecupId,$conexion);
				while($valv=mysql_fetch_array($resultRecupId)){
					$id_keyC = $valv["id_key"];
				}
				//generation de l'inscrit
				$geneinscr = $gene_du_ref-1;
				//ajout dans la table identifiant
					$sqlInsert1="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_keyC', '', '', '$couple', 'N', '$geneinscr', '')";
					$result1 = mysql_query($sqlInsert1,$conexion);
					mysql_query($result1);
				//update de l'enfant
				$SqlUpdateEnf = "UPDATE identifiant SET id_key_pere='$id_keyC' WHERE id_key='$id_key_refinscript'";
				$ResultUpdateEnf = mysql_query($SqlUpdateEnf,$conexion);
				mysql_query($ResultUpdateEnf);
			}
		}

	
			//update des id_key_epoux
				//recherche de son id_key inscrit
				$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nom' AND prenom='$prenom'";
				$resultRecupId = mysql_query($sqlRecupId,$conexion);
				while($valv=mysql_fetch_array($resultRecupId)){
					$id_key = $valv["id_key"];
				}				
				//recherche de son id_key conjoint
				$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nomC' AND prenom='$prenomC'";
				$resultRecupId = mysql_query($sqlRecupId,$conexion);
				while($valv=mysql_fetch_array($resultRecupId)){
					$id_keyC = $valv["id_key"];
				}
				
				
				$SqlUpdateEpx = "UPDATE identifiant SET id_key_epoux='$id_keyC' WHERE id_key='$id_key'";
				$ResultUpdateEpx = mysql_query($SqlUpdateEpx,$conexion);
				mysql_query($ResultUpdateEpx);
				
				$SqlUpdateEpx = "UPDATE identifiant SET id_key_epoux='$id_key' WHERE id_key='$id_keyC'";
				$ResultUpdateEpx = mysql_query($SqlUpdateEpx,$conexion);
				mysql_query($ResultUpdateEpx);



//id_key de l'enfant : $id_key_refinscript
	//update du référant
		if ($sexe == 'M') {
			$SqlUpdateEnf = "UPDATE identifiant SET id_key_pere='$couple' WHERE id_key='$id_key_refinscript'";
			$ResultUpdateEnf = mysql_query($SqlUpdateEnf,$conexion);
			mysql_query($ResultUpdateEnf);
		} else {
			$SqlUpdateEnf = "UPDATE identifiant SET id_key_mere='$couple' WHERE id_key='$id_key_refinscript'";
			$ResultUpdateEnf = mysql_query($SqlUpdateEnf,$conexion);
			mysql_query($ResultUpdateEnf);
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