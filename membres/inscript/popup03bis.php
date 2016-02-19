<?php
$Id = $_COOKIE['Id'];

if ($Id=='OKDAK') {

// include ("../../aqua_haut.htm"); 
include ("../../conex.inc");
include ("fonctions.inc");


?>
<b>Inscription --- étape 3/4</b></a><br><br>
	<form method="POST" action="popup04.php">
<?php

echo "<h2>FINI</h2>";


?>
		<input type="hidden" name="login" value="<?php echo $login; ?>">					
		<!--<input type="submit" value="Enregistrer l'inscription" name="creanew"><br>-->
		<input type="image" src="images/inscrire.gif" border=0 alt="incription" value="Enregistrer name="creanew">
		<!--<input type="reset" value="reset" name="reset"></p>-->
	</form>
<?php
}
?>