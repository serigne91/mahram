<?php
	include ("../conex.inc");


$count = getHHTPVars('count', $_POST, $_GET);

include("../aqua_haut.htm");?>
<font color="red">Ici vous pouvez supprimer les potins inopportuns !</font>
     <form action="delpotin.php" method="get">
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
				<td align=center bgcolor="#FEDB71" width="70%"><font face="Trebuchet MS, Comic Sans MS" size=2>
	            <b>Supprimer</b>
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
while ($val = mysql_fetch_array($result)) {
	?>
		<tr>
			<td align=center bgcolor="<?php	if ($ligne==1) { echo "F2F2F2"; } else {  echo "D6D6D6";  } ?>" width="10%"><font face="Trebuchet MS, Comic Sans MS" size=2><a><?php echo $val["Date"]; ?></font></td>
			<td align=center bgcolor="<?php	if ($ligne==1) { echo "F2F2F2"; } else {  echo "D6D6D6";  } ?>" width="10%"><font face="Trebuchet MS, Comic Sans MS" size=2><?php echo $val["nom"]; ?></font></td>
			<td align=center bgcolor="<?php	if ($ligne==1) { echo "F2F2F2"; } else {  echo "D6D6D6";  } ?>" width="70%"><font face="Trebuchet MS, Comic Sans MS" size=2><?php echo $val["Potins"]; ?></font></td>
			<td align=center bgcolor="<?php	if ($ligne==1) { echo "F2F2F2"; } else {  echo "D6D6D6";  } ?>" width="70%"><input type="checkbox" name="<?php echo $val["Id"]; ?>" value="ON"></td>
		</tr>
<?php

	if ($ligne==1) {
		$ligne=0;
	} else {
		$ligne=1;
	}
}
?>
</table><div align="right"><input type="submit" value="Supprimer" name="B1"></form>
<a href="potins.php?potin=ok&count=<?php echo $count+10;?>" border=0>Précédents </a> 
<?php
if ($count<>0) { 
	echo " --- <a href=potins.php?potin=ok&count=".($count-10)." border=0> Suivants</a>";
}
?>
    
    <!-- Fin table Potins -->

<?php
include("../aqua_bas.htm");
?>