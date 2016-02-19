<script language="JavaScript">
<!--
function verif(mail) {
    var arobase = mail.indexOf("@"); var point = mail.lastIndexOf(".")
    if((arobase < 3)||(point + 2 > mail.length)||(point < arobase+3)) 
        return false
        return true
}

function testform(nom,prenom,mail) {
    if(nom.value=="") {
        alert("Veuillez saisir votre nom"); 
        nom.focus();
        return false
    }
    if(prenom.value=="") {
        alert("Veuillez saisir votre prénom"); 
        prenom.focus();
        return false
    }

    if(!verif(mail.value)) { 
        alert("Adresse email incorrecte"); 
	    mail.focus();
        return false 
    }
    return true
}
//-->
</script>

<?php
	require ("fonctions.inc");

$mail = getHTTPVars("mail", $_POST, $_GET);
$err = getHTTPVars("err", $_POST, $_GET);
$prenom = getHTTPVars("prenom", $_POST, $_GET);
$nom = getHTTPVars("nom", $_POST, $_GET);

include ("../aqua_haut.htm"); 




if ($mail<>'') {
	include ("../conex.inc");

	$Sqllist="SELECT * FROM coordonnees WHERE prenom='$prenom' and nom='$nom' and mail='$mail'";
	$Resultlist = mysql_query($Sqllist, $conexion);
					
	while($Vallist=mysql_fetch_array($Resultlist)){
		echo "<b><font color=red>"
		.$Vallist["prenom"]." "
		.$Vallist["nom"]."</font></b><br>"
		.$Vallist["adresse"]."<br>"
		.$Vallist["cp"]."<br>"
		.$Vallist["ville"]."<br>"
		.$Vallist["fone"]."<br>"
		.$Vallist["naiss"]."<br>"
		."<a href=mailto:".$Vallist["mail"].">".$Vallist["mail"]."</a><br>"
		.$Vallist["activ"]."<br>"
		.$Vallist["autre"]."<br><img src=../trombi/images/mini/"
		.$Vallist["photo"]."><br>"
		//.$Vallist["pass"]
		." ";
	$lemail=$Vallist["mail"];
	$lepass=$Vallist["pass"];
	}
		
	if ($lemail<>"") {		
		$lemail;
		$subject='Votre mot de passe';
		$body='Votre mot de passe est \n<b>'.$lepass.'\n</b>. Ne le donnez à personne !';
		$expediteur="ozitoun@free.fr";

		echo "Email envoyé à : $lemail<br>";
	mail($lemail, $subject, $body,'Reply-To: ozitoun@free.fr');
	} else {
		echo "<font color=red>Identification incorrecte</font>";
		$mail="";
		?><br><br><br><a href=javascript:history.back()>retour</a><?php
	}

} else {
?>




<form method="POST" action="password.php" onSubmit="return testform(this.nom,this.prenom,this.mail)">
	<font size="2" color="red"><b>

		<?php if ($err == "inc") {
			echo "<div align = right>Login ou mot de passe incorrect</div>";
		} ?>
		
		Prénom<br>
		<input type="text" size="10" value="" name="prenom"><br>
		Nom<br>
		<input type="text" size="10" value="" name="nom"><br>
		Mail<br>
		<input type="text" size="10" value="" name="mail"><br>
		<input type="submit" value="Envoyer par mail" name="entrer"></p>
</form>


<?php

}

include ("../aqua_bas.htm"); 

?>
<a href=javascript:window.close();>Fermer</a>