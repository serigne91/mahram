<?php
if ($Id=='OKDAK') {

	include ("../conex.inc");

	include("../aqua_haut.htm");
?>
    <a href="../membres/indexmf.php?rediger=oui"><p align=right><img src="images/plume.gif" border="0"></a>
    <!-- debut table potin -->
     
   		<table align="center" border="0">
			<tr>
				<td align=center bgcolor="#FEDB71" width="10%"><font face="Trebuchet MS, Comic Sans MS" size=2>
                <b>Date</b>
				</font></td>
				<td align=center bgcolor="#FEDB71" width="10%"><font face="Trebuchet MS, Comic Sans MS" size=2>
	            <b>Auteur</b>
				</font></td>
				<td align=center bgcolor="#FEDB71" width="70%"><font face="Trebuchet MS, Comic Sans MS" size=2>
	            <b>Potin</b>
				</font></td>
				</tr>
<?php

$ligne=1;
if ($count=="") {
	$count=0;
}

$query = "SELECT * FROM potins GROUP BY Id desc LIMIT $count, 10"; 


$result = mysql_query($query,$conexion);
// tant qu'il y a des fiches
while ($val = mysql_fetch_array($result)) { ?>
		<tr>
			<td align=center bgcolor="<?php	if ($ligne==1) { echo "F2F2F2"; } else {  echo "D6D6D6";  } ?>" width="10%"><font face="Trebuchet MS, Comic Sans MS" size=2><a><?php echo $val["Date"]; ?></font></td>
			<td align=center bgcolor="<?php	if ($ligne==1) { echo "F2F2F2"; } else {  echo "D6D6D6";  } ?>" width="10%"><font face="Trebuchet MS, Comic Sans MS" size=2><?php echo $val["nom"]; ?></font></td>
			<td align=center bgcolor="<?php	if ($ligne==1) { echo "F2F2F2"; } else {  echo "D6D6D6";  } ?>" width="70%"><font face="Trebuchet MS, Comic Sans MS" size=2><?php echo html_entity_decode($val["Potins"]); ?></font></td>
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
<a href="indexmf.php?potinbox=oui&count=<?php echo $count+10;?>" border=0><img src="../images/preced.gif" border=0>Précédents</a> 
<?php
if ($count<>0) { 
	echo " --- <a href=indexmf.php?potinbox=oui&count=".($count-10)." border=0>Suivants<img src=../images/suiv.gif border=0></a>";
}
?>
    
    <!-- Fin table Potins -->

<?php
	include("../aqua_bas.htm");
}
?>