<html>
	<head>
		<title>Zitoun.biz</title>
	</head>
	<body bgcolor="#C0C0C0">
		
		
<table style="border-collapse: collapse" width=100% border="0" cellspacing="0" cellpadding="0" bgcolor=#dddddd><tr><td>

			
<?php
	//require ("fonctions_sa.inc");
	include ("../conex.inc");

	$Sqllist="SELECT * FROM coordonnees WHERE id_key=$id_key_refinscript";
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

		</td>
	</tr>
</table>