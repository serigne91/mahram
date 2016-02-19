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

	$ModifPrenom= getHTTPVars("ModifPrenom", $_POST, $_GET);
	$ModifNom= getHTTPVars("ModifNom", $_POST, $_GET);
	$ModifAdresse= getHTTPVars("ModifAdresse", $_POST, $_GET);
	$ModifCP= getHTTPVars("ModifCP", $_POST, $_GET);
	$ModifVille= getHTTPVars("ModifVille", $_POST, $_GET);
	$ModifFone= getHTTPVars("ModifFone", $_POST, $_GET);
	$ModifNaiss= getHTTPVars("ModifNaiss", $_POST, $_GET);
	$ModifMail= getHTTPVars("ModifMail", $_POST, $_GET);
	$ModifAutre= getHTTPVars("ModifAutre", $_POST, $_GET);
	$ModifActiv= getHTTPVars("ModifActiv", $_POST, $_GET);
	$ModifPass= getHTTPVars("ModifPass", $_POST, $_GET);
	$DetailId= getHTTPVars("DetailId", $_POST, $_GET);

	
	$userfile = $_FILES['userfile']['tmp_name'];
$userfile_name = $_FILES['userfile']['name'];
$userfile_name = str_replace(" ","_",$userfile_name);


	//on vérifie que la photo comporte bien une extension jpg ou gif
	if(!ereg(".jpg$", $userfile_name) && !ereg(".gif$", $userfile_name))
	{
	    $userfile="";
	    $userfile_name="";
	    echo "<font color=green><b><i>Format de photo incorrecte, elle ne sera pas enregistrée !</i></b></font><br>";
	}

	//s'il y a photo on l'upload
	if ($userfile<>"") {		
		if (copy($userfile, "../trombi/images/mini/".$userfile_name)) {
			//echo "ok"; 
		} else {
			//echo "pas ok";
		}
	unlink($userfile);
	}
	
include ("../conex.inc");



	$query = "UPDATE coordonnees SET prenom='$ModifPrenom', nom='$ModifNom', adresse='$ModifAdresse',";
	$query=$query." cp='$ModifCP', fone='$ModifFone', ville='$ModifVille', naiss='$ModifNaiss', mail='$ModifMail',";
	$query=$query." autre='$ModifAutre', activ='$ModifActiv', pass='$ModifPass' ";
	if ($userfile_name<>"") {
		$query=$query.",photo='$userfile_name' ";
	}	
	$query=$query."WHERE id_key = '$DetailId'";
$result = mysql_query($query);


//header ('location:indexmf.php?trombibox=non&coordosbox=oui&inscripts=&listbox=');
?>

Vous pouvez maintenant fermer cette fenêtre<br><br>
<a href="javascript:window.close();">Fermer</a>