<body bgcolor="#C0C0C0">
<b><font color=red>Inscription --- �tape 3/4</font></b></a><br><br>

<?php
$Id = $_COOKIE['Id'];

if ($Id=='OKDAK') {

include ("../../aqua_haut.htm"); 
include ("../../conex.inc");
include ("fonctions.inc");

//r�cup�ration des variables
$userfile = $_FILES['userfile']['tmp_name'];
$userfile_name = $_FILES['userfile']['name'];
$userfile_name = str_replace(" ","_",$userfile_name);
	//on v�rifie que la photo comporte bien une extension jpg ou gif
	if(!ereg(".gif$", $userfile_name) && !ereg(".jpg$", $userfile_name))
	{
	    $userfile=="";
	    $infos = "Format de photo incorrecte, elle ne sera pas enregistr�e !";
	}


$sexe = getHTTPVars("sexe", $_POST, $_GET);
$nom = getHTTPVars("nom", $_POST, $_GET);
$prenom = getHTTPVars("prenom", $_POST, $_GET);
$adresse = getHTTPVars("adresse", $_POST, $_GET);
$cp = getHTTPVars("cp", $_POST, $_GET);
$ville = getHTTPVars("ville", $_POST, $_GET);
$jnaiss = getHTTPVars("jnaiss", $_POST, $_GET);
$mnaiss = getHTTPVars("mnaiss", $_POST, $_GET);
$anaiss = getHTTPVars("anaiss", $_POST, $_GET);
$mail = getHTTPVars("mail", $_POST, $_GET);
$fone = getHTTPVars("fone", $_POST, $_GET);
$activ = getHTTPVars("activ", $_POST, $_GET);
$autre = getHTTPVars("autre", $_POST, $_GET);
$pass = getHTTPVars("pass", $_POST, $_GET);
$id_key_refinscript = getHTTPVars('id_key_refinscript', $_POST, $_GET);
$sex_refinscript = getHTTPVars('sex_refinscript', $_POST, $_GET);
$login= getHTTPVars("login", $_POST, $_GET);
$infos= getHTTPVars("infos", $_POST, $_GET);


//s'il y a photo on l'upload
if ($userfile<>"") {
	if (copy($userfile, "../../trombi/images/mini/".$userfile_name)) {
		//echo "ok"; 
	} else {
		//echo "pas ok";
	}
	unlink($userfile);
}

	


	echo "<b><font color=red>Vous �tes le conjoint de ";
	CoorRef($login,$conexion,$id_key_refinscript);


echo "<br>sexe : ".$sexe;
echo "<br>nom : ".$nom;
echo "<br>prenom : ".$prenom;
echo "<br>adresse : ".$adresse;
echo "<br>cp : ".$cp;
echo "<br>ville : ".$ville;
	$naiss = $anaiss."-".$mnaiss."-".$jnaiss;
echo "<br>naiss : ".$naiss;
echo "<br>mail : ".$mail;
echo "<br>fone : ".$fone;
echo "<br>autre : ".$autre;
echo "<br>activ : ".$activ;
echo "<br>pass : ".$pass;
echo "<br>photo : ".$userfile_name." ".$infos;

	
	
	
?>
	<form method="POST" action="popup04conj.php">

		<input type="hidden" name="sexe" value="<?php echo $sexe; ?>">
		<input type="hidden" name="nom" value="<?php echo $nom; ?>">
		<input type="hidden" name="prenom" value="<?php echo $prenom; ?>">
		<input type="hidden" name="adresse" value="<?php echo $adresse; ?>">					
		<input type="hidden" name="cp" value="<?php echo $cp; ?>">
		<input type="hidden" name="ville" value="<?php echo $ville; ?>">
		<input type="hidden" name="naiss" value="<?php echo $naiss; ?>">
		<input type="hidden" name="mail" value="<?php echo $mail; ?>">
		<input type="hidden" name="fone" value="<?php echo $fone; ?>">
		<input type="hidden" name="autre" value="<?php echo $autre; ?>">
		<input type="hidden" name="activ" value="<?php echo $activ; ?>">
		<input type="hidden" name="pass" value="<?php echo $pass; ?>">
		<input type="hidden" name="userfile" value="<?php echo $userfile; ?>">
		<input type="hidden" name="lefic" value="<?php echo $userfile_name; ?>">
		

		
		<input type="hidden" name="id_key_refinscript" value="<?php echo $id_key_refinscript; ?>">
		<input type="hidden" name="sex_refinscript" value="<?php echo $sex_refinscript; ?>">
		<a href="javascript:history.back()" border="0"><img src="../images/etapeprec.gif" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;					

		<input type="image" src="../images/etapesuiv.gif" border=0 alt="incription" value="oui name="Valider">
	</form>

	<?php 
include ("../../aqua_bas.htm"); 
}
?>