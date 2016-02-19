
<body bgcolor="#C0C0C0">
<b><font color=red>Inscription terminée</font></b></a><br><br>

<?php
$Id = $_COOKIE['Id'];

if ($Id=='OKDAK') {

include ("../../aqua_haut.htm"); 
include ("../../conex.inc");
include ("fonctions.inc");
require ("../../config_log.inc");

$sexe = getHTTPVars("sexe", $_POST, $_GET);
$nom = getHTTPVars("nom", $_POST, $_GET);
$prenom = getHTTPVars("prenom", $_POST, $_GET);
$adresse = getHTTPVars("adresse", $_POST, $_GET);
$cp = getHTTPVars("cp", $_POST, $_GET);
$ville = getHTTPVars("ville", $_POST, $_GET);
$naiss = getHTTPVars("naiss", $_POST, $_GET);
$mail = getHTTPVars("mail", $_POST, $_GET);
$fone = getHTTPVars("fone", $_POST, $_GET);
$activ = getHTTPVars("activ", $_POST, $_GET);
$autre = getHTTPVars("autre", $_POST, $_GET);
$pass = getHTTPVars("pass", $_POST, $_GET);
$id_key_pere = getHTTPVars('id_key_pere', $_POST, $_GET);
$id_key_mere = getHTTPVars('id_key_mere', $_POST, $_GET);
$lefic = getHTTPVars('lefic', $_POST, $_GET);

	//INSERT dans la table coordonnées
	$sqlInsert="INSERT INTO `coordonnees` (`sexe`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `fone`, `naiss`, `mail`, `pass`, `activ`, `autre`, `photo`) VALUES ('$sexe', '$nom', '$prenom', '$adresse', '$cp', '$ville', '$fone', '$naiss', '$mail', '$pass', '$activ', '$autre', '$lefic')";
	//echo $sqlInsert."<br><br>";
	
	$result = mysql_query($sqlInsert,$conexion);
	mysql_query($result);

	
	//récupération de la génération du ref_inscript
	// $Sqllist="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key_pere";

	$Sqllist="SELECT * FROM identifiant WHERE id_key='$id_key_pere'";

	if ($prenomdupere=="Non_enregistré" && $prenomdumere!=="Non_enregistré") {
		$Sqllist="SELECT * FROM identifiant WHERE id_key='$id_key_mere'";
	}

	$Resultlist = mysql_query($Sqllist,$conexion);
	mysql_query($Resultlist);
	while($Vallist=mysql_fetch_array($Resultlist)){
		$generation=$Vallist["generation"];
		$generation=$generation+1;
	}
	
		
	//récupération de l'Id_key pour avoir le même dans la table identifiant
	$sqlRecupId="SELECT * FROM coordonnees WHERE nom='$nom' AND prenom='$prenom'";
	//echo $sqlRecupId."<br><br>";

	$resultRecupId = mysql_query($sqlRecupId,$conexion);
	mysql_query($resultRecupId);
	while($valv=mysql_fetch_array($resultRecupId)){
		$id_key = $valv["id_key"];
	}
	
	

	
	//INSERT dans la table identifiant
	$sqlInsert1="insert into identifiant (id_key, id_key_pere, id_key_mere, statut_social, virtuel, generation, id_key_epoux) values ('$id_key', '$id_key_pere', '$id_key_mere', 'S', 'N', '$generation', '')";
	//echo $sqlInsert1."<br><br>";
	$result1 = mysql_query($sqlInsert1,$conexion);
	mysql_query($result1);

	


$n="Tr@mbyn";
$m="webmaster@webmaster.fr";
$nT=$nom;
$mT=$mail;
$sujet="Bienvenue%20sur%20la%20généalogie";
$body="Vous venez de vous inscrire dans la généalogie\nNom : ".$nom."\nPrenom : ".$prenom."\nMot de passe : ".$pass."\nMail : ".$mail."\nRappel : \nLogin du site : ".$loginmemb."\nMot de passe du site : ".$passmemb."\nadresse internet";

function sendMail($n,$m,$nT,$mT,$sujet,$body) {
   // l'émetteur
   $tete = "From: ".$n." <".$m.">\n";
   $tete .= "Reply-To: ".$m."\n";
   // et zou... false si erreur d'émission
   return mail($nT." <".$mT.">",$sujet,$body,$tete);
   }
   
sendMail($n,$m,$nT,$mT,$sujet,$body);

?>
<H1><align=center><font color=red> Vous êtes bien enregistré.... vous allez recevoir un mail de confirmation !<br><br><br>
<h4>Vous pouvez maintenant fermer cette fenêtre

	<?php 
include ("../../aqua_bas.htm"); 
}
?>