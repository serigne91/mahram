<script language="JavaScript">
<!--


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
    if(pass.value=="") {
        alert("Veuillez saisir un mot de passe"); 
        pass.focus();
        return false
    }
    return true
}


function testform2(sexe,conjoint) {
     if(sexe[0].checked == false) {
        alert("Si vous n'êtes pas son parent, retournez à l'étape précédente"); 
        return false
    }
     if(conjoint[0].checked == false && conjoint[1].checked == false) {
        alert("Est-votre conjoint ?"); 
        return false
    }
    return true
}
//-->


</script>


<?php
$Id = $_COOKIE['Id'];

if ($Id=='OKDAK') {

include ("../../conex.inc");
include ("fonctions.inc");

$id_key_refinscriptf = getHTTPVars('id_key_refinscriptf', $_POST, $_GET);
$id_key_refinscriptc = getHTTPVars('id_key_refinscriptc', $_POST, $_GET);
$id_key_refinscriptp = getHTTPVars('id_key_refinscriptp', $_POST, $_GET);
$RefInscript = getHTTPVars('RefInscript', $_POST, $_GET);
$login= getHTTPVars("login", $_POST, $_GET);


	if ($id_key_refinscriptf=="" and $RefInscript=="fils") {
		?><script>self.history.back();</script><?php
	} else if ($id_key_refinscriptc=="" and $RefInscript=="conjoint") {
		?><script>self.history.back();</script><?php
	} else if ($id_key_refinscriptp=="" and $RefInscript=="parent") {
		?><script>self.history.back();</script><?php
	}
?>	
	<body bgcolor="#C0C0C0">
<b><font color=red>Inscription --- étape 2/4</font></b></a><br><br>

<?php
include ("../../aqua_haut.htm"); 



if ($RefInscript=="fils") {
	$id_key_refinscript=$id_key_refinscriptf;
	echo "<form method=POST action=popup03.php>";

} else if ($RefInscript=="conjoint") {
	$id_key_refinscript=$id_key_refinscriptc;
	echo "<form method=POST action=popup03conj.php onSubmit=\"return testform(this.nom,this.prenom,this.jnaiss,this.mnaiss,this.anaiss,this.mail,this.pass)\" enctype=multipart/form-data>";
} else {
	$id_key_refinscript=$id_key_refinscriptp;
	echo "<form method=POST action=popup03par.php onSubmit=\"return testform2(this.sexe,this.conjoint)\">";
}



SexRef($login,$conexion,$id_key_refinscript);


if($RefInscript=="fils") {
	echo "<b><font color=red>Vous êtes le fils/la fille de ";
	CoorRef($login,$conexion,$id_key_refinscript);
	echo "</font><br>";
	
	if ($sex_refinscript=="M") {
		echo "<br><br>Votre mère est-elle dans la liste ?";
		ListFemmeInscrits($login,$conexion);
	} else {
		echo "<br><br>Votre père est-il dans la liste ?";
		ListHommeInscrits($login,$conexion);
	}
} elseif ($RefInscript=="conjoint"){
	echo "<b><font color=red>Vous êtes le/la conjoint de ";
	CoorRef($login,$conexion,$id_key_refinscript);
	echo "</font><br>";

	FormulaireInscript($login,$conexion);
?>
<input type=hidden name="max_file_size" value="1024000">
	<br>
	Photo <input type=file name="userfile"><br><br>
<?php	
} else {
		
				//on regarde s'il y a deja un pere ou/et une mere
				mysql_select_db($login,$conexion);
				$Sqllist="SELECT * FROM identifiant where id_key=$id_key_refinscript";
				$Resultlist = mysql_query($Sqllist,$conexion);
				mysql_query($Resultlist);
				while($Vallist=mysql_fetch_array($Resultlist)){
					$id_key_pere = $Vallist["id_key_pere"];
					$id_key_mere = $Vallist["id_key_mere"];
				}
				
				//vérification si parents virtuels alors on vide $id_key_pere et $id_key_mere
				if ($id_key_pere<>"") {
					mysql_select_db($login,$conexion);
					$Sqllist="SELECT * FROM identifiant where id_key=$id_key_pere";
					$Resultlist = mysql_query($Sqllist,$conexion);
					mysql_query($Resultlist);
					while($Vallist=mysql_fetch_array($Resultlist)){
						if ($Vallist["virtuel"]=="O"){
							$id_key_pere="";
						}
					}
				}
				if ($id_key_mere<>"") {
					mysql_select_db($login,$conexion);
					$Sqllist="SELECT * FROM identifiant where id_key=$id_key_mere";
					$Resultlist = mysql_query($Sqllist,$conexion);
					mysql_query($Resultlist);
					while($Vallist=mysql_fetch_array($Resultlist)){
						if ($Vallist["virtuel"]=="O"){
							$id_key_mere="";
						}
					}
				}
				
				//si vide ou virtuel ==> on passe au formulaire d'inscription
				if ($id_key_pere=="" and $id_key_mere=="") {
					?><script>window.location='popup04par.php?id_key_refinscript=<?php echo $id_key_refinscript; ?>';</script><?php
				}
				//si pere ou mere existe on affiche leurs nom/premon
			
				if ($id_key_pere<>"") {
					echo "<b><font color=red>Un père est déjà inscript pour ";
					CoorRef($login,$conexion,$id_key_refinscript);
					echo "</font></b><br>";
					$pere="oui";
					mysql_select_db($login,$conexion);
					$Sqllist="SELECT * FROM coordonnees where id_key=$id_key_pere";
					$Resultlist = mysql_query($Sqllist,$conexion);
					mysql_query($Resultlist);
					while($Vallist=mysql_fetch_array($Resultlist)){
						echo "<font color=green><i>".$Vallist["prenom"]." ".$Vallist["nom"]."<br>";
						$id_key_conjointp=$Vallist["id_key"];
					}
				}
				if ($id_key_mere<>"") {
					echo "</i><b><font color=red>Une mère est déjà inscripte pour ";
					CoorRef($login,$conexion,$id_key_refinscript);
					echo "</font></b><br><i>";
					$mere="oui";
					mysql_select_db($login,$conexion);
					$Sqllist="SELECT * FROM coordonnees where id_key=$id_key_mere";
					$Resultlist = mysql_query($Sqllist,$conexion);
					mysql_query($Resultlist);
					while($Vallist=mysql_fetch_array($Resultlist)){
						echo "<font color=green><i>".$Vallist["prenom"]." ".$Vallist["nom"];
						$id_key_conjointm=$Vallist["id_key"];

					}
				}
				if ($pere=="oui" and $mere=="oui") {
					?> <br><br><font color=red>parents déjà inscripts... vous pouvez modifier vos données avec votre mot de passe en naviguant dans l'arbre généalogique.<br>Vous pouvez fermer cette fenêtre !
					<?php
						$etape="fini";
				} else if ($mere=="oui") {
					?></i><br>Etes-vous son père ? <input type=radio name=sexe value=M>Oui <input type=radio name=sexe>Non<br>
					Etes-vous le conjoint/mari de la mère inscripte ?<br><input type=radio name=conjoint value=<?php echo $id_key_conjointm ?>>Oui <input type=radio name=conjoint>Non<br><br><?php
				} else {
					?></i><br>Etes-vous sa mère ?  <input type=radio name=sexe value=F>Oui <input type=radio name=sexe>Non<br>
					Etes-vous la conjointe/femme du père inscript ?<br><input type=radio name=conjoint value=<?php echo $id_key_conjointp ?>>Oui <input type=radio name=conjoint>Non<br><br><?php

				}
					
}

if ($etape<>"fini") {
?>

	
		<input type="hidden" name="sex_refinscript" value="<?php echo $sex_refinscript; ?>">
		<input type="hidden" name="id_key_refinscript" value="<?php echo $id_key_refinscript; ?>">
		<a href="javascript:history.back()" border="0"><img src="../images/etapeprec.gif" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;					
		<input type="image" src="../images/etapesuiv.gif" border="0" alt="incription" value="Enregistrer" name="creanew">
	</form>
<?php 
}
include ("../../aqua_bas.htm"); 
}
?>