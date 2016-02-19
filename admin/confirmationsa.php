<?php

function getHHTPVars($name, $POST, $GET)
{
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

$userfile = $_FILES['userfile']['tmp_name'];
$userfile_name = $_FILES['userfile']['name'];
$userfile_name = str_replace(" ","_",$userfile_name);

if(!ereg(".gif$", $userfile_name) && !ereg(".jpg$", $userfile_name))
{
    $userfile="";
    $userfile_name="";
    echo "Format de photo incorrecte, elle ne sera pas enregistrée !";
}

$host = getHHTPVars('host', $_POST, $_GET);
$nomuser = getHHTPVars("nomuser", $_POST, $_GET);
//echo $userfile." no ".$userfile_name;
$password = getHHTPVars("password", $_POST, $_GET);
$nombase = getHHTPVars("nombase", $_POST, $_GET);

$loginadm = getHHTPVars("loginadm", $_POST, $_GET);
$passadm = getHHTPVars("passadm", $_POST, $_GET);
$loginmemb = getHHTPVars("loginmemb", $_POST, $_GET);
$passmemb = getHHTPVars("passmemb", $_POST, $_GET);

$sexe = getHHTPVars("sexe", $_POST, $_GET);
$nom = getHHTPVars("nom", $_POST, $_GET);
$prenom = getHHTPVars("prenom", $_POST, $_GET);
$adresse = getHHTPVars("adresse", $_POST, $_GET);
$cp = getHHTPVars("cp", $_POST, $_GET);
$ville = getHHTPVars("ville", $_POST, $_GET);
$jnaiss = getHHTPVars("jnaiss", $_POST, $_GET);
$mnaiss = getHHTPVars("mnaiss", $_POST, $_GET);
$anaiss = getHHTPVars("anaiss", $_POST, $_GET);
$mail = getHHTPVars("mail", $_POST, $_GET);
$fone = getHHTPVars("fone", $_POST, $_GET);
$activ = getHHTPVars("activ", $_POST, $_GET);
$autre = getHHTPVars("autre", $_POST, $_GET);
$pass = getHHTPVars("pass", $_POST, $_GET);


//s'il y a photo on l'upload
if ($userfile<>"") {
	if (copy($userfile, "../trombi/images/mini/".$userfile_name)) {
		//echo "ok"; 
	} else {
		//echo "pas ok";
	}
	unlink($userfile);
}

 include("../aqua_haut.htm"); ?>



		
		<font color=red><b>Installation de Tr@mbyn : Conexion & Inscription Administrateur</b></font><br><br><br>
	
		
<?php
	$chaine2 = "<font color=blue><size=2><b>"
		."host : ".$host."<br>"
		."user : ".$nomuser."<br>"
		."MdPass : ".$password."<br>"
		."nom base : ".$nombase."<br>";

		echo "<table width=50%><tr><td>".$chaine2."</td><td><b>";
		echo "<font color=red>Login Admin = ".$loginadm."<br>"
		."MdPass Admin = ".$passadm."<br>"
		."<font color=green>Login Membres = ".$loginmemb."<br>"
		."MdPass Membres = ".$passmemb."<br></b></font></td></tr></table>";
			


				
$naiss=$anaiss."-".$mnaiss."-".$jnaiss;


echo "<hr><table><tr><td ";
if ($sexe=="M") { echo "bgcolor=6DB5FF"; } else { echo "color=FF6DB5"; }
echo "><b>Administrateur</b><br><br>";
		
		$chaine = "Sexe : ".$sexe
		."<br><b>Nom : ".$nom
		."<br>Prenom : ".$prenom
		."</b><br>Adresse : ".$adresse
		."<br>Code Postal : ".$cp
		."<br>Ville : ".$ville
		."<br>Date de naissance : ".$naiss
		."<br>e_Mail : <a href=mailto:".$mail.">".$mail."</a>"
		."<br>téléphone : ".$fone
		."<br>Activité : ".$activ
		."<br>autre : ".$autre
		."<br>photo : ".$userfile_name." ".$infos
		."<i><b><br>m_de_pass : ".$pass."</b></i>";
		
		echo $chaine;

?>
</td></tr></table>


<form action="conex.php" method="post">	

<input type="hidden" value="<?php echo $host; ?>" name="host">
<input type="hidden" value="<?php echo $nomuser; ?>" name="nomuser">
<input type="hidden" value="<?php echo $password; ?>" name="password">
<input type="hidden" value="<?php echo $nombase; ?>" name="nombase">
<input type="hidden" value="<?php echo $loginadm; ?>" name="loginadm">
<input type="hidden" value="<?php echo $passadm; ?>" name="passadm">
<input type="hidden" value="<?php echo $loginmemb; ?>" name="loginmemb">
<input type="hidden" value="<?php echo $passmemb; ?>" name="passmemb">

<input type="hidden" value="<?php echo $couple; ?>" name="couple">

	
<input type="hidden" value="<?php echo $sexe; ?>" name="sexe">
<input type="hidden" value="<?php echo $nom; ?>" name="nom">
<input type="hidden" value="<?php echo $prenom; ?>" name="prenom">
<input type="hidden" value="<?php echo $adresse; ?>" name="adresse">
<input type="hidden" value="<?php echo $cp; ?>" name="cp">
<input type="hidden" value="<?php echo $ville; ?>" name="ville">
<input type="hidden" value="<?php echo $naiss; ?>" name="naiss">
<input type="hidden" value="<?php echo $mail; ?>" name="mail">
<input type="hidden" value="<?php echo $fone; ?>" name="fone">
<input type="hidden" value="<?php echo $activ; ?>" name="activ">
<input type="hidden" value="<?php echo $autre; ?>" name="autre">
<input type="hidden" value="<?php echo $pass; ?>" name="pass">
<input type="hidden" value="<?php echo $userfile_name; ?>" name="photo">



<input type="submit" value="Confirmation">


	
<?php include("../aqua_bas.htm"); ?>

	</body>
</html>