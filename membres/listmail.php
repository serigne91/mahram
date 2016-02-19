<?php
$Id = $_COOKIE['Id'];
	
if ($Id=='OKDAK') {

include ("../aqua_haut.htm");
?>
<table width=100% border=0>
<tr><td align=left>

<table align='left'>
	<tr>
		<td bgcolor="#A5BAFE" width="150"><font face="Trebuchet MS, Comic Sans MS" size=2 color="ffffff"><b>Nom</b></font></td>
		<td bgcolor="#A5BAFE" width="250"><font face="Trebuchet MS, Comic Sans MS" size=2 color="ffffff"><b>Mail</b></font></td>
	</tr>

<?php //retour Edito et Lien Mail à toute la Famille
$listeCci='';




// tant qu'il y a des fiches
$query = "SELECT * FROM coordonnees ORDER BY nom"; 
$result = mysql_query($query);
	while ($val = mysql_fetch_array($result)) { 
		if ($val["mail"]<>"") {
			$listeCci=$listeCci.$val["mail"].";"; 
		}
	}
	
	?>
	<tr>
		<td colspan="2" align=right><a href=mailto:zitounquat@hotmail.com?Subject=ListeMail%20Trombyn&cc=<?php echo $listeCci; ?>><font color="black"><b>Ecrire à toute la famille</font></b></a></td>
	</tr>

	
<?php //affichage liste des internautes
	$ligne=1;

	//if ($count=="") {
		$count=0;
	//}

$query = "SELECT * FROM coordonnees WHERE Mail<>'' ORDER BY Nom"; 
$result = mysql_query($query);

// tant qu'il y a des fiches
while ($val = mysql_fetch_array($result)) { ?>

	<tr>
		<td align=center width="150" bgcolor="<?php	if ($ligne==1) { echo "bbbbbb"; } else {  echo "FAD27C";  } ?>" width="10%"><font face="Trebuchet MS, Comic Sans MS" size=2><a><?php echo $val["nom"]." ".$val["prenom"]; ?></font></td>
		<td align=center width="250" bgcolor="<?php	if ($ligne==1) { echo "bbbbbb"; } else {  echo "FAD27C";  } ?>" width="70%">
			<font face="Trebuchet MS, Comic Sans MS" size=2>
			<?php echo "<a href=mailto:".$val["mail"].">".$val["mail"]."</a>"; ?>
			</font>
			
		</td>
	</tr>


<?php

	if ($ligne==1) {
		$ligne=0;
	} else {
		$ligne=1;
	}

 }
 
?>


</table>
</td><td bgcolor=blue> </td><td align=right valign=top>
<table align='right'>
	<tr>
		<td colspan="2" align=center><font color="black" size="4"><b>Les anniversaires du mois...</font></b><br><br></td>
	</tr>
	<tr>
		<td bgcolor="#A5BAFE" width="150"><font face="Trebuchet MS, Comic Sans MS" size=2 color="ffffff"><b>Nom</b></font></td>
		<td bgcolor="#A5BAFE" width="250"><font face="Trebuchet MS, Comic Sans MS" size=2 color="ffffff"><b>Date de naissance</b></font></td>
	</tr>
	
<?php //affichage liste des internautes
	$ligne=1;

	if ($count=="") {
		$count=0;
	}

$query = "SELECT * FROM coordonnees WHERE naiss<>'' ORDER BY naiss desc"; 
$result = mysql_query($query);

// tant qu'il y a des fiches
while ($val = mysql_fetch_array($result)) {
	//echo (substr($val["naiss"],5,2))."<br>";
	
	if (substr($val["naiss"],5,2)==date("m")) {
		 ?>

	<tr>
		<td align=center width="150" bgcolor="<?php	if ($ligne==1) { echo "bbbbbb"; } else {  echo "FAD27C";  } ?>" width="10%"><font face="Trebuchet MS, Comic Sans MS" size=2><a><?php echo $val["nom"]." ".$val["prenom"]; ?></font></td>
		<td align=center width="250" bgcolor="<?php	if ($ligne==1) { echo "bbbbbb"; } else {  echo "FAD27C";  } ?>" width="70%">
			<font face="Trebuchet MS, Comic Sans MS" size=2>
			<?php echo substr($val["naiss"],8,2)."/".substr($val["naiss"],5,2)."/".substr($val["naiss"],0,4); ?>
			</font>			
			<br>
			<?php
				if ($ligne==1) {
					$ligne=0;
				} else {
					$ligne=1;
				}
			}
			?>
		</td>
	</tr>


<?php



 }
 
?>


</table>

</td></tr>

</table>

<?php

include("../aqua_bas.htm");
}
?>