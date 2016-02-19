<html>
	<head>
		<title>Tr@mbyn</title>
		<script language="JavaScript">
<!--
function verif(mail) {
    var arobase = mail.indexOf("@"); var point = mail.lastIndexOf(".")
    if((arobase < 3)||(point + 2 > mail.length)||(point < arobase+3)) 
        return false
        return true
}

function testform(host,nomuser,nombase,loginadm,passadm,loginmemb,passmemb,nom,prenom,jnaiss,mnaiss,anaiss,mail,pass) {
    if(host.value=="") {
        alert("Veuillez saisir votre serveur (ex:sql.free.fr)"); 
        host.focus();
        return false
    }
    if(nomuser.value=="") {
        alert("Veuillez saisir le nom d'utilisateur de votre base de données"); 
        nomuser.focus();
        return false
    }
    if(nombase.value=="") {
        alert("Veuillez saisir nom de votre base de données"); 
        nombase.focus();
        return false
    }
    if(loginadm.value=="") {
        alert("Veuillez saisir votre login administrateur"); 
        loginadm.focus();
        return false
    }
    if(passadm.value=="") {
        alert("Veuillez saisir votre mot de passe administrateur"); 
        passadm.focus();
        return false
    }
    if(loginmemb.value=="") {
        alert("Veuillez saisir le login utilisateur"); 
        loginmemb.focus();
        return false
    }
    if(passmemb.value=="") {
        alert("Veuillez saisir le mot de passe utilisateur"); 
        passmemb.focus();
        return false
    }
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

	</head>
	<body bgcolor="#C0C0C0">
	
<?php	include("../aqua_haut.htm");

?>


<H1><font color=red>Installation de Tr@mbyn V1</font></h1>
<hr>
<font color=red size="2">Vous devez impérativement remplir les données de connection, ce qui permettra d'avoir tous les paramètres de connection à votre base de données MySql.
Les login et mot de passe administrateur sont uniquement pour vous.<br>
Les login et mot de passe des membres sert à la connection à la généalogie (par exemple destiné aux membres de la famille)</font><br>
LA PERSONNE QUE VOUS INSCRIVEZ ICI DOIT ÊTRE L'ASCENDANT LE PLUS HAUT DANS LA GENEALOGIE (votre grand-père ou arrière grand-pére). DANS CETTE VERSION IL N'EST PAS ENCORE POSSIBLE D'INSCRIRE UN ASCENDANT, SEULEMENT UN DESCENDANT OU UN CONJOINT.
<hr>

<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1">
<tr><td>
	<form method="POST" action="confirmationsa.php" onSubmit="return testform(this.host,this.nomuser,this.nombase,this.loginadm,this.passadm,this.loginmemb,this.passmemb,this.nom,this.prenom,this.jnaiss,this.mnaiss,this.anaiss,this.mail,this.pass)" enctype="multipart/form-data">
			Host<br>
				<input type"txt" name="host" value=""><br>
			Utilisateur<br>
				<input type"txt" name="nomuser" value=""><br>
			Mot de passe<br>
				<input type"txt" name="password" value=""><br>
			Nom de votre base de données<br>
				<input type"txt" name="nombase" value=""><br>
				
</td><td>		
			Login adinistrateur<br>
				<input type"txt" name="loginadm" value=""><br>
			Mot de passe administrateur<br>
				<input type"txt" name="passadm" value=""><br>
			<br>
			Login membre<br>
				<input type"txt" name="loginmemb" value=""><br>
			Mot de passe membre<br>
				<input type"txt" name="passmemb" value=""><br>
				
</td>
</tr>	
<tr><td colspan=2><br><hr><br></td></tr>

    <td><font color="red">*</font>Sexe</td>
    <td>M<input type="radio" name="sexe" value="M" checked>/ F<input type="radio" name="sexe" value="F"></td>

  
  </tr>
  <tr>
    <td bgcolor="#CDCDCD"><font color="red">*</font>Nom</td>
    <td bgcolor="#CDCDCD"><input type="text" value="" name="nom"></td>
  </tr>
  <tr>
    <td><font color="red">*</font>Prenom</td>
    <td><input type="text" value="" name="prenom"></td>
  </tr>
  <tr>
    <td bgcolor="#CDCDCD">Adresse</td>
    <td bgcolor="#CDCDCD"><input type="text" value="" name="adresse"></td>
  </tr>
  <tr>
    <td>Code Postal</td>
    <td><input type="text" value="" name="cp"></td>
  </tr>
  <tr>
    <td bgcolor="#CDCDCD">Ville</td>
    <td bgcolor="#CDCDCD"><input type="text" value="" name="ville"></td>
  </tr>
  <tr>
    <td><font color="red">*</font>Date de Naissance</td>
    <td>J<input type="text" value="" name="jnaiss" size=2 maxlength=2>M<input type="text" value="" name="mnaiss" size=2 maxlength=2>A<input type="text" value="" name="anaiss" size=4 maxlength=4></td>
  </tr>
  <tr>
    <td bgcolor="#CDCDCD"><font color="red">*</font>Email</td>
    <td bgcolor="#CDCDCD"><input type="text" value="" name="mail"></td>
  </tr>
  <tr>
    <td>Téléphone</td>
    <td><input type="text" value="" name="fone"></td>
  </tr>
  <tr>
    <td bgcolor="#CDCDCD">Activité</td>
    <td bgcolor="#CDCDCD"><input type="text" value="" name="activ"></td>
  </tr>
  <tr>
    <td>Autre</td>
    <td><input type="text" value="" name="autre"></td>
  </tr>
  <tr>
    <td bgcolor="#CDCDCD"><font color="red">*</font>Mot de passe</td>
    <td bgcolor="#CDCDCD"><input type="text" value="" name="pass"></td>
  </tr>
  <tr>
    <td valign="top">
    
<input type=hidden name="max_file_size" value="1024000">
	Photo <input type="file" name="userfile"><br>
<font color=red size=1><b><i>PS : le nom de l'image ne doit pas comporter d'espaces<br>ni de caractères spéciaux et doit peser moins de 256Ko</i></font>
</td>
    <td valign="top"></td>
  </tr>  <tr>
    <td valign="top"></td>
    <td valign="top"></td>
  </tr>
</table>

			<input type="submit" value="Modifier la connexion" name="creanew"></p>
	</form>
	
	
	
<?php	include("../aqua_bas.htm"); ?>