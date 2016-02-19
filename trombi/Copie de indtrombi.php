<?php

	include("../aqua_haut.htm");
	include ("../conex.inc");
	
//récupérations des variables
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

$prenomdupere = getHTTPVars("prenomdupere", $_POST, $_GET);
$prenomdumere = getHTTPVars("prenomdumere", $_POST, $_GET);
$photodupere = getHTTPVars("photodupere", $_POST, $_GET);
$photodumere = getHTTPVars("photodumere", $_POST, $_GET);
$keydupere = getHTTPVars("keydupere", $_POST, $_GET);
$keydumere = getHTTPVars("keydumere", $_POST, $_GET);

	
//choix du référant pour l'affichage --> par défaut l'administrateur
//if ($reftrombi=="" and $refcook=="") {
//	$reftrombi=4;
//} else {
//	$reftrombi=$refcook;
//}

if ($reftrombi=="") {
	$reftrombi=4;
} else {
	$reftrombi = $_GET["reftrombi"];
}

//récupération des données du reférant pour l'affichage de la généalogie
$Sqllist="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key AND ident.id_key = $reftrombi";
//echo $Sqllist;
$Resultlist = mysql_query($Sqllist,$conexion);
mysql_query($Resultlist);
	while($ValVerif=mysql_fetch_array($Resultlist)){
		if ($ValVerif["virtuel"]<>'O') {
			$keysa = $ValVerif["id_key"];
			$prenomsa = $ValVerif["prenom"];
			$nomsa = $ValVerif["nom"];
			$keyperesa = $ValVerif["id_key_pere"];
			$keymeresa = $ValVerif["id_key_mere"];
			$keyepouxsa = $ValVerif["id_key_epoux"];
			$genesa = $ValVerif["generation"];
			$sexesa = $ValVerif["sexe"];
			//écriture des requêtes de récupération des enfants & des frères&soeurs du référent
			if ($sexesa=="M" AND $keyperesa<>"") {
				$Sqllistenfant="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key"
				." AND ident.id_key_pere = $reftrombi ORDER BY naiss";
				$Sqllistfrso="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key"
				." AND ident.id_key_pere = '$keyperesa' ORDER BY naiss";				
			} else if ($sexesa=="F" AND $keymeresa<>"") {				
				$Sqllistenfant="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key"
				." AND ident.id_key_mere = $reftrombi ORDER BY naiss";
				$Sqllistfrso="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key"
				." AND ident.id_key_mere = '$keymeresa' ORDER BY naiss";					
			}	else if ($sexesa=="F") {
				$Sqllistfrso=$Sqllist;
				$Sqllistenfant="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key"
				." AND ident.id_key_mere = '$reftrombi' ORDER BY naiss";
			}	else if ($sexesa=="M") {
				$Sqllistfrso=$Sqllist;
				$Sqllistenfant="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key"
				." AND ident.id_key_pere = '$reftrombi' ORDER BY naiss";
			}
		}
	}
// récupération des données du pére du référent
if ($keyperesa<>"") {	
$Sqllistpere="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key"
	." AND ident.id_key = $keyperesa";
$Resultlistpere = mysql_query($Sqllistpere,$conexion);
mysql_query($Resultlistpere);
	while($ValVerifpere=mysql_fetch_array($Resultlistpere)){
		if ($ValVerifpere["virtuel"]<>'O') {
			$keydupere = $ValVerifpere["id_key"];
			$prenomdupere = $ValVerifpere["prenom"];
			$nomdupere = $ValVerifpere["nom"];
			$keyperedupere = $ValVerifpere["id_key_pere"];
			$keymeredupere = $ValVerifpere["id_key_mere"];
			$keyepouxdupere = $ValVerifpere["id_key_epoux"];
			$genedupere = $ValVerifpere["generation"];
			$photodupere = $ValVerifpere["photo"];
		}
	}
}
// récupération des données de la mère du référent
if ($keymeresa<>"") {	
$Sqllistmere="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key"
	." AND ident.id_key = $keymeresa";
$Resultlistmere = mysql_query($Sqllistmere,$conexion);
mysql_query($Resultlistmere);
	while($ValVerifmere=mysql_fetch_array($Resultlistmere)){
		if ($ValVerifmere["virtuel"]<>'O') {
			$keydumere = $ValVerifmere["id_key"];
			$prenomdumere = $ValVerifmere["prenom"];
			$nomdumere = $ValVerifmere["nom"];
			$keyperedumere = $ValVerifmere["id_key_pere"];
			$keymeredumere = $ValVerifmere["id_key_mere"];
			$keyepouxdumere = $ValVerifmere["id_key_epoux"];
			$genedumere = $ValVerifmere["generation"];
			$photodumere = $ValVerifmere["photo"];
		}
	}
}	
	

// récupération des données des enfants et des conjoints
if ($Sqllistenfant<>"") {
$Resultlistenfant = mysql_query($Sqllistenfant,$conexion);
mysql_query($Resultlistenfant);
$countenf=0;
//$contagefs=0;
	while($ValVerifefn=mysql_fetch_array($Resultlistenfant)){
		if ($ValVerifefn["virtuel"]<>'O') {
			$key[] = $ValVerifefn["id_key"];
			$prenom[] = $ValVerifefn["prenom"];
			$nom[] = $ValVerifefn["nom"];
			$keypere[] = $ValVerifefn["id_key_pere"];
			$keymere[] = $ValVerifefn["id_key_mere"];
			$keyepoux[] = $ValVerifefn["id_key_epoux"];
			$gene[] = $ValVerifefn["generation"];
			if ($ValVerifefn["photo"]<>'') {
				$photo[] = $ValVerifefn["photo"];
			} else {
				$photo[]="vide.jpg";
			}
			
				$SqllistefnC="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key"." AND ident.id_key = '$ValVerifefn[id_key_epoux]' ORDER BY naiss";
				$ResultlistefnC = mysql_query($SqllistefnC,$conexion);
				mysql_query($ResultlistefnC);
					$ValVerifefnC=mysql_fetch_array($ResultlistefnC);
							$keyC[] = $ValVerifefnC["id_key"];
							$prenomC[] = $ValVerifefnC["prenom"];
							$nomC[] = $ValVerifefnC["nom"];
							$keypereC[] = $ValVerifefnC["id_key_pere"];
							$keymereC[] = $ValVerifefnC["id_key_mere"];
							$keyepouxC[] = $ValVerifefnC["id_key_epoux"];
							$geneC[] = $ValVerifefnC["generation"];
							if ($ValVerifefnC["photo"]<>'') {
								$photoC[] = $ValVerifefnC["photo"];
							} else {
								$photoC[]="vide.jpg";
							}
							
							
			$countenf = $countenf+1;
		}
	}
}

// récupération des données des frères&soeurs et conjoints
$Resultlistfreso = mysql_query($Sqllistfrso,$conexion);
mysql_query($Resultlistfreso);
$countfs=0;
	while($ValVeriffs=mysql_fetch_array($Resultlistfreso)){
		if ($ValVeriffs["virtuel"]<>'O') {
			$keyfs[] = $ValVeriffs["id_key"];
			$prenomfs[] = $ValVeriffs["prenom"];
			$nomfs[] = $ValVeriffs["nom"];
			$keyperefs[] = $ValVeriffs["id_key_pere"];
			$keymerefs[] = $ValVeriffs["id_key_mere"];
			$keyepouxfs[] = $ValVeriffs["id_key_epoux"];
			$genefs[] = $ValVeriffs["generation"];
			if ($ValVeriffs["photo"]<>'') {
				$photofs[] = $ValVeriffs["photo"];
			} else {
				$photofs[]="vide.jpg";
			}
			
			
				$SqllistfrsoC="SELECT * FROM coordonnees AS coor, identifiant AS ident WHERE coor.id_key = ident.id_key"." AND ident.id_key = '$ValVeriffs[id_key_epoux]' ORDER BY naiss";
				$ResultlistfresoC = mysql_query($SqllistfrsoC,$conexion);
				mysql_query($ResultlistfresoC);
					$ValVeriffsC=mysql_fetch_array($ResultlistfresoC);
							$keyfsC[] = $ValVeriffsC["id_key"];
							$prenomfsC[] = $ValVeriffsC["prenom"];
							$nomfsC[] = $ValVeriffsC["nom"];
							$keyperefsC[] = $ValVeriffsC["id_key_pere"];
							$keymerefsC[] = $ValVeriffsC["id_key_mere"];
							$keyepouxfsC[] = $ValVeriffsC["id_key_epoux"];
							$genefsC[] = $ValVeriffsC["generation"];
							if ($ValVeriffsC["photo"]<>'') {
								$photofsC[] = $ValVeriffsC["photo"];
							} else {
								$photofsC[]="vide.jpg";
							}					
			$countfs = $countfs+1;				
		}
	}

?>

<!--Tous les données sont récupérées, on dessine la généalogie-->
<table border=0 align=center cellpadding=0 cellspacing=0 width=100%><tr><td>
<table border=0 align=center cellpadding=0 cellspacing=0>
<?php
if ($prenomdupere=="") {
	$prenomdupere = "Non_enregistré";
}
if ($prenomdumere=="") {
	$prenomdumere = "Non_enregistré";
}
if (trim($photodupere)=="") {
	$photodupere = "vide.jpg";
}
if (trim($photodumere)=="") {
	$photodumere = "vide.jpg";
}
	
	echo "<tr><td align=center colspan=".$countenf.">"
			."<a href=indexmf.php?trombibox=oui&coordosbox=&listbox=&reftrombi=".$keydupere.">"
			."<img src=../trombi/images/mini/".$photodupere." width=38 height=54 alt=".$prenomdupere."></a>"
			."<a href=indexmf.php?trombibox=oui&coordosbox=&listbox=&reftrombi=".$keydumere.">"
			."<img src=../trombi/images/mini/".$photodumere." width=38 height=54 alt=".$prenomdumere."></a>"
			."<br><img src=../trombi/images/trident.gif>"
		."</td></tr></table>";
		
	echo "<table cellpadding=0 cellspacing=0 border=0 align=center>"."<tr>";
	
	//echo $countfs;
	$fs=0;
	$contagetab=0;
while($fs<$countfs) {
		$contagetab=$contagetab+1;
		echo "<td align=center valign=top>";
		//echo $contagetab;
		if ($countfs==1) {			 						echo "<img src=../trombi/images/traitenfsimp.gif>";
		 } elseif ($keyepouxfs[$fs]=='' and $fs==0) {			echo "<img src=../trombi/images/coing.gif>";
		 } elseif ($keyepouxfs[$fs]<>'' and $fs==($countfs-1)) { echo "<img src=../trombi/images/coindc.gif>";
 		 } elseif ($keyepouxfs[$fs]=='' and $fs==($countfs-1)) { echo "<img src=../trombi/images/coind.gif>";
		 } elseif ($keyepouxfs[$fs]<>'' and $fs==0) { 			echo "<img src=../trombi/images/coingc.gif>";
		 } elseif ($keyepouxfs[$fs]<>'') {			 			echo "<img src=../trombi/images/trih.gif>";
	 	 } else { echo "<img src=../trombi/images/trihs.gif>";
		 }
		echo "<br><a href=indexmf.php?trombibox=oui&coordosbox=&listbox=&reftrombi=".$keyfs[$fs]."><img src=../trombi/images/mini/".$photofs[$fs]." width=38 height=54 alt=".$prenomfs[$fs]."></a>";
		
		if ($keyfs[$fs]==$reftrombi) { $cntref=$contagetab; }
		
		if ($keyepouxfs[$fs]<>"") {
			$contagetab=$contagetab+1;
			//echo $contagetab;
			echo "<a href=indexmf.php?trombibox=oui&coordosbox=&listbox=&reftrombi=".$keyfsC[$fs]."><img src=../trombi/images/mini/".$photofsC[$fs]." width=38 height=54 alt=".$prenomfsC[$fs]."></a>";
		}
		if ($keyfs[$fs]==$reftrombi and $keyepouxfs[$fs]<>'') {	echo "<br><img src=../trombi/images/trident.gif>"; $encoup="yes";}
		
		$fs=$fs+1;
	}
	

	$countage=$contagetab;
	$contagetab=$contagetab*47;
	$percent1=$cntref-1;
	if ($encoup="yes") { $percent2=$countage-$cntref-1; } else { $percent2=$countage-$cntref; }
	if ($countage<>0) {
	$percent1=($percent1*100)/$countage."%";
	$percent2=($percent2*100)/$countage."%";
	}
	//echo $cntref."--".$contagetab."--".$countage."--".$percent1."--".$percent2 ;

echo "</table>";
echo "<table border=0 align=center cellpadding=0 cellspacing=0  width=$contagetab>";

	echo "<tr><td width=".$percent1."></td>";
	$enf=0;
	while($enf<$countenf) {
		echo "<td align=center valign=top>";
		
//echo $lacase;
//echo $countfs;
		if ($countenf==1) {			 						echo "<img src=../trombi/images/traitenfsimp.gif>";
		} elseif ($keyepoux[$enf]=="" and $enf==0) { 		echo "<img src=../trombi/images/coing.gif>";
		} elseif ($keyepoux[$enf]<>"" and $enf==0) { 		echo "<img src=../trombi/images/coingc.gif>";
		} elseif ($keyepoux[$enf]=="" and $enf==($countenf-1)) { echo "<img src=../trombi/images/coind.gif>";
		} elseif ($keyepoux[$enf]<>"" and $enf==($countenf-1)) { echo "<img src=../trombi/images/coindc.gif>";
		} elseif ($keyepoux[$enf]<>'') {			 			echo "<img src=../trombi/images/trih.gif>";
		} else { echo "<img src=../trombi/images/trihs.gif>"; }
		

		
		echo "<br><a href=indexmf.php?trombibox=oui&coordosbox=&listbox=&reftrombi=".$key[$enf]."><img src=../trombi/images/mini/".$photo[$enf]." width=38 height=54 alt=".$prenom[$enf]."></a>";
		if ($keyepoux[$enf]<>"") {
			//echo $prenomC[$enf].$nomC[$enf];
			echo "<a href=indexmf.php?trombibox=oui&coordosbox=&listbox=&reftrombi=".$keyC[$enf]."><img src=../trombi/images/mini/".$photoC[$enf]." width=38 height=54 alt=".$prenomC[$enf]."></a>";
		}
		echo "</td>";
		$enf=$enf+1;
	}

	echo "<td width=".$percent2."></td>";
	


?>
	</tr></table></td><td width=50></td><td bgcolor=#dddddd align=right>
<?php	
	//echo $reftrombi;
	$Sqllist="SELECT * FROM coordonnees WHERE id_key=$reftrombi";
	//echo $Sqllist;
	$Resultlist = mysql_query($Sqllist, $conexion);
	//mysql_query($Resultlist);
					
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
		//.$Vallist["pass"]."<br>"
		.$Vallist["activ"]."<br>"
		.$Vallist["autre"]."<br><img src=../trombi/images/mini/"
		.$Vallist["photo"].">";
	}
	?>
	<form name="FormName"><font color=red size=2>Tapez votre mot de passe pour modifier votre profil</font><br>

		<input type="hidden" value="<?php echo $reftrombi; ?>" name="ModifId">
		<input type="password" name="ModifPass" size="10" style="background:#CCCCFF">
		<input type="submit" name="submitButtonName" value="Modifier" onClick="window.open('modif_fiche.php?ModifId=<?php echo $reftrombi; ?>&ModifPass='+FormName.ModifPass.value,'','location=0,status=0, width=640, height=550, scrollbars=1')" name="B1">
	</form>
	</td></tr></table>
	
<?php

include("../aqua_bas.htm"); ?>


