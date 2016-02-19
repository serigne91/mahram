<script language="JavaScript">
<!--
function verif(mail) {
    var arobase = mail.indexOf("@"); var point = mail.lastIndexOf(".")
    if((arobase < 3)||(point + 2 > mail.length)||(point < arobase+3)) 
        return false
        return true
}

function testform(nom,prenom,jnaiss,mnaiss,anaiss,mail,pass) {
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
    if(jnaiss.value=="") {
        alert("Veuillez saisir votre jour de naissance"); 
        jnaiss.focus();
        return false
    }
    if(mnaiss.value=="") {
        alert("Veuillez saisir votre mois de naissance"); 
        mnaiss.focus();
        return false
    }
    if(anaiss.value=="") {
        alert("Veuillez saisir votre année de naissance"); 
        anaiss.focus();
        return false
    }
    if(!verif(mail.value)) { 
        alert("Adresse email incorrecte"); 
	    mail.focus();
        return false 
    }
    if(pass.value=="") {
        alert("Veuillez saisir un mot de passe"); 
        pass.focus();
        return false
    }
    return true
}
//-->
</script>


<body bgcolor="#C0C0C0">
<b><font color=red>Inscription --- étape 3/4</font></b></a><br><br>

<?php
$Id = $_COOKIE['Id'];

if ($Id=='OKDAK') {

include ("../../aqua_haut.htm"); 
include ("../../conex.inc");
include ("fonctions.inc");

$id_key_femme = getHTTPVars('id_key_femme', $_POST, $_GET);
$id_key_homme = getHTTPVars('id_key_homme', $_POST, $_GET);
$sex_refinscript = getHTTPVars('sex_refinscript', $_POST, $_GET);
$id_key_refinscript = getHTTPVars('id_key_refinscript', $_POST, $_GET);
$login= getHTTPVars("login", $_POST, $_GET);

?>


<form method="post" action="popup04.php" onSubmit="return testform(this.nom,this.prenom,this.jnaiss,this.mnaiss,this.anaiss,this.mail,this.pass)" enctype="multipart/form-data"> 
<?php


//echo "id_key_refinscript : ".$id_key_refinscript;
//echo "<br>sex_refinscript : ".$sex_refinscript;
//echo "<br>id_key_femme : ".$id_key_femme;
//echo "<br>id_key_homme : ".$id_key_homme;

	if ($sex_refinscript=="F") {
		$id_key_mere=$id_key_refinscript;
		$id_key_pere=$id_key_homme;
	}else {
		$id_key_pere=$id_key_refinscript;
		$id_key_mere=$id_key_femme;
	}

//echo "<br>id_key_mere : ".$id_key_mere;
//echo "<br>id_key_pere : ".$id_key_pere;

	
	echo "<b><font color=red>Vous êtes le fils/la fille de ";
	CoorRef($login,$conexion,$id_key_refinscript);
	if ($id_key_femme=="" and $id_key_homme=="") {
		
	}else if ($id_key_femme<>"") {
		CoorRef($login,$conexion,$id_key_femme);
		echo " et <input type=hidden name=id_key_refConjoint value=".$id_key_femme.">";
		
	}else if ($id_key_homme<>"") {
		CoorRef($login,$conexion,$id_key_homme);
		echo " et <input type=hidden name=id_key_refConjoint value=".$id_key_homme.">";

	}
	echo "</font><br>";

		

		



?>
    <input type="radio" checked name="sexe" value="F"> Femme &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="radio" value="M"  name="sexe"> Homme

			    
<?php

FormulaireInscript($login,$conexion);


?>

<input type=hidden name="max_file_size" value="1024000">
	<br>
	Photo <input type=file name="userfile"><br><br>

	
<font color=purple size=2><b><i>PS : le nom de l'image ne doit pas comporter d'espaces<br>ni de caractères spéciaux et doit peser moins d'1Mo</i></font>

		<input type="hidden" name="id_key_mere" value="<?php echo $id_key_mere; ?>">
		<input type="hidden" name="id_key_pere" value="<?php echo $id_key_pere; ?>">
		
		<input type="hidden" name="login" value="<?php echo $login; ?>">
		<a href="javascript:history.back()" border="0"><img src="../images/etapeprec.gif" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;					
					
		<input type="image" src="../images/etapesuiv.gif" border=0 alt="incription" value="Enregistrer name="creanew">
	</form>

	<?php 
include ("../../aqua_bas.htm"); 
}
?>