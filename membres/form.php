<?php include ("../aqua_haut.htm"); 

?>
<b>Inscription</b> --- <a href=../index.php><font size=2 color=green><b>Menu principal</b></font></a><br><br>
			
	<form method="POST" action="redir.php">
					<table border=0 height=10>
						<tr>
							<td valign="top" width="30%" rowspan=2>
								<?php
									FormulaireInscript($login,$conexion);
								?>
							</td>
							<td colspan=2 height="5%" valign="bottom" align="left">
								<font color=red size=2><i>PS : Vous devez impérativement choisir<br>un parent dans la liste</i></font>
							</td>
							</tr>
							<tr>
							<td valign="top" align="right" width="20%">
								<?php
									ListInscrits($login,$conexion);
								?>
								

							</td>
							<td valign="top">
								<?php
									ChoixReferantInscript();
								?>
							</td>

						</tr>
					</table>
		<div align=center>			
		<input type="hidden" name="login" value="<?php echo $login; ?>">					
		<!--<input type="submit" value="Enregistrer l'inscription" name="creanew"><br>-->
		<input type="image" src="images/inscrire.gif" border=0 alt="incription" value="Enregistrer name="creanew">
		<!--<input type="reset" value="reset" name="reset"></p>-->
	</form>

		
<?php include ("../aqua_bas.htm"); ?>