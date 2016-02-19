<body bgcolor="#C0C0C0">
<b><font color=red>Inscription --- étape 1/4</font></b></a><br><br>

<?php

$Id = $_COOKIE['Id'];

if ($Id=='OKDAK') {

include ("../../aqua_haut.htm"); 
include ("../../conex.inc");
include ("fonctions.inc");
$login= getHTTPVars("login", $_POST, $_GET);


?>
<b><font color=red>Sélectionnez l'une des deux options</font></b></a><br>

			
	<form method="POST" action="popup02.php">
					<table border=0 height=10>
						
							<tr>
							<td valign="top" align="right" width="20%">
								
								

							</td>
							<td valign="top">
								Je suis le/la fils/fille de <input type="radio" name="RefInscript" value="fils" checked><br>
								<?php
									ListInscrits($login,$conexion);
								?>
								<br>
								<!-- Je suis le conjoint de <input type="radio" name="RefInscript" value="conjoint"><br>
								<?php
									
									ListInscritsMasculin($login,$conexion);
								?>
								<br> -->
								Je suis le/la père/mère de <input type="radio" name="RefInscript" value="parent"><br>
								<?php
									ListInscritsP($login,$conexion);
								?>
							</td>

						</tr>
					</table>
		<div align=center>			
		<input type="hidden" name="login" value="<?php echo $login; ?>">
					
		<!--<input type="submit" value="Enregistrer l'inscription" name="creanew"><br>-->
		<input type="submit" src="../images/etapesuiv.gif" border=0 alt="incription" value="Enregistrer" name="creanew">
		<!--<input type="reset" value="reset" name="reset"></p>-->
	</form>

		
<?php 
include ("../../aqua_bas.htm"); 
}
?>