<?php include("../aqua_haut.htm");
include ("../conex.inc")


?>
		<font size=2>Connexion actuelle : 
		<?php
		
				
   $link = mysql_connect($host, $nomuser, $password)
       or die("Impossible de se connecter : " . mysql_error());
   print ("<b>Connexion réussie</b>");
   mysql_close($link);
		
		
			if ($fichier=fopen("../conex.txt","r")) {
				$text = fread($fichier,"150");
				echo $text;
			}
			
			echo "<br><br>";
			
			if ($fichier=fopen("../config_log.inc","r")) {
				$text = fread($fichier,"150");
				echo $text;
			}

			include ("../config_log.inc");
			
		echo "<font color=blue>Login Admin = ".$loginadm."<br>"
		."MdPass Admin = ".$passadm."<br>"
		."<font color=green>Login Membres = ".$loginmemb."<br>"
		."MdPass Membres = ".$passmemb;

?> 
<!-- pour remodifier éventuellemnt la connexion ou les log/pass
<table><tr><td>
		<form method="POST" action="acreer">
			Host<br>
				<input type"txt" name="host" value="<?php echo $host; ?>"><br>
			Utilisateur<br>
				<input type"txt" name="nomuser" value="<?php echo $nomuser; ?>"><br>
			Mot de passe<br>
				<input type"txt" name="password" value="<?php echo $password; ?>"><br>
			Nom de votre base de données<br>
				<input type"txt" name="nombase" value="<?php echo $nombase; ?>"><br>
				
</td><td>		
			Login adinistrateur<br>
				<input type"txt" name="loginadm" value="<?php echo $loginadm; ?>"><br>
			Mot de passe administrateur<br>
				<input type"txt" name="passadm" value="<?php echo $passadm; ?>"><br>
			Login membre<br>
				<input type"txt" name="loginmemb" value="<?php echo $loginmemb; ?>"><br>
			Moit de passe membre<br>
				<input type"txt" name="passmemb" value="<?php echo $passmemb; ?>"><br>
				
				
</td></tr></table>

<input type="submit" value="Modifier la connexion" name="creanew"></p>
	</form>

-->
	<br><br><font size="2" color="red"> Les fichiers de conf sont : conex.inc, conex.txt et config_log.inc placés à la racine du site</font>
		<?php
			
include("../aqua_bas.htm"); ?>